<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\View as PreView;
use Illuminate\View\View;
use App\Models\Blueprint;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class QuoteController extends Controller
{

    // container for the blueprint used in quote generation
    public Blueprint $blueprint;

    /**
     * shows a page that allows for the creation and editing of quotes for blueprints
     *
     * @param Blueprint $blueprint
     * @return View
     * @throws AuthorizationException
     */
    public function show( Blueprint $blueprint ): View
    {
        $this->authorize('edit_configuration', $blueprint);

        $configs = Configuration::where('blueprint_id', $blueprint->id )
            ->where('obsolete', false)
            ->where('value', 1)
            // narrow things down a bit...
            ->select([
                'id','name','description','obsolete','value', 'quantity','price_tier_3','price_tier_2'
            ])
            // don't filter at all if showAll is present
//            ->when($showAll, function( $query ) {  })
//            // filter all but value > 0 if showAll not present
//            ->when(!$showAll, function( $query ) {
//                return $query->where('value', '>', 0);
//            })
//            // handle sort order and direction if present
//            ->when($orderBy, function( $query, $orderBy ) use ($sortOrder) {
//                return $query->orderBy( $orderBy, $sortOrder );
//            })
            ->get();

        // lets role!
        return view('blueprint::quote.show', [
            'blueprint' => $blueprint,
            'configurations' => $configs,
        ]);
    }



    /**
     * @return string
     */
    private function header(): string
    {
        $user = $this->blueprint->user;
        $dealer = $user->company;
        return PreView::make('blueprint::quote.pdf.header',[
            'blueprint' => $this->blueprint,
            'dealer' => $dealer,
        ]);
    }


    /**
     * @return string
     */
    private function footer(): string
    {
        return PreView::make('blueprint::quote.pdf.footer',[
            'blueprint' => $this->blueprint,
        ]);
    }


    /**
     * returns the html from a view for the terms and conditions
     * @return string
     */
    private function terms(): string
    {
        return PreView::make('blueprint::quote.pdf.toc');
    }




    /**
     * @return string
     */
    private function noPricing(): string
    {
        return PreView::make('blueprint::quote.pdf.noPricing',[
            'configuration' => $this->blueprint->configuration,
        ]);
    }





    /**
     * @param Blueprint $blueprint
     * @param string $type
     */
    public function output_to_pdf( Blueprint $blueprint, string $type = 'no_pricing' )
    {
        $this->blueprint = $blueprint;


        $stylesheet = public_path('css/letterhead.css');
        // image file content
        $stylesheet = file_get_contents( $stylesheet );


        $media = null;

        try {
            $mpdf = new Mpdf( [
                'tempDir' => storage_path( 'temp' ),
                'orientation' => "portrait",
                'sheet-size' => 'Letter',
            ] );
            $mpdf->writeHTML($stylesheet, HTMLParserMode::HEADER_CSS );


            /*
             * BODY SECTION
             */
            $mpdf->SetHTMLHeader( $this->header() );

            $mpdf->addPageByArray([
                'margin-left' => 20,
                'margin-right' => 20,
                'margin-top' => 75,
                'margin-bottom' => 30,
                'margin-footer' => 20

            ]);
            $mpdf->SetHTMLFooter( $this->footer() );


            switch( $type )
            {
                case( "no_pricing" ):
                    $mpdf->WriteHTML( $this->noPricing() ) ;
                    break;
//                case( "dealerPricing" ):
//                    $mpdf->WriteHTML( $this->dealerPricing() ) ;
//                    break;
//                case("MSRPPricing"):
//                    $mpdf->WriteHTML( $this->MSRPPricing() );
//                    break;
                default:
                    die("no permission to see this {$type}");
                    break;
            }


            /*
             * END BODY SECTION
             */



            /*
             * TERMS SECTION
             */
            // reset header
            $mpdf->SetHTMLHeader( "" );

            if( $blueprint->terms === 1)
            {
                $mpdf->addPageByArray([
                    'margin-left' => 20,
                    'margin-right' => 20,
                    'margin-top' => 20,
                    'margin-bottom' => 20,

                ]);
                $mpdf->SetHTMLFooter( "" );

                $mpdf->WriteHTML( $this->terms() ) ;
            }

            /*
             * END TERMS SECTION
             */

            $filename = ( $this->blueprint->quote_number )
                ? storage_path("temp/quote_".$blueprint->id.'_'.$this->blueprint->quote_number.'.pdf' )
                : storage_path("temp/quote_".$blueprint->id.'_'.time().'.pdf' );

            $mpdf->output( $filename , "F");

            $media = $this->blueprint->addMedia( $filename )
                ->toMediaCollection('quotes','s3');

//            if (!$this->blueprint->quote_number)
//            {

//            }
//            return true;


        } catch ( MpdfException | FileDoesNotExist | FileIsTooBig $e ) {
            echo $e;
        }
        return redirect( $media->cdnUrl() );


    }



}

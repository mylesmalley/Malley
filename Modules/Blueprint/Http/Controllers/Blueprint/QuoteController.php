<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View as PreView;
use Illuminate\View\View;
use App\Models\Blueprint;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Modules\Blueprint\Emails\QuoteMailer;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class QuoteController extends Controller
{

    // container for the blueprint used in quote generation
    public Blueprint $blueprint;
    public Collection $configuration;

    public float $dealer_total = 0;
    public float $msrp_total = 0;


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


        // lets roll!
        return view('blueprint::quote.show', [
            'blueprint' => $blueprint,
  //          'configurations' => $configs,
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
            'configuration' => $this->configuration,
        ]);
    }


    /**
     * @return string
     */
    private function dealerPricing(): string
    {
        return PreView::make('blueprint::quote.pdf.dealerPricing',[
            'blueprint' => $this->blueprint,
            'configuration' => $this->configuration,
            'total' => $this->dealer_total,
        ]);
    }


    /**
     * @return string
     */
    private function dealerPricingTotalOnly(): string
    {
        return PreView::make('blueprint::quote.pdf.totalOnly',[
            'blueprint' => $this->blueprint,
            'configuration' => $this->configuration,
            'total' => $this->dealer_total,
        ]);
    }

    /**
     * @return string
     */
    private function MSRPTotalPricing(): string
    {
        return PreView::make('blueprint::quote.pdf.totalOnly',[
            'blueprint' => $this->blueprint,
            'configuration' => $this->configuration,
            'total' => $this->msrp_total,
        ]);
    }


    /**
     * @return string
     */
    private function MSRPPricing(): string
    {
        return PreView::make('blueprint::quote.pdf.msrpPricing',[
            'blueprint' => $this->blueprint,
            'configuration' => $this->configuration,
            'total' => $this->msrp_total,
        ]);
    }




    /**
     * pulls it all together then redirects to the rendered PDF stored in AWS
     *
     * @param Blueprint $blueprint
     * @param string $type
     * @return RedirectResponse
     */
    public function output_to_pdf( Blueprint $blueprint, string $type = 'no_pricing' ): RedirectResponse
    {
        $this->blueprint = $blueprint;


        $this->configuration = Configuration::where('blueprint_id', $blueprint->id )
            ->where('value', 1)
            ->where('show_on_quote', true)
            ->orderBy('name', 'ASC')
            ->get();


        foreach( $this->configuration as $c )
        {
            $this->dealer_total += $c->DealerPrice( $blueprint->exchange_rate );
            $this->msrp_total += $c->MSRPPrice( $blueprint->exchange_rate );
        }



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
                case( "dealer" ):
                    $mpdf->WriteHTML( $this->dealerPricing() ) ;
                    break;
                case("msrp"):
                    $mpdf->WriteHTML( $this->MSRPPricing() );
                    break;
                case("dealer_total_only"):
                    $mpdf->WriteHTML( $this->DealerPricingTotalOnly() );
                    break;
                case("msrp_total_only"):
                    $mpdf->WriteHTML( $this->MSRPTotalPricing() );
                    break;
                default:
                    die("no permission to see this");
            }


            /*
             * END BODY SECTION
             */



            /*
             * TERMS SECTION
             */

           // dd($blueprint->terms );

            if( $blueprint->terms )
            {

           //     dd( $this->terms() );

                $mpdf->SetHTMLHeader();

                $mpdf->addPageByArray([
                    'margin-left' => 20,
                    'margin-right' => 20,
                    'margin-top' => 20,
                    'margin-bottom' => 20,

                ]);
                $mpdf->SetHTMLFooter();

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


        if (Auth::user()->email )
        {
            try {

                Mail::to( Auth::user()->email )
                    ->send( new QuoteMailer( $blueprint, $media ) );
            } catch ( \Exception $e )
            {
            }
        }




        return redirect( $media->cdnUrl() );


    }



}

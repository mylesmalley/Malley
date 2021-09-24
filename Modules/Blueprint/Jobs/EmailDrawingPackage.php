<?php

namespace Modules\Blueprint\Jobs;

use App\Models\Configuration;
use App\Models\Media;
use App\Models\Template;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Modules\Blueprint\Emails\DrawingCreated;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use App\Models\User;
use Mpdf\MpdfException;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Illuminate\Queue\Middleware\ThrottlesExceptions;


class EmailDrawingPackage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Blueprint $blueprint;
    protected User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Blueprint $blueprint, User $user )
    {
        $this->blueprint = $blueprint;
        $this->user = $user;

        if ( ! $user->email ) die("No email available to send drawings to");
    }



    /**
     * get the templates that are associated with the particular base van sales package
     *
     * @return Collection
     */
    private function getTemplates(): Collection
    {
        return Template::where('base_van', $this->blueprint->base_van_id )
            ->where('sales_drawing', '=',true )
            ->where('pdf', true)
            ->orderBy('order', 'ASC')
            ->get();
    }


    /**
     * grab the options that are supposed to appear on a template page
     *
     * @param int $templateID
     * @return array
     */
    private function templateOptions( int $templateID ): array
    {
        return DB::table('template_options')
            ->where('template_id', $templateID )
            ->pluck('option_id')
            ->toArray();
    }


    /**
     * Take teh imputed values and parse the stored html template. basically search and replace
     *
     * @param Template $template
     * @param Collection $fullConfiguration
     * @return array
     *
     */
    private function parseTemplate(Template $template, Collection $fullConfiguration ): array
    {
        $templateHTML = $template->template;

        // options to be used in this template
        $templateOptions = $this->templateOptions( $template->id );

        // filter out the options that aren't shown on the template
        $templateConfiguration = $fullConfiguration->whereIn('option_id', $templateOptions);

        // pass the filtered configs to a view to convert to html
        $formattedOptionsHTML = View::make('blueprint::drawing.salesRenders.options',['configurations'=> $templateConfiguration]);

        // replcae the options placeholder with the html
        $templateHTML = str_replace("@OPTIONS@",  $formattedOptionsHTML , $templateHTML );

        // replace the values below with their sources from the blueprint itself
        $templateHTML = str_replace("@NAME@", $this->blueprint->name , $templateHTML );
        $templateHTML = str_replace("@DESCRIPTION@", $this->blueprint->description , $templateHTML );


        // --- PARSE NOTES   --- //
        $notes_array = [];
        preg_match_all('/@NOTE=(.*?)@/s', $templateHTML, $notes_array);

        foreach( $notes_array[1] as $matched )
        {
            // in case a camelcase or uppercase name was used for the note name
            $match = strtolower($matched);

            if ( is_array( $this->blueprint->notes ) && array_key_exists( $match ,  $this->blueprint->notes )  && strlen( $this->blueprint->notes[ $match ] ) >0  )
            {
                $note = "<div class='notes'>{$this->blueprint->notes[ $match ]}</div>";
                $templateHTML = str_replace("@NOTE=$match@", $note , $templateHTML );
            }
            else
            {
                // no note was supplied, so just delete it
                $templateHTML = str_replace("@NOTE=$match@", "" , $templateHTML );
            }
        }
        // --- END NOTE PARSING   --- //



        // --- PARSE IMAGES   --- //
        $imageURLs = [];
        preg_match_all('/"@URL@(.*?)"/s', $templateHTML, $imageURLs);

        // run through each image hit and try to replace the image with the contents of the relevant file.
        for ( $i = 0; $i < count( $imageURLs[0] ); $i++ )
        {
            $media = Media::where([
                //   'model_type'=>'App\Models\Blueprint',
                'file_name' => $imageURLs[1][$i],
                'model_id'=>$this->blueprint->id
            ])->first();

            if ( $media )
            {
                $templateHTML = str_replace( $imageURLs[0][$i], "{$media->cdnUrl()}", $templateHTML );

            }


        }

        // --- END PARSING OF IMAGES  --- //



        // return the finished, formatted template
        return [
            'template' => $templateHTML,
            'title' => $template->name,
        ];
    }

    /**
     * @param string $title
     * @return string
     */
    private function pageHeader( string $title ): string
    {
        return View::make('blueprint::drawing.salesRenders.header',[
            'blueprint' => $this->blueprint,
            'title' => $title,
        ]);
    }

    /**
     * @return string
     */
    private function pageFooter(): string
    {
        $company = $this->blueprint->user->company;

        $logoFile = $this->blueprint->user->company->getMedia('logo')->first(); //->getFirstMedia() ;

        $image = null;

        if ( $logoFile )
        {
            if (  file_exists( $logoFile->getPath() ) )
            {
                $image = base64_encode( file_get_contents( $logoFile->getPath() )  );
            }

        }


        return View::make('blueprint::drawing.salesRenders.footer',[
            'blueprint' => $this->blueprint,
            'image' => $image,
            'company' => $company,
        ]);
    }


    /**
     * @return string
     */
    private function lightPodPage(): string
    {
        /** @var blueprint $ */
        return "<div><pre>{$this->blueprint->lightPods->instructions}</pre></div>";
    }



    /**
     * @return string
     */
    private function floorLayoutPage(): string
    {
        /** @var blueprint $ */
        return "<div><img alt='Floor Layout' src='{$this->blueprint->getMedia('floor_layouts')->last()->cdnUrl()}'></div>";
    }





    /**
     * Yes or no if the blueprint contains any special instructions itself or on configuration items
     *
     * @return bool
     */
    private function hasSpecialInstructions(): bool
    {
        $configsWithNotes = Configuration::where('blueprint_id', $this->blueprint->id )
            ->where('value', 1)
            ->whereNotNull('notes')
            ->with('option')
            ->get();

        return $this->blueprint->notes || count( $configsWithNotes );
    }


    /**
     * @return string
     */
    private function specialInstructions(): string
    {
        $configsWithNotes = Configuration::where('blueprint_id', $this->blueprint->id )
            ->where('value', 1)
            ->whereNotNull('notes')
            ->with('option')
            ->get();

        // send an empty array if no special instructions are set
        $notes = $this->blueprint->notes ?? [];

        return View::make('blueprint::drawing.salesRenders.configsWithNotes',[
            'configurations'=> $configsWithNotes,
            'notes'=> $notes
        ]);

    }


    /**
     * @return string
     */
    private function allSelectedOptions(): string
    {
        $configsWithNotes = Configuration::where('blueprint_id', $this->blueprint->id )
            ->where('value', 1)
            ->where('name', 'NOT LIKE', '%-Z%')
            ->with('option')
            ->get();

        return View::make('blueprint::drawing.salesRenders.options',[
            'configurations'=> $configsWithNotes,
            'showBoxes' => false,
        ]);

    }


    /**
     * @param Blueprint $blueprint
     * @param string|null $customFilename
     * @return \Spatie\MediaLibrary\MediaCollections\Models\Media
     * @throws MpdfException
     */
    public function compile( Blueprint $blueprint, string $customFilename = null ): \Spatie\MediaLibrary\MediaCollections\Models\Media
    {

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        $this->blueprint = $blueprint;
        $pdf = true;
        $debugHtml = null;
//        ob_clean();
//	    echo '"'.flush().'"';
        //	dd( $this->specialInstructions() );

        // get the templates for this base van
        $templates = $this->getTemplates();

        // grab teh configuration for this particular blueprint
        $configuration = Configuration::where('blueprint_id', $this->blueprint->id )
            ->where('value', 1)
            ->with('option')
            ->get();

        // storage for the rendered templates
        $renderPages = [];

        foreach( $templates as $template )
        {
            // actually parse the template with the blueprint and required options
            $renderPages[] = $this->parseTemplate( $template, $configuration );
        }



        $stylesheet = public_path('print.css');
        // image file content
        $stylesheet = file_get_contents( $stylesheet );

        if ( $pdf )
        {
            $mpdf = new Mpdf([
                'debug' => false,
                'tempDir' => storage_path('temp'),
                'orientation' => "landscape",
                'sheet-size' => 'Letter',
                'allow_output_buffering' => true
            ]);

            //	    $mpdf->showImageErrors = true;

            // need to declare footer for first page before writing it.
            $mpdf->SetHTMLFooter('{PAGENO} of {nb}');

            $mpdf->writeHTML($stylesheet, HTMLParserMode::HEADER_CSS );

        }
        else
        {
            $debugHtml .= $stylesheet;

        }



        // special notes page
        if ( $this->hasSpecialInstructions() )
        {
            if ( $pdf )
            {


                $mpdf->setHTMLHeader($this->pageHeader( "Summary of Special Instructions") );

                $mpdf->addPageByArray([
                    'orientation'=> 'landscape',
                    'margin-left' => 6,
                    'margin-right' => 6,
                    'margin-top' => 21,
                    'margin-bottom' => 30,
                    'margin-header' => 6,
                    'margin-footer' => 6,
                ]);
                $mpdf->WriteHTML( $this->specialInstructions( ) ) ;

                $mpdf->setHTMLFooter($this->pageFooter( ) );
            }
            else
            {
                $debugHtml .= $this->specialInstructions( ) ;
            }
        }






        foreach ( $renderPages as $section )
        {
            if ($pdf)
            {
                $mpdf->setHTMLHeader($this->pageHeader( $section['title']) );

                $mpdf->addPageByArray([
                    'orientation'=> 'landscape',
                    'margin-left' => 6,
                    'margin-right' => 6,
                    'margin-top' => 21,
                    'margin-bottom' => 36,
                    'margin-header' => 6,
                    'margin-footer' => 6,
                ]);

                // split the resulting template
                //  $chunks = str_split( $section['template'], 1500 );
                /*
                                for( $i = 0; $i < count( $chunks ); $i++ )
                                {
                                    $mpdf->WriteHTML( $chunks[$i] ) ;
                                }
                */
                $mpdf->WriteHTML( $section['template'] ) ;

                //  $chunks = str_split( $section['template'], 1500 );
                $mpdf->setHTMLFooter( $this->pageFooter( ) );
            }
            else
            {
                $debugHtml .= $section['template'] ."<br /><br /><br /><br />";
                //	$debugHtml .= strlen( $section['template'] )."<br />";
            }
        }

        // light pods page for instructions
        if ( $this->blueprint->lightPods )
        {
            if ($pdf)
            {


                $mpdf->setHTMLHeader($this->pageHeader( "Light Pod Instructions") );

                $mpdf->addPageByArray([
                    'orientation'=> 'landscape',
                    'margin-left' => 6,
                    'margin-right' => 6,
                    'margin-top' => 21,
                    'margin-bottom' => 18,
                    'margin-header' => 6,
                    'margin-footer' => 6,
                ]);
                $mpdf->WriteHTML( $this->lightPodPage( ) ) ;

                $mpdf->setHTMLFooter($this->pageFooter( ) );
            }
            else
            {
                $debugHtml .= $this->lightPodPage();
            }
        }





        // light pods page for instructions
        if ( $this->blueprint->hasMedia('floor_layouts') )
        {
            if ($pdf)
            {

                $mpdf->setHTMLHeader($this->pageHeader( "Floor Layout") );

                $mpdf->addPageByArray([
                    'orientation'=> 'landscape',
                    'margin-left' => 6,
                    'margin-right' => 6,
                    'margin-top' => 21,
                    'margin-bottom' => 18,
                    'margin-header' => 6,
                    'margin-footer' => 6,
                ]);
                $mpdf->WriteHTML( $this->floorLayoutPage( ) ) ;

                $mpdf->setHTMLFooter($this->pageFooter( ) );
            }
            else
            {
                $debugHtml .= $this->lightPodPage();
            }
        }






        if ($pdf)
        {


            $mpdf->setHTMLHeader($this->pageHeader( "Summary of All Options") );

            $mpdf->addPageByArray([
                'orientation'=> 'landscape',
                'margin-left' => 6,
                'margin-right' => 6,
                'margin-top' => 21,
                'margin-bottom' => 48,
                'margin-header' => 6,
                'margin-footer' => 10,
            ]);

            $mpdf->SetColumns( 2);
            $mpdf->WriteHTML( $this->allSelectedOptions(  ) ) ;

            $mpdf->setHTMLFooter($this->pageFooter( ) );
        }




        //Output a PDF file directly to the browser
        if ($pdf)
        {
            //   $mpdf->Output();



            $filename = ($customFilename)
                ? storage_path("temp/drawing_".$blueprint->id.'_'.$customFilename.'.pdf' )
                : storage_path("temp/drawing_".$blueprint->id.'_'.time().'.pdf' );


            $mpdf->output( $filename , "F");

            $media = null;

            try {
                $media = $blueprint->addMedia($filename)
                    ->toMediaCollection('drawing', 's3');
            } catch (FileDoesNotExist | FileIsTooBig $e) {
              //  dd( $e );
                Bugsnag::notifyException($e);
            }

            return $media;

        }
        else
        {
            echo strlen($debugHtml);
            echo $debugHtml;
        }

        return new Media;
    }

    /**
     * @return ThrottlesExceptions[]
     */
    public function middleware(): array
    {
        return [new ThrottlesExceptions(5, 2)];
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return DateTime
     */
    public function retryUntil(): DateTime
    {
        return now()->addMinutes(2);
    }


    /**
     * Execute the job.
     *
     * @return void
     * @throws MpdfException
     */
    public function handle()
    {

        $media = $this->compile( $this->blueprint );

        //$usersToReceive = User::where('email_when_blueprint_created', true)->pluck('email');
        $usersToReceive = [ $this->user->email, 'mmalley@malleyindustries.com' ];
        if (count($usersToReceive))
        {
            Mail::to( $usersToReceive )
                ->send( new DrawingCreated( $this->blueprint, $media ) );
        }
    }
}

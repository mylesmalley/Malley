<?php

namespace Modules\Blueprint\Jobs;

use App\Models\FormElement;
use App\Models\FormElementItem;
use App\Models\Media;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Blueprint;
use Illuminate\Support\Facades\Cache;
use ImagickException;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Imagick;
use Illuminate\Bus\Batchable;

class ProcessDrawing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    protected Blueprint $blueprint;
    protected FormElement $formElement;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Blueprint $blueprint, FormElement $formElement )
    {
        $this->blueprint = $blueprint;
        $this->formElement = $formElement;
    }


    /**
     * Execute the job.
     *
     * @return void
     * @throws ImagickException
     */
    public function handle()
    {

        // all media available for a base van
        $allMedia = FormElementItem::where('form_element_id', $this->formElement->id)
            ->pluck('media_id');

        // media that should be active for this blueprint
        $activeMedia = $this->blueprint->activeDrawingIDs();

        // the overlap between available and needed
        $usedMedia = Media::whereIn('id', $allMedia->intersect( $activeMedia ) )
            ->get();


        $images = [];

        // stop if there are no images to process
        if ( count( $usedMedia ) <= 0) return null;

        // grab the images needed
        foreach( $usedMedia as $item )
        {
            $images[] = file_get_contents($item->cdnUrl() ) ;
            //    dd( file_get_contents($item->cdnUrl() ) );


//            if (Cache::has( "drawing_{$item->id}")) {
//                $images[]  =  Cache::get("drawing_{$item->id}" );
//            }
//            else
//            {
//              //  $base64 = file_get_contents($item->cdnUrl() );
//                $encoded = file_get_contents($item->cdnUrl() );
//              //  $images[]  = $encoded = "data:{$item->mime_type};base64,". base64_encode( $base64 );
////                $encoded = base64_decode( $base64 );
//                $images[] = $encoded;
//                Cache::put( "drawing_{$item->id}", $encoded ,  10086400);
//
//            }



        }


     //   dd( $images[0]);


        // create the starting point
        $base = new Imagick( );
      //  $base->setImageFormat('png');

        $base->readImageBlob($images[0]);
          $base->setImageFormat('png');

        //  $base = new Imagick( $images[0] );


        // loop through and add up those images
        for ( $i = 1; $i < count( $images ); $i++ )
        {
            $layer = new Imagick( );
            $layer->readImageBlob($images[$i]);

            $layer->setImageFormat('png');

            $base->addImage( $layer );
        }

        // actually flatten the stack
        $result = $base->mergeImageLayers(imagick::LAYERMETHOD_UNDEFINED);

        // save the result to the s3 bucket
        try {
            $this->blueprint->addMediaFromStream($result->getImageBlob())
                ->usingName(str_replace( [' ','.','(',')',':',','], ['_'], $this->formElement->label ))
                ->usingFileName(str_replace( [' ','.','(',')',':',','], ['_'], $this->formElement->label ) . '.png')
                ->toMediaCollection('images', 's3');
        } catch (ImagickException | FileCannotBeAdded $e) {
            Bugsnag::notifyException($e);
        }


    }
}

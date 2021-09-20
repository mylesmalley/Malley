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
            $images[] = $item->cdnUrl();
        }

        // create the starting point
        $base = new Imagick( $images[0] );
        $base->setImageFormat('png');


        // loop through and add up those images
        for ( $i = 1; $i < count( $images ); $i++ )
        {
            $layer = new Imagick( $images[$i] );
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

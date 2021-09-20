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

        $allMedia = FormElementItem::where('form_element_id', $this->formElement->id)
            ->pluck('media_id');

        $activeMedia = $this->blueprint->activeDrawingIDs();

        $usedMedia = Media::whereIn('id', $allMedia->intersect( $activeMedia ) )
            ->get();


        $images = [];

        foreach( $usedMedia as $item )
        {
            $images[] = $item->cdnUrl();
        }


        $base = new Imagick( $images[0] );
        $base->setImageFormat('png');


        for ( $i = 1; $i < count( $images ); $i++ )
        {
            $layer = new Imagick( $images[$i] );
            $base->addImage( $layer );
        }


        $result = $base->mergeImageLayers(imagick::LAYERMETHOD_UNDEFINED);

        try {
            $this->blueprint->addMediaFromStream($result->getImageBlob())
                ->usingName(str_replace( [' ','.','(',')',':',','], ['_'], $this->formElement->label ))
                ->usingFileName(str_replace( [' ','.','(',')',':',','], ['_'], $this->formElement->label ) . '.png')
                ->toMediaCollection('test2', 's3');
        } catch (ImagickException | FileCannotBeAdded $e) {
            Bugsnag::notifyException($e);
        }





    }
}

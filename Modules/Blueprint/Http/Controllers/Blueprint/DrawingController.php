<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use App\Models\FormElement;
use App\Models\Blueprint;
use App\Models\FormElementItem;
use App\Models\Media;
use App\Http\Controllers\Controller;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Bus\Batch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Imagick;
use ImagickException;
use Modules\Blueprint\Jobs\ProcessDrawing;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Throwable;


class DrawingController extends Controller
{


    /**
     * @param Blueprint $blueprint
     * @param FormElement $formElement
     * @throws ImagickException
     */
    public function assemble( Blueprint $blueprint, FormElement $formElement )
    {

//        $allMedia = FormElementItem::where('form_element_id', $formElement->id)
//            ->pluck('media_id');
//
//        $activeMedia = $blueprint->activeDrawingIDs();
//
//        $usedMedia = Media::whereIn('id', $allMedia->intersect( $activeMedia ) )
//            ->get();
//
//
//        $images = [];
//
//        foreach( $usedMedia as $item )
//        {
//            $images[] = $item->cdnUrl();
//        }
//
//
//        $base = new Imagick( $images[0] );
//        $base->setImageFormat('png');
////        $base->setImageAlpha();
//
//        for ( $i = 1; $i < count( $images ); $i++ )
//        {
//            $layer = new Imagick( $images[$i] );
//            $base->addImage( $layer );
//        }
//
//
//        $result = $base->mergeImageLayers(imagick::LAYERMETHOD_UNDEFINED);
//
//        try {
//            $blueprint->addMediaFromStream($result->getImageBlob())
//                ->usingName('merged_images')
//                ->usingFileName("merged_images" . '.png')
//                ->toMediaCollection('tests', 's3');
//        } catch (ImagickException | FileCannotBeAdded $e) {
//            dd($e);
//        }

    }



    /**
     * @param Blueprint $blueprint
     * @return Collection
     */
    public function activeDrawingIDs( Blueprint $blueprint ): Collection
    {
        return $blueprint->activeDrawingIDs();
    }


    /**
     * @throws Throwable
     */
    public function test(Blueprint $blueprint )
    {
        $image_blocks = $blueprint->platform->drawingElements()->get();

        $events = [];

        foreach( $image_blocks as $block )
        {
            $events = ProcessDrawing::dispatch( $blueprint, $block );
        }


        Bus::batch($events)
            ->then(function (Batch $batch) {


        })->catch(function (Batch $batch, Throwable $e) {
                Bugsnag::notifyException($e);

            })->finally(function (Batch $batch) {

            })->dispatch();




    }

}

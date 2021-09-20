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
use Modules\Blueprint\Jobs\EmailDrawingPackage;
use Modules\Blueprint\Jobs\ProcessDrawing;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Throwable;


class DrawingController extends Controller
{


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
    public function generateDrawingPackage(Blueprint $blueprint )
    {
        $image_blocks = $blueprint->platform->drawingElements()->get();
        $events = [];


        foreach( $image_blocks as $block )
        {
            $events[] = new ProcessDrawing( $blueprint, $block );
        }


        Bus::batch( $events )
            ->then(function (Batch $batch) use ($blueprint) {
            EmailDrawingPackage::dispatch( $blueprint );

        })->catch(function (Batch $batch, Throwable $e) {
                Bugsnag::notifyException($e);

            })->finally(function (Batch $batch) {

            })->dispatch();


        return redirect()
            ->route('blueprint.home', [$blueprint])
            ->with('success','Your drawings will be emailed to you shortly.');

    }

}

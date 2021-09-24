<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use App\Models\Blueprint;
use App\Http\Controllers\Controller;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Bus\Batch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Modules\Blueprint\Jobs\CreateDrawingPackage;
use Modules\Blueprint\Jobs\EmailDrawingPackage;
use Modules\Blueprint\Jobs\ProcessDrawing;
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
     * @param Blueprint $blueprint
     * @return RedirectResponse
     * @throws Throwable
     */
    public function generateDrawingPackage(Blueprint $blueprint ): RedirectResponse
    {
        $image_blocks = $blueprint->platform->drawingElements()->get();
        $events = [];


        foreach( $image_blocks as $block )
        {
            $events[] = new ProcessDrawing( $blueprint, $block );
        }

        $user = Auth::user();


        Bus::batch($events)

        ->then(function (Batch $batch) use ($blueprint, $user) {
            // All jobs completed successfully...
            Bus::chain([
                new CreateDrawingPackage( $blueprint ),
                new EmailDrawingPackage( $blueprint, $user ),
            ])->dispatch();
        })
        ->catch(function (Batch $batch, Throwable $e) {
            // First batch job failure detected...
            Bugsnag::notifyException($e);
        })
        ->finally(function (Batch $batch) {
            // The batch has finished executing...
        })->dispatch();



        return redirect()
            ->route('blueprint.home', [$blueprint])
            ->with('success','Your drawings will be emailed to you shortly.');

    }

}

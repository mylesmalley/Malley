<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use App\Models\Blueprint;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
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

        if( count( $image_blocks ) > 0 )
        {
            Log::info("Drawing package requested for B-$blueprint->id");

            $events = [];

            foreach( $image_blocks as $block )
            {
                $events[] = new ProcessDrawing( $blueprint, $block );
            }

            $user = Auth::user();

            Bus::batch($events)
                ->then(function () use ($blueprint, $user) {
                    Log::info("Images processed for B-$blueprint->id");
                    // All jobs completed successfully...
                    Bus::chain([
                        new CreateDrawingPackage( $blueprint ),
                        new EmailDrawingPackage( $blueprint, $user ),
                    ])->dispatch();
                })
                ->catch(function () {
                    // First batch job failure detected...
                    Log::debug("Image processing batch failed");
                })
                ->finally(function () {
                    Log::info("Drawing package assembled and dispatched");
                    // The batch has finished executing...
                })->dispatch();

        }
        else
        {
            Log::info("Drawing package requested for B-$blueprint->id that has no rendered images");

            $user = Auth::user();
            Bus::chain([
                new CreateDrawingPackage( $blueprint ),
                new EmailDrawingPackage( $blueprint, $user ),
            ])->dispatch();
        }


        return redirect()
            ->route('blueprint.home', [$blueprint])
            ->with('success','Your drawings will be emailed to you shortly.');

    }



}

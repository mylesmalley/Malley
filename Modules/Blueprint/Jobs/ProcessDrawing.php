<?php

namespace Modules\Blueprint\Jobs;

use App\Models\FormElementItem;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Blueprint;


class ProcessDrawing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Blueprint $blueprint;
    protected FormElementItem $formElementItem;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Blueprint $blueprint, FormElementItem $formElementItem )
    {
        $this->blueprint = $blueprint;
        $this->formElementItem = $formElementItem;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {







    }
}

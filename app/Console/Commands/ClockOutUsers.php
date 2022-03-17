<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClockOutUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blueprint:clock-out';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Force clock out all staff';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $time = Carbon::now('America/Moncton')->toIso8601String();

        DB::table('labour')
            ->whereNull('end')
            ->update([
                'end' => $time,
                'flagged' => true,
            ]);

        Log::info('Clocked out active labour users.');
    }
}

<?php

namespace Modules\Syspro\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Blueprint;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CacheNextPreviousItem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    protected int $inventory_item_id;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( int $inventory_item_id )
    {
        $this->inventory_item_id = $inventory_item_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $item = DB::table('inventory_items')
            ->where('id', '=', $this->inventory_item_id )
            ->first();

        // next or previous
        $all = DB::table('Inventory_Latest_Counts')
            ->select(['id','inventory_id','bin','group'])
            ->where([
                [ 'inventory_id', '=', $item->inventory_id ],
                [ 'group', '=', strtoupper( $item->group )]
            ])
            ->orderBy('bin')
            ->orderBy('id')
            ->pluck('id')
            ->toArray();

        $pos = array_search($this->inventory_item_id, $all);


        $uncounted = DB::table('Inventory_Latest_Counts')
            ->select(['id','inventory_id','bin','group'])
            ->where([
                [ 'inventory_id', '=', $item->inventory_id ],
                [ 'group', '=', strtoupper( $item->group )]
            ])
            ->whereNotIn('line_status', ['Accepted', 'Matched'])
            ->orderBy('bin')
            ->orderBy('id')
            ->pluck('id')
            ->toArray();

        $pos_2 = array_search($this->inventory_item_id, $uncounted);



//        $output = json_decode(json_encode([
//            "next" => (array_key_exists($pos + 1,  $all))
//                ? $all[$pos + 1]: null,
//            "previous" =>  (array_key_exists($pos-1,  $all))
//                ? $all[$pos - 1] : null,
//            "next_uncounted" => (array_key_exists($pos_2 + 1,  $uncounted))
//                ? $uncounted[$pos_2 + 1]: null,
//            "previous_uncounted" =>  (array_key_exists($pos_2-1,  $uncounted))
//                ? $uncounted[$pos_2 - 1] : null,
//        ]));


        DB::table('inventory_items')
            ->where('id', '=', $this->inventory_item_id )
            ->update([
                "next_id" => (array_key_exists($pos + 1,  $all))
                    ? $all[$pos + 1]: null,
                "previous_id" =>  (array_key_exists($pos-1,  $all))
                    ? $all[$pos - 1] : null,
                "next_uncounted_id" => (array_key_exists($pos_2 + 1,  $uncounted))
                    ? $uncounted[$pos_2 + 1]: null,
                "previous_uncounted_id" =>  (array_key_exists($pos_2-1,  $uncounted))
                    ? $uncounted[$pos_2 - 1] : null,
            ]);


   //     Cache::put('inventory_item_position_'.$this->inventory_item_id, $output );

        Log::info("Updating Database for next-previous items for $this->inventory_item_id");
    }


}

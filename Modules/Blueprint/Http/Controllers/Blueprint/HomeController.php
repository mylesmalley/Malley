<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\View\View;
use App\Models\Blueprint;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{

    /**
     * home page of an individual blueprint
     *
     * @param Blueprint $blueprint
     * @return View
     * @throws AuthorizationException
     */
    public function show( Blueprint $blueprint ): View
    {
        $this->authorize('home', $blueprint );

        $blueprint->upgrade( );

        return view('blueprint::blueprint.home', [
            'blueprint' => $blueprint
        ]);
    }



//
//
//    /**
//     * @param Blueprint $blueprint
//     */
//    public function upgrade( Blueprint $blueprint )
//    {
//        if ($blueprint->is_locked === true) return false;
//
////        if( $blueprint->base_van_id == 10)
////        {
//
//        $config = $blueprint->configuration()
//            ->pluck('option_id');
//
//
//        $missing_options = Option::where('base_van_id', $blueprint->base_van_id)
//            ->whereNotIn('id', $config)
//            ->where('obsolete', false)
//            ->with('components')
//            ->get();
//
//        // list of option properties to clone
//        $map = [
//            "name" => "option_name",
//            "description" => "option_description",
//            "positive_requirements" => "option_positive_requirements",
//            "negative_requirements" => "option_negative_requirements",
//            "syspro_phantom" => "option_syspro_phantom",
//            'option_id' => 'id',
//            "price_tier_1" => "option_price_tier_1",
//            "price_tier_2" => "option_price_tier_2",
//            "price_tier_3" => "option_price_tier_3",
//            "price_base_offset" => "option_price_base_offset", // OLD
//
//            "price_dealer_offset" => "option_price_dealer_offset",
//            "price_msrp_offset" => "option_price_msrp_offset",
//
//            "value" => "option_value",
//            'long_lead_time' => "option_long_lead_time",
//            'show_on_quote' => "option_show_on_quote",
//            'light_component' => "option_light_component",
//            'location' => "option_location",
//            'locked' => "option_locked",
//            'obsolete' => "obsolete",
//            'revision' => "revision",
//            'fingerprint' => 'fingerprint',
//        ];
//
//        $insertArray = [];
//
//
//
//        foreach ($missing_options as $o) {
//            $c = [];
//
//            $c['blueprint_id'] = $blueprint->id;
//            foreach ($map as $k => $v) {
//                $c[$k] = $o->$v;
//            }
//
//            //    $c['option_id'] = $o->id;
//
//            // roll up current cost of option component
//            $c['cost'] = $o->totalCost();
//            $insertArray[] = $c;
//            //  $this->configuration()->save($c);
//        }
//
//        //    dd( $insertArray);
//
//        // $insert = DB::table('configurations')->insert($insertArray);
//
//        $totalInsertRows = array_chunk($insertArray, 50);
//        foreach( $totalInsertRows as $chunk )
//        {
//            DB::table('configurations')->insert($chunk);
//        }
//
//
//        return count($insertArray );
//
////        }
////        else
////        {
////            $blueprint->upgrade();
////
////        }
//
//
//    }

}

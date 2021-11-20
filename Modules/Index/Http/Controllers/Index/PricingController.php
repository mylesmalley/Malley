<?php

namespace Modules\Index\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\BaseVan;
use App\Models\Option;

class PricingController extends Controller
{


    public function index(BaseVan $baseVan)
    {

        $options = Option::select([
                'id','option_name','option_description','option_price_tier_2',
                'option_price_tier_3','option_price_msrp_offset',
                'option_price_dealer_offset'])
            ->where('base_van_id', '=', $baseVan->id )
            ->where('obsolete', '=', false)
            ->where('has_pricing', '=', true)
            ->orderBy('option_name', 'ASC')
            ->get();

        return view('index::index.pricing.index', [
            'basevan' => $baseVan,
            'options' => $options,
        ]);
    }

}

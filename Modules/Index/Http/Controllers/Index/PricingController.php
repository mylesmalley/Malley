<?php

namespace Modules\Index\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\BaseVan;
use App\Models\Option;

class PricingController extends Controller
{


    public function index(BaseVan $baseVan)
    {

        $options = Option::where('base_van_id', '=', $baseVan->id )
            ->where('obsolete', '=', false)
            ->where('has_pricing', '=', true)
            ->get();

        return view('index::index.pricing.index', [
            'basevan' => $baseVan,
            'options' => $options,
        ]);
    }

}

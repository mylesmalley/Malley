<?php

namespace Modules\Index\Http\Controllers\Option;

use App\Models\Option;
use App\Http\Controllers\Controller;
use \Illuminate\View\View;


class PricingController extends Controller
{

    /**
     * @param Option $option
     * @return View
     */
    public function form( Option $option ): View
    {
        return view('index::options.pricing', [
            'option'=>$option,
            'platform'=>$option->platform,
        ]);
    }


}

<?php

namespace Modules\Index\Http\Controllers\Option;


use App\Models\Option;
use App\Models\Configuration;
use App\Http\Controllers\Controller;
use Illuminate\View\View;


class UsageController extends Controller
{
    /**
     * @param Option $option
     * @return View
     */
    public function show( Option $option ) : View
    {
        $configs = Configuration::where([
            'option_id' => $option->id,
            'obsolete' => false,
        ])->with([
            'blueprint',
            'blueprint.user',
            'blueprint.user.company'
        ])
            ->orderBy('blueprint_id', 'DESC')
            ->get();

        return view('index::options.usage', [
            'option' => $option,
            'configs' => $configs,
        ]);

    }



}

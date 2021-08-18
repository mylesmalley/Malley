<?php

namespace Modules\Index\Http\Controllers\Option;

use App\Models\Template;
use App\Models\BaseVan;
use Illuminate\Http\RedirectResponse;
use App\Models\Option;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\View\View;


class TemplateController extends Controller
{
    /**
     * @param Option $option
     * @return View
     */
    public function optionTemplates( Option $option ) : View
    {
        $optionTemplates = DB::table('template_options')
            ->where('option_id', $option->id )
            ->pluck('id','template_id')
            ->toArray();

        return view('index::options.optionTemplates', [
            'option' => $option,
            'availableTemplates' => BaseVan::find( $option->base_van_id)
                ->templates()
                ->where( [ 'sales_drawing' => 1,
                    'pdf' => 1,
                    'production_drawing' => 0
                   ] )
                ->where('template','like','%@OPTIONS@%')
                ->get(),
            'optionTemplates' => $optionTemplates,
        ]);
    }

    /**
     * @param Option $option
     * @param Template $template
     * @return RedirectResponse
     */
    public function remove( Option $option, Template $template ): RedirectResponse
    {

        DB::table('template_options')->where([
            'template_id'=> $template->id,
            'option_id'=>$option->id
        ])->delete();
        return redirect()->back();
    }

    /**
     * @param Option $option
     * @param Template $template
     * @return RedirectResponse
     */
    public function add( Option $option, Template $template ): RedirectResponse
    {
        DB::table('template_options')->insert([
            'option_id'=>$option->id,
            'template_id'=> $template->id,
        ]);
        return redirect()->back();
    }


}

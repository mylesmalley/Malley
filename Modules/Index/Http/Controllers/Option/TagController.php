<?php

namespace Modules\Index\Http\Controllers\Option;

use App\Models\OptionTag;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use App\Models\Option;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\View\View;


class TagController extends Controller
{
    /**
     * @param Vehicle $vehicle
     * @return View
     */
    public function optionTags( Option $option ) : View
    {
        $optionTags = DB::table('option_tags')
            ->where('option_id', $option->id )
            ->pluck('id','tag_id')
            ->toArray();

        return view('index::options.tags', [
            'option' => $option,
            'availableTags' => Tag::where('base_van_id', $option->base_van_id)
                ->where('model','option')
                ->orderBy('name')->get(),
            'optionTags' => $optionTags,
        ]);
    }

    /**
     * @param Option $option
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function delete( Option $option, Tag $tag  ): RedirectResponse
    {

        DB::table('option_tags')->where([
            'tag_id'=> $tag->id,
            'option_id'=>$option->id
        ])->delete();
        return redirect()->back();
    }

    /**
     * @param Option $option
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function create( Option $option, Tag $tag ): RedirectResponse
    {
        DB::table('option_tags')->insert([
            'option_id'=>$option->id,
            'tag_id'=> $tag->id,
        ]);
        return redirect()->back();
    }


}

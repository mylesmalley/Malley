<?php

namespace Modules\Index\Http\Controllers\Drawing;

use App\Models\Media;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use App\Models\Option;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\View\View;


class TagController extends Controller
{
    /**
     * @param Option $option
     * @param Media $media
     * @return View
     */
    public function drawingTags( Option $option,  Media $media ) : View
    {
        $drawingTags = DB::table('media_tags')
            ->where('media_id', $media->id )
            ->pluck('id','tag_id')
            ->toArray();

        return view('index::drawings.tags', [
            'media' => $media,
            'option' => $option,
            'availableTags' => Tag::where('base_van_id', $option->base_van_id)
                ->where('model','drawing')
                ->orderBy('name')->get(),
            'drawingTags' => $drawingTags,
        ]);
    }

    /**
     * @param Media $media
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function delete(  Media $media , Tag $tag  ): RedirectResponse
    {
        DB::table('media_tags')->where([
            'tag_id'=> $tag->id,
            'media_id'=>$media->id
        ])->delete();
        return redirect()->back();
    }

    /**
     * @param Media $media
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function create(  Media $media , Tag $tag ): RedirectResponse
    {
        DB::table('media_tags')->insert([
            'media_id'=>$media->id,
            'tag_id'=> $tag->id,
        ]);
        return redirect()->back();
    }


}

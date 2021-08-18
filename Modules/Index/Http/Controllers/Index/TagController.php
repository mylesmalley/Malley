<?php

namespace Modules\Index\Http\Controllers\Index;


use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\BaseVan;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * @param Request $request
     * @param BaseVan $baseVan
     * @return RedirectResponse
     */
    public function create(Request $request, BaseVan $baseVan): RedirectResponse
    {
        $request->validate([
            'model' => 'required|string',
            'name' => ['required',
                        'string',
                        'max:30',

                function ( $fail) use ($request, $baseVan) {

                    $find = Tag::where('name', ucwords( strtolower( $request->name ) ) )
                        ->where('base_van_id', $baseVan->id)
                        ->count();

                    if ($find) {
                        $fail("The tag name must be unique to this platform.");
                    }
                },
            ],
        ]);

        $tag =  new Tag;
        $tag->base_van_id = $baseVan->id;
        $tag->model = $request->model;
        $tag->name = ucwords( strtolower( $request->name ) );
        $tag->save();

        return redirect()->back();
    }

}

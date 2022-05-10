<?php

namespace Modules\BodyguardBOM\Http\Controllers\Categories;

use App\Models\BG\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * @param Category|null $category
     * @return Response
     */
    public function show( Category $category = null ): Response
    {
        // default is the first one, root
        $category = $category ?? Category::find(1);

        $category->load([
            'children',
            'ancestors'
        ]);

        return response()->view('bodyguardbom::show',[
            'category' => $category,
        ]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store( Request $request ) : RedirectResponse
    {
        $request->validate([
            'parent_id' => 'required|integer',
            'name' => 'required|string|max:255',
        ]);

        $parent = Category::findOrFail( $request->input('parent_id'));

        $parent->children()->create([
            'name' => $request->input('name')
        ]);

        return redirect()
            ->back();
    }

    public function update( Request $request )
    {

    }

    public function delete( Request $request )
    {

    }

}

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

    /**
     * @param Category $category
     * @return Response
     */
    public function edit( Category $category ) : Response
    {
        return response()->view('bodyguardbom::categories.edit',[
            'category' => $category,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update( Request $request ) : RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
        ]);

        $category = Category::find( $request->input('id') );

        $category->update( $request->only('name'));

        return redirect()
            ->route('bg.categories.show', [ $request->input('id') ]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete( Request $request ) : RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $category = Category::findOrFail( $request->input('id') );
        $parent_id = $category->parent_id;

        if ( $category->children()->count() === 0)
        {
            $category->delete();
            return redirect()
                ->route('bg.categories.show', [$parent_id]);
        }
        return redirect()
            ->route('bg.categories.show', [$parent_id])
            ->withErrors(["Can't delete a category that has children."]);
    }

}

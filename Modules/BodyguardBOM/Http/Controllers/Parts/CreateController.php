<?php

namespace Modules\BodyguardBOM\Http\Controllers\Parts;

use Modules\BodyguardBOM\Models\Category;
use Modules\BodyguardBOM\Models\Part;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CreateController extends Controller
{

    /**
     * @return Response
     */
    public function create() : Response
    {
        return response()->view('bodyguardbom::parts.create', [
            'tree' => $this->category_tree()
        ]);
    }



    public function store( Request $request ) : RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|integer',
            'part_number' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $part = Part::create( $request->only('part_number', 'description'));

        $category = Category::findOrFail( $request->input('category_id') );

        $category->parts()
            ->attach( $part );

        return redirect( )
            ->route('bg.categories.show', [$category]);
    }


    /**
     * @return array
     */
    private function category_tree(): array
    {
        $nodes = Category::get()->toTree();

        $category_tree = [];

        $traverse = function ($categories, $prefix = ' - ') use (&$traverse, &$category_tree) {
            foreach ($categories as $category) {
                $category_tree[ $category->id ] = $prefix.' '.$category->name;
                $traverse($category->children, $prefix.' - ');
            }
        };

        $traverse($nodes);

        return $category_tree;
    }
}



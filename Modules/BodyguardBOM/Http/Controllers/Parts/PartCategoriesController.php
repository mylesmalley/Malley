<?php

namespace Modules\BodyguardBOM\Http\Controllers\Parts;

use Modules\BodyguardBOM\Models\Category;
use Modules\BodyguardBOM\Models\Part;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class PartCategoriesController extends Controller
{

    /**
     * @return Response
     */
    public function create( Part $part ) : Response
    {
        $categories = $part
            ->categories()
            ->pluck('id')
            ->toArray();

        return response()->view('bodyguardbom::parts.add_to_category', [
            'part' => $part,
            'existing_categories' => $categories,
            'tree' => $this->category_tree()
        ]);
    }



    public function store( Request $request ) : RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|integer',
            'id' => 'required|integer',
        ]);

        $category = Category::findOrFail( $request->input('category_id') );
        $part = Part::findOrFail( $request->input('id') );

        $category->parts()
            ->attach( $part );

        return redirect( )
            ->route('bg.parts.show', [$part]);
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



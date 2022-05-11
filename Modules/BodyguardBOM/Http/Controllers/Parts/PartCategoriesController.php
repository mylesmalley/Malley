<?php

namespace Modules\BodyguardBOM\Http\Controllers\Parts;

use Illuminate\Support\Facades\DB;
use Modules\BodyguardBOM\Models\Category;
use Modules\BodyguardBOM\Models\Part;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class PartCategoriesController extends Controller
{

    use CategoryTreeTrait;

    /**
     * @param Part $part
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete( Request $request ) : RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|integer',
            'part_id' => 'required|integer',
        ]);

        DB::table('bg_category_parts')
            ->where([
                ['bg_category_id', '=', $request->input('category_id')],
                ['bg_part_id', '=', $request->input('part_id') ],
            ])
            ->delete();

        return redirect()
            ->route( 'bg.parts.show', [$request->input('part_id')]);
    }

}



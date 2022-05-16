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

    use CategoryTreeTrait;
    use PartNumberComponentsTrait;

    /**
     * @param Category|null $category
     * @return Response
     */
    public function create( Category $category = null ) : Response
    {

        $category = $category->id ?? null;

        return response()->view('bodyguardbom::parts.create', [
            'category' => $category,
            'tree' => $this->category_tree(),
            'prefixes' => $this->prefix,
            'colours' => $this->colours,
            'roof_heights' => $this->roof_heights,
            'kit_codes' => $this->kit_codes,
            'wheelbases' => $this->wheelbases,
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



}



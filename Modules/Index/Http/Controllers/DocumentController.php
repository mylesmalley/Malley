<?php

namespace Modules\Index\Http\Controllers;

use App\Models\Document;
use App\Models\Media;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(  )
    {
        $tree = Document::get()->toTree();
        return view('index::documents.index', [  'tree'=>$tree  ]);
    }

	/**
	  * Show the form for creating a new resource.
	 *
	 * @param int $parent
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function create( int $parent )
    {
        return view('index::documents.create', ['document'=>Document::class, 'parent_id'=>$parent ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$request->validate([
    		'name' => "required|string",
		    'parent_id' => "required|int",
		    "media_id" => "nullable|int",
		    "category" => "nullable|string",
		    "visible" => "required|boolean",
	    ]);

        $document = new Document( $request->except('parent_id') );
        $parent = Document::find($request->parent_id);
	    $document->parent()->associate($parent)->save();
        return redirect( '/documents/'.$request->parent_id );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Request $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        return view('index::documents.edit', ['document'=>$document ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
	    $request->validate([
		    'name' => "required|string",
		    "media_id" => "nullable|int",
		    "category" => "nullable|string",
	    ]);

        $document->update( $request->only(['category','name','media_id']) );
        //dd($request->());
        return redirect('documents/'.$document->id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document, Media $media = null)
    {

		if ($media)
		{
			return redirect()->away("https://blueprint.malleyindustries.com/documents/delete/{$document->id}/{$media->id}");
		}
	    return redirect()->away("https://blueprint.malleyindustries.com/documents/delete/{$document->id}");
    }
}

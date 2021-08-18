<?php

namespace Modules\Index\Http\Controllers;

use App\Models\Album;
use App\Models\Media;
use Aws\RAM\Exception\RAMException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Illuminate\View\View;

class AlbumController extends Controller
{

    /**
     * @param Album $album
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show( Album $album )
    {
        return view( 'index::albums.show', [ 'album' => $album ] );
    }





	/**
	 * Show the form for creating a new resource.
	 *
	 * @param int $parent
	 * @return \Illuminate\Contracts\View\Factory|
	 */
	public function create( Album $parent )
	{
		return view( 'index::albums.create', [ 'album' => Album::class, 'parent_id' => $parent->id ] );
	}


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function store( Request $request )
	{
		$request->validate( [
			'name' => "required|string",
			'parent_id' => "required|int",
		] );

		$album = new Album( $request->only( 'name' ) );
		$parent = Album::find( $request->parent_id );
		$album->parent()->associate( $parent )->save();
            $album->search_string = $album->ancestors->pluck('name')->implode(' > '). ' > '. $album->name;
            $album->save();

		return redirect( '/albums/' . $album->id );
	}


	/**
	 *
	 * Show the form for editing the specified resource.
	 *
	 * @param Album $document
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit( Album $album )
	{
		return view( 'index::albums.edit', [ 'album' => $album ] );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param Album $document
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update( Request $request, Album $album )
	{
		$request->validate( [
			'name' => "required|string|max:50",
			'public' => "required|boolean",
		] );
		//  dd( $request->all() );
		$album->update( $request->only( [ 'name', 'public' ] ) );
        $album->search_string = $album->ancestors->pluck('name')->implode(' > '). ' > '. $album->name;
        $album->save();

		return redirect( 'albums/' . $album->id );
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy( Album $album )
	{

	    $parent = $album->parent->id;

		$album->delete();

		return redirect( '/albums/'.$parent );
	}


	/**
	 * redirect to blueprint page to upload images to an album
	 *
	 * @param Album $album
	 */
	public function add( Request $request, Album $album )
	{
        $request->validate([
            'upload.*' => 'required|mimes:png,jpg,jpeg|max:10000',
        ]);

        if($request->hasfile('upload'))
        {
            foreach($request->file('upload') as $upload) {

                $album->addMedia( $upload )
                    ->toMediaCollection('default',  's3');

            }
        }


        return redirect()->back();
	}





	/**
	 * redirect to page on blueprint that deletes a given media item
	 *
	 * @param Album $album
	 * @param Media $media
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deletePhoto( Album $album, Media $media )
	{
        $media->delete();
        return redirect("/albums/{$album->id}");
	}


	public function moveForm( Album $album )
	{
		$tree = Album::withDepth()
			->get()
			->toTree();

		return view( 'index::albums.move', [ 'al' => $album, 'tree' => $tree ] );
	}

	public function move( Request $request )
	{
		$request->validate( [
			"old_album" => "required|int",
			"new_album" => "required|int",
			"ids.*" => "required|int",
		] );

	//	dd( $request->ids );

		$moves = [];

		$oldPath = "Album/" . $request->old_album;
		$newPath = "Album/" . $request->new_album;


		$ids = $request->ids ?? [];


		// Grab the files that need to be moved
		for ( $i = 0; $i < count( $ids  ) ; $i++ ) {
			$files = Storage::disk( 's3' )
				->allFiles( $oldPath . "/" . $ids[$i] );

			for ( $x = 0; $x < count( $files ); $x++ )
			{
				// change the storage directory appropriately
				$moves[ $files[$x] ] = str_replace($oldPath, $newPath, $files[$x] );
			}
		}

	//	dd( $moves );

		// actually move the files
		foreach( $moves as $old => $new )
		{
			Storage::disk( 's3' )
				->move( $old, $new);
		}


		Media::whereIn('id', $ids)
			->update([
				'model_id' => $request->new_album,
			]);

		return redirect('/albums/' . $request->new_album );
	}


	public function moveAlbum( Request $request )
    {
        $target = Album::find( $request->input('target_id') );

        $destination = Album::find( $request->input('destination_id') );


        if (!$target) return "Target album doesn't exist";

        if (!$destination) return "Destination album doesn't exist";


        $destination->appendNode($target);


        return redirect()->back()->with('success', 'Moved Album');
    }
}

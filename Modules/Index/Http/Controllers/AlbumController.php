<?php

namespace Modules\Index\Http\Controllers;

use App\Models\Album;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class AlbumController extends Controller
{

    /**
     * @param Album $album
     * @return Response
     */
    public function show( Album $album ): Response
    {
        return response()
            ->view( 'index::albums.show', [ 'album' => $album ] );
    }





	/**
	 * Show the form for creating a new resource.
	 *
	 * @param Album $parent
	 * @return Response
	 */
	public function create( Album $parent ): Response
	{
		return response()
            ->view( 'index::albums.create', [ 'album' => Album::class, 'parent_id' => $parent->id ] );
	}


    /**
     * @param Request $request
     * @return RedirectResponse
     */
	public function store( Request $request ): RedirectResponse
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
     * @param Album $album
     * @return Response
     */
	public function edit( Album $album ): Response
	{
		return response()
            ->view( 'index::albums.edit', [ 'album' => $album ] );
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Album $album
     * @return RedirectResponse
     */
	public function update( Request $request, Album $album ): RedirectResponse
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
     * @param Album $album
     * @return RedirectResponse
     */
	public function destroy( Album $album ): RedirectResponse
	{

	    $parent = $album->parent->id;

		$album->delete();

		return redirect( '/albums/'.$parent );
	}


    /**
     * redirect to blueprint page to upload images to an album
     *
     * @param Request $request
     * @param Album $album
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
	public function add( Request $request, Album $album ): RedirectResponse
	{
        $request->validate([
            'upload.*' => 'required|mimes:png,jpg,jpeg|max:10000',
        ]);

        if($request->hasfile('upload'))
        {
            foreach($request->file('upload') as $upload) {
                try {
                    $album->addMedia( $upload )
                        ->toMediaCollection('default',  's3');

                } catch ( FileDoesNotExist|FileIsTooBig )
                {
                    Log::error( "Uploaded file too big" );
                }

            }
        }


        return redirect()->back();
	}





	/**
	 * redirect to page on blueprint that deletes a given media item
	 *
	 * @param Album $album
	 * @param Media $media
	 * @return RedirectResponse
	 */
	public function deletePhoto( Album $album, Media $media ): RedirectResponse
	{
        $media->delete();
        return redirect("/albums/{$album->id}");
	}


    /**
     * @param Album $album
     * @return Response
     */
	public function moveForm( Album $album ): Response
	{
		$tree = Album::withDepth()
			->get()
			->toTree();

		return response()
            ->view( 'index::albums.move', [ 'al' => $album, 'tree' => $tree ] );
	}



    /**
     * @param Request $request
     * @return RedirectResponse
     */
	public function move( Request $request ): RedirectResponse
	{
		$request->validate( [
			"old_album" => "required|int",
			"new_album" => "required|int",
			"ids.*" => "required|int",
		] );

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


    /**
     * @param Request $request
     * @return RedirectResponse
     */
	public function moveAlbum( Request $request ): RedirectResponse
    {
        $target = Album::find( $request->input('target_id') );

        $destination = Album::find( $request->input('destination_id') );

//
//        if (!$target) return "Target album doesn't exist";
//
//        if (!$destination) return "Destination album doesn't exist";


        $destination->appendNode($target);


        return redirect()->back()->with('success', 'Moved Album');
    }
}

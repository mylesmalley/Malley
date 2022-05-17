<?php

namespace Modules\Index\Http\Controllers\Folders;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use \Illuminate\View\View;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function show( Folder $folder = null )
    {
        $folder = $folder ?? Folder::first();
        return view('index::folders.show', [
            'folder'=> $folder,
        ]);
    }



    public function store( Request $request, Folder $parent )
    {
        $folder = new Folder();
        $folder->name = $request->name;

        $folder->appendToNode( $parent )->save();
        return redirect()->back();
    }

    /**
     * @param Folder $folder
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function delete( Folder $folder )
    {
//        dd( $folder );
        $parent = $folder->parent_id;
        if ( $folder->media->count() === 0)
        {
            $folder->delete();
        }
        return redirect('/folders/'.$parent );
    }

}

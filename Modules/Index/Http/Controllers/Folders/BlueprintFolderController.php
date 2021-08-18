<?php

namespace Modules\Index\Http\Controllers\Folders;

use App\Http\Controllers\Controller;
use App\Models\Folder;


class BlueprintFolderController extends Controller
{

    /**
     * @param string $key
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show( string $key )
    {
        $folder = Folder::find( dec( $key ) );


        return view('index::folders.blueprint', [
            'folder'=> $folder,
        ]);
    }


}

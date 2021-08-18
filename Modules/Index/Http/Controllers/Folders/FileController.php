<?php

namespace Modules\Index\Http\Controllers\Folders;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use \Illuminate\View\View;
use \Illuminate\Http\Request;
use \App\Models\Media;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{

    public function store( Request $request, Folder $folder )
    {
        $request->validate([
            'upload.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,png,jpg,jpeg|max:15360',
        ]);

        if( $request->hasfile('upload'))
        {
            foreach($request->file('upload') as $upload) {

                $folder->addMedia( $upload )
                    ->toMediaCollection('uploads',  's3');

            }
        }

        return redirect()->back();
    }

    /**
     * @param Media $media
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete( Media $media )
    {
        $media->delete();
        return redirect()->back();

    }

}

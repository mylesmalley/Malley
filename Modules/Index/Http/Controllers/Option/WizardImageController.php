<?php

namespace Modules\Index\Http\Controllers\Option;

use App\Models\Option;
use App\Models\Media;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\View\View;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;
use \Illuminate\Http\RedirectResponse;

use Storage;

class WizardImageController extends Controller
{

    public function show( Option $option )
    {

    }


    /**
     * @param Request $request
     * @param Option $option
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function set( Request $request, Option $option ): RedirectResponse
    {
        $request->validate([
			'upload.*' => 'required|mimes:png,jpg,jpeg|max:10000',
		]);

        if($request->hasfile('upload'))
        {
            foreach($request->file('upload') as $upload) {

                $option->addMedia( $upload )
           //         ->usingName(substr(md5(time()), 0, 8))
                    ->toMediaCollection('photos',  's3');

            }
        }


        return redirect()->back();
    }

    /**
     * @param Option $option
     * @param Media $media
     * @return RedirectResponse
     * @throws \Exception
     */
    public function delete( Option $option, Media $media )//: RedirectResponse
    {
      //  dd( $media );
        $media->delete();
       return redirect( "/index/option/{$option->id}/photos");
    }


}

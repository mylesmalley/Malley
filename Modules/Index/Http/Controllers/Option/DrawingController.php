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

class DrawingController extends Controller
{

    /**
     * @param Option $option
     * @return View
     */
    public function index( Option $option ): View
    {
        return view('index::options.drawings', [
            'option'=>$option,
            'platform'=>$option->platform,
        ]);
    }


    /**
     * @param Request $request
     * @param Option $option
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function create( Request $request, Option $option ): RedirectResponse
    {
        $request->validate([
			'upload.*' => 'required|mimes:png|max:10000',
		]);

        if($request->hasfile('upload'))
        {
            foreach($request->file('upload') as $upload) {

                $saved = $option->addMedia( $upload )
                    // returns A2@imagename
                    ->usingFileName( str_replace([' ','_'],'-' , $upload->getClientOriginalName() ) )
                    ->toMediaCollection('drawings','s3');

                // change teh drawing's name to reflect AAA@IMAGE_NAME
                $saved->name = strtoupper( $option->option_name." - ".str_replace([' ','_'],'-' , $saved->name ) );

                // sheets filter by base van id to avoid duplication
                $saved->base_van_id = $option->base_van_id;

                // sheets use the option name as an id helper
                $saved->option_name = $option->option_name;
                $saved->save();


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
    public function destroy( Option $option, Media $media )//: RedirectResponse
    {
      //  dd( $media );
        $media->delete();
       return redirect( "/index/option/{$option->id}/drawings");
    }




}

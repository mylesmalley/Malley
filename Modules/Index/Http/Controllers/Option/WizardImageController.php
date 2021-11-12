<?php

namespace Modules\Index\Http\Controllers\Option;

use App\Models\Option;
use App\Models\Media;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WizardImageController extends Controller
{

    /**
     * @param Option $option
     * @return View
     */
    public function form( Option $option ): View
    {
        return view('index::options.wizard_image', ['option' => $option ]);
    }


    /**
     * @param Request $request
     * @param Option $option
     * @return RedirectResponse
     */
    public function set( Request $request, Option $option ): RedirectResponse
    {
        $request->validate([
			'upload' => 'required|mimes:png,jpg,jpeg|max:1024',
		]);


        if($request->hasfile('upload'))
        {
            try {
                // delete what's there
                $option->clearMediaCollection('wizard_image');
                // add the new one
                $option->addMedia( request()->file('upload') )
                    ->toMediaCollection('wizard_image',  's3');
            }
            catch ( FileDoesNotExist|FileIsTooBig $e )
            {
                Log::error($e);
            }

        }


        return redirect()->back();
    }

    /**
     * @param Option $option
     * @param Media $media
     * @return RedirectResponse
     */
    public function delete( Option $option, Media $media ): RedirectResponse
    {
        $media->delete();

       return redirect()
           ->route('option.wizard_image.form', [$option]);
    }


}

<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Vehicle;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class FilesController extends Controller
{

    /**
     * @param Vehicle $vehicle
     * @return View
     */
    public function show( Vehicle $vehicle ): View
    {
        return view('vehicles::files', [ 'vehicle'=>$vehicle]);
    }



    public function store( Request $request, Vehicle $vehicle )
    {
        $request->validate([
            'upload.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,png,jpg,jpeg|max:30000',
        ]);

        if($request->hasfile('upload'))
        {
            foreach($request->file('upload') as $upload) {

                $vehicle->addMedia( $upload )
                        ->toMediaCollection('uploads',  's3');

            }
        }

        return redirect()->back();
    }


    /**
     * @param Vehicle $vehicle
     * @param Media $media
     * @return RedirectResponse
     * @throws \Exception
     */
    public function delete( Vehicle $vehicle, Media $media )
    {
        $media->delete();
        return redirect()->back();
    }


}

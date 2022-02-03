<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;


/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class FilesController extends Controller
{

    /**
     * @param Vehicle $vehicle
     * @return Response
     */
    public function show( Vehicle $vehicle ): Response
    {
        return response()
            ->view('vehicles::files', [ 'vehicle'=>$vehicle]);
    }


    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function store( Request $request, Vehicle $vehicle ): RedirectResponse
    {
        $request->validate([
            'upload.*' => ['required',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,png,jpg,jpeg',
                'max:30000'],
        ]);

        if($request->hasfile('upload'))
        {
            foreach($request->file('upload') as $upload) {

                try {
                    $vehicle->addMedia( $upload )
                        ->toMediaCollection('uploads',  's3');
                }
                catch (FileDoesNotExist )
                {
                    Log::warning("File being uploaded doesn't exist {$upload->getFilename()}.");
                }
                catch (FileIsTooBig )
                {
                    Log::warning("Uploaded file is too big {$upload->getFilename()} {$upload->getSize()}.");
                }
                catch (Exception  $e)
                {
                    Log::warning( $e );
                }

                Log::info("Uploaded {$upload->getFilename()} to vehicle $vehicle->id");

            }
        }

        return redirect()
            ->back();
    }


    /**
     * @param Vehicle $vehicle
     * @param Media $media
     * @return RedirectResponse
     */
    public function delete( Vehicle $vehicle, Media $media ): RedirectResponse
    {
        $media->delete();
        Log::info("Deleted file $media->id from Vehicle $vehicle->id");

        return redirect()
            ->back();
    }


}

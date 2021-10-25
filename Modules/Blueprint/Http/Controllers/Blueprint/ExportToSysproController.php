<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use App\Models\Media;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Error;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\Blueprint;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * handles creating a DAT file in the format required by Syspro for creating a BOM
 */
class ExportToSysproController extends Controller
{

    /**
     * generates a txt file for importing commands into Syspro
     * @param Blueprint $blueprint
     * @return StreamedResponse|RedirectResponse
     * @throws AuthorizationException
     */
    public function exportToSyspro( Blueprint $blueprint ): StreamedResponse|RedirectResponse
    {
        $this->authorize( 'exportToSyspro', $blueprint );

        $syspro = $blueprint->sysproOutput();
        $output = [];
        foreach ( $syspro as $k => $v ) {
            /*
            SXX-XXXXXX                     1.2
             */
            $output[] = sprintf( "S%-30s%-12.1f\r\n", $k, $v );
        }
        $output = implode( '', $output );

        $file_name = 'syspro-data-B-' . $blueprint->id.'-'. substr(md5(time()),0, 6) . '.txt';
        $directory = storage_path("tmp/$blueprint->id");
        $full_path = $directory . '/' . $file_name;


        // create the temp directory if not found
        if (! is_dir( $directory ))
        {
            mkdir( $directory );
        }

        // store output in temporary location
        file_put_contents( $full_path , $output );

      //  dd(  $full_path , $output );

        try {
            $file = $blueprint->addMedia($full_path)
                ->usingName($file_name)
                ->usingFileName($file_name)
                ->toMediaCollection('syspro', 's3');

            /** @var Media $file */
            return Storage::disk('s3')
                ->download( $file->getPath() );

        } catch (FileDoesNotExist | FileIsTooBig | Error $e) {

            // report if an error was caught
            Bugsnag::notifyException($e);

            return redirect()
                ->route('blueprint.home', [$blueprint])
                ->withErrors(['message' => 'Problem exporting DAT file.']);
        }


    }


}

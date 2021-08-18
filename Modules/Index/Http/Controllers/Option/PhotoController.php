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

class PhotoController extends Controller
{

    /**
     * @param Option $option
     * @return View
     */
    public function index( Option $option ): View
    {
        return view('index::options.photos', [
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
    public function destroy( Option $option, Media $media )//: RedirectResponse
    {
      //  dd( $media );
        $media->delete();
       return redirect( "/index/option/{$option->id}/photos");
    }


    public function migrate( int $offset, int $limit)
    {


        $files = Media::where('collection_name', 'drawings')->offset($offset)->limit($limit)->get();



        foreach( $files as $media)
        {

            echo "\r\n ----- Looking at row {$offset} ({$media->id})--------- \r\n";

            $offset ++;

            $name = $media->file_name;
            $newPath = "Option/{$media->model_id}/{$media->id}";
            $oldPath = $media->getPath();



            if ( Storage::disk('s3')->exists( $newPath . "/" . $name  ) )
            {


                echo "** file already copied {$newPath}/{$name} \r\n";
                continue;
            }

            if (  Storage::disk('s3')->exists($media->getPath()) )
            {
                if (  !Storage::disk('s3')->exists( $newPath ) ){
                    Storage::disk('s3')->makeDirectory( $newPath );
                    echo "** needed to create {$newPath} \r\n";

                }
    //                echo $newPath . "/" . $name ;
                Storage::disk('s3')
                    ->copy( $oldPath,  $newPath . "/" . $name );
                echo "\tMoved {$name} from {$oldPath} to {$newPath} \r\n";
            }
            else
            {
                $media->delete();
                echo "** Couldn't find {$oldPath} so the model was deleted \r\n";

            }

        }


        return true;

    }
}

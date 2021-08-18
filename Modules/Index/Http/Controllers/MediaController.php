<?php

namespace Modules\Index\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;

class MediaController extends Controller
{
	/**
	 * @param Media $media
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
    public function destroy( Media $media )
    {
    	if ($media)
	    {
		    $media->delete();
	    }
	    return back();
    }
}

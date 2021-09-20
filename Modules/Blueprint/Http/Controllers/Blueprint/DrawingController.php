<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use App\Models\Form;
use App\Models\FormElement;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use App\Models\Blueprint;
use App\Models\BaseVan;
use App\Http\Controllers\Controller;
use Imagick;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Modules\Blueprint\Jobs\ResetRenderTemplates;
use Modules\Blueprint\Jobs\EmaiStaffAboutBlueprintCreation;
use Modules\Blueprint\Jobs\UpgradeBlueprint;

class DrawingController extends Controller
{


    /**
     * @param Blueprint $blueprint
     * @param FormElement $formElement
     * @throws \ImagickException
     */
    public function assemble( Blueprint $blueprint, FormElement $formElement )
    {

        //2637
        //2638

        $imagick = new \Imagick( \App\Models\Media::find(2637)->cdnUrl() );
        $imagick2 = new \Imagick( \App\Models\Media::find(2638)->cdnUrl() );
        $imagick->addImage($imagick2);
        $imagick->setImageFormat('png');

        $result = $imagick->mergeImageLayers(imagick::LAYERMETHOD_UNDEFINED);
//        header("Content-Type: image/png");
//        echo $result->getImageBlob();

        $result->writeImage(storage_path('merged.png') );

//        dd( $imagick);

//        return redirect()
//            ->route('blueprint.home', [ $blueprint ]);


    }



    /**
     * @param Blueprint $blueprint
     * @return Collection
     */
    public function activeDrawingIDs( Blueprint $blueprint ): Collection
    {
        return $blueprint->activeDrawingIDs();
    }

}

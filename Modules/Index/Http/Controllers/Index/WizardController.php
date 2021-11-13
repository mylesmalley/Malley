<?php

namespace Modules\Index\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Models\BaseVan;
use App\Models\Wizard;
use Illuminate\View\View;

class WizardController extends Controller
{

    /**
     * @param BaseVan $baseVan
     * @return View
     */
    public function index(BaseVan $baseVan): View
    {
        $wizards = Wizard::where('base_van_id', '=', $baseVan->id )
            ->get();

        return view('index::index.wizards.index', [
            'basevan'=> $baseVan,
            'wizards' => $wizards,
        ]);
    }

}

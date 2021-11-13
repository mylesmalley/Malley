<?php

namespace Modules\Index\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Models\BaseVan;
use App\Models\Wizard;
use App\Models\WizardQuestion;
use Faker\Provider\Base;
use Illuminate\View\View;
use Illuminate\Http\Request;

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


    /**
     * @param BaseVan $baseVan
     * @return View
     */
    public function create( BaseVan $baseVan ): View
    {
        return view('index::index.wizards.create', [
            'basevan'=> $baseVan,
        ]);
    }


    public function store( Request $request, BaseVan $basevan )
    {
        $request->validate([

        ]);

        Wizard::create( $request->all() );

       //$start = WizardQuestion::create
    }

}

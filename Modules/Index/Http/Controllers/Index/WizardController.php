<?php

namespace Modules\Index\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Models\BaseVan;
use App\Models\Wizard;
use App\Models\WizardQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View as ViewFacade;
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

        return ViewFacade::make('index::index.wizards.index', [
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
        return ViewFacade::make('index::index.wizards.create', [
            'basevan'=> $baseVan,
        ]);
    }


    /**
     * @param Request $request
     * @param BaseVan $basevan
     * @return RedirectResponse
     */
    public function store( Request $request, BaseVan $basevan ): RedirectResponse
    {

        $request->validate([
            'name' => 'required|string',
            'start_notes' => 'required|string', // instructions or whatever
            'end_notes' => 'required|string', // what do now?
            'base_van_id' => 'required|int', // platform
            'completed_form_option' => 'required|string|min:12|max:12',
        ]);

        // ID of new wizard
        $nextID = Wizard::select('id')
            ->orderBy('id','DESC')
            ->first()->id;

        $nextID ++; // actually increment, not just use the latest

        $start = WizardQuestion::create([
            'wizard_id' => $nextID,
            'text' => 'Start',
            'type' => 'selection'
        ]);

        $end = WizardQuestion::create([
            'wizard_id' => $nextID,
            'text' => 'Finish',
            'type' => 'selection'
        ]);

        Wizard::create( [
            'base_van_id'=> $basevan->id,
            'start' => $start->id,
            'end' => $end->id,
            'name' => $request->input('name'),
            'start_notes' => $request->input('start_notes'),
            'end_notes' => $request->input('end_notes'),
            'completed_form_option' => $request->input('completed_form_option'),
        ]);

        return redirect()
            ->route( 'platform.wizards', [$basevan]);
    }

}

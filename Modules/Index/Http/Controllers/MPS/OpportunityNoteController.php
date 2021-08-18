<?php

namespace App\Http\Controllers\MPS;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use App\Models\OpportunityNote;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OpportunityNoteController extends Controller
{
	/**
	 * @param Opportunity $opportunity
	 * @return View
	 */
	public function create( Opportunity $opportunity ): View
	{
		return view('index::mps.notes.create', ['opportunity' => $opportunity ]);
	}

	/**
	 * @param Request $request
	 * @return Redirector
	 */
	public function store( Request $request ): RedirectResponse
	{
		$request->validate( [
			'user_id' => "required|int",
			'opportunity_id' => "required|int",
			"note_category_id" => "required|int",
			"note" => "required|string|max:1000",
			"purchase_order" => "string",
		] );

		$note = strip_tags( $request->note );


		$blueprints = [];
		preg_match_all( '/\[(B|b):(\d*)\]/', $request->note, $blueprints );


		for ( $i = 0; $i < count( $blueprints[0] ); $i++ )
		{
				$id = $blueprints[2][$i];
				$code = enc( $id );
				$replace = "<a class='link-to-blueprint' href='https://blueprint.malleyindustries.com/blueprint/{$code}'>B-{$id}</a>";
				$find = $blueprints[0][$i] ;
				$note = str_replace( $find, $replace, $note );

		}

		$stockCodes = [];
		preg_match_all('/\[(S|s):(.*?)\]/s', $request->note, $stockCodes);
	//	dd($stockCodes);
		for ( $i = 0; $i < count( $stockCodes[0] ); $i++ )
		{

			$replace = "<a class='link-to-inventory-query' href='/syspro/inventoryQuery/{$stockCodes[2][$i]}'>{$stockCodes[2][$i]}</a>";
			$note = str_replace( $stockCodes[0][$i], $replace, $note );
		}



		$opt = new OpportunityNote( $request->except('note') );


		$opt->note = $note;
		$opt->save();

		return redirect("/mps/opportunity/{$request->opportunity_id}");
	}

}

<?php

namespace Modules\Index\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Syspro;
use DNS2D;
use DNS1D;
class KanbanCardController extends Controller
{
	public function test()
	{
		$codes = Syspro::kanbanStockCodes();

		return view( 'inventory.kanban.label', ['codes'=>$codes] );
	}


	public function form()
	{
		return view( 'inventory.kanban.form' );
	}



	public function render( Request $request)
	{
		$request->validate([
			'Description' => 'required',
			'StockCode' => 'required',
			'DefaultBin' => 'required',
			'GroupID' => "required",
		]);

		$codes = [ (object) $request->only('Description','StockCode','DefaultBin','GroupID') ];
	//dd( collect( $codes ) );
		return view( 'inventory.kanban.label', ['codes'=>$codes] );
	}
}

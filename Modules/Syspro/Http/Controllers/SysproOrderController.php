<?php

namespace Modules\Syspro\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Syspro;
use App\Http\Controllers\Controller;

class SysproOrderController extends Controller
{

	protected $columns = [
		"StockCode",
		"Description",
		"Ordered",
		"Received",
		"PO",
		"OrderPlaced",
		"ESTArrivalDate",
		"DaysPassed",
		"DaysLeft",
	];

	protected $departments = [
		'PL','MIL','MF','EL',"DEC","UPH",
	];

	protected $sortOrder = [
		"ASC", "DESC"
	];


	/**
	 * Form that shows inventory items on order
	 *
	 * @param string $dept
	 * @param string $column
	 * @param string $order
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
	 */
    public function onorder( string $dept = 'PL', string $column = "StockCode", string $order = "ASC" )
    {
	    if (array_search($dept, $this->departments) === false) return "invalid department";
	    if (array_search($column, $this->columns) === false) return "invalid column";
	    if (array_search($order, $this->sortOrder) === false) return "invalid sortOrder";

    	return view('syspro::inventory.onOrder', [
    		'lines'=>Syspro::inventoryOnOrder( $dept, $column, $order ),
		    'dept' => $dept ]);

    }


	/**
	 * form that shows recently received inventory items
	 *
	 * @param string $dept
	 * @param string $column
	 * @param string $order
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
	 */
    public function recentdeliveries( string $dept = 'PL', string $column = "StockCode", string $order = "ASC"  )
    {
	    if (array_search($dept, $this->departments) === false) return "bad department";

	    return view('syspro::inventory.recentDeliveries', [
		    'lines'=>Syspro::recentlyReceivedToInventory( $dept ),
		    'dept' => $dept ]);
    }


	/**
	 * Form that shows open parts build work orders
	 *
	 * @param string $dept
	 * @param string $column
	 * @param string $order
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
	 */
	public function openPartsBuildOrders( string $dept = 'PL', string $column = "StockCode", string $order = "ASC"  )
	{
		if (array_search($dept, $this->departments) === false) return "bad department";

		return view('syspro::inventory.openPartsBuildOrders', [
			'lines'=>Syspro::openPartsBuildOrders( $dept ),
			'dept' => $dept ]);
	}


	/**
	 * returns a finished ogoods on hand form
	 *
	 * @return string
	 */
	public function finishedGoods( )
	{
		//dd(Syspro::finishedGoods(  ));

		return view('syspro::inventory.finishedGoods', [
			'lines'=>Syspro::finishedGoods(  )]);
	}
}

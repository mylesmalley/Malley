<?php

namespace Modules\Syspro\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CountController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('syspro::InventoryCounts.home', [
            'counts' => Inventory::orderBy('created_at','DESC')
            ->get(),
        ]);
    }


    /**
     * @return Response
     */
    public function create(): Response
    {
        return response()
            ->view('syspro::InventoryCounts.counts.create' );
    }
//
//    public function store( Request $request )
//    {
//        $request->validate([
//            'description' => 'required|string|max:250',
//            'user_id' => 'required|int',
//        ]);
//
//        Inventory::create($request->only(['description','user_id']))
//            ->save();
//
//        return redirect('syspro/counts');
//    }



}

<?php

namespace Modules\Syspro\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use \Illuminate\View\View;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountController extends Controller
{
    public function index(): View
    {
        return view('syspro::InventoryCounts.home', [
            'counts' => Inventory::orderBy('created_at','DESC')
            ->get(),
        ]);
    }



    public function create(): View
    {
        return view('syspro::InventoryCounts.counts.create' );
    }

    public function store( Request $request )
    {
        $request->validate([
            'description' => 'required|string|max:250',
            'user_id' => 'required|int',
        ]);

        Inventory::create($request->only(['description','user_id']))
            ->save();

        return redirect('syspro/counts');
    }

    public function edit()
    {

    }

    public function update()
    {

    }


    public function delete()
    {

    }

}

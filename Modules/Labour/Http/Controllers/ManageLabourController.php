<?php

namespace Modules\Labour\Http\Controllers;

use App\Models\Labour;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Auth\Access\AuthorizationException;

class ManageLabourController extends Controller
{

    /**
     * @return View
     * @throws AuthorizationException
     */
    public function home(): View
    {
        $this->authorize('labour_edit', Labour::class);
        return view('labour::management.home', []);
    }



}

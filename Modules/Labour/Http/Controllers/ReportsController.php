<?php

namespace Modules\Labour\Http\Controllers;

use App\Models\Labour;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ReportsController extends Controller
{

    /**
     * @return View
     */
    public function clocked_in(): View
    {
        $this->authorize('labour_edit', Labour::class);

        $labour = Labour::where('end', null)
            ->join('users', 'users.id', '=', 'labour.user_id')
            ->with('user', 'user.department')
            ->orderBy('users.last_name')
            ->get();

        return view('labour::reports.clocked_in', [ 'labour' => $labour ] );

    }




}

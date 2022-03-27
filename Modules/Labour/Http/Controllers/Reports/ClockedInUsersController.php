<?php

namespace Modules\Labour\Http\Controllers\Reports;

use App\Models\Labour;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

class ClockedInUsersController extends Controller
{

    /**
     * @return Response
     * @throws AuthorizationException
     */
    public function clocked_in(): Response
    {
        $this->authorize('labour_edit', Labour::class);

        $labour = Labour::whereNull('end')
            ->join('users', 'users.id', '=', 'labour.user_id')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->orderBy('users.last_name')
            ->get();

        return response()
            ->view('labour::reports.clocked_in', [ 'labour' => $labour ] );

    }




}

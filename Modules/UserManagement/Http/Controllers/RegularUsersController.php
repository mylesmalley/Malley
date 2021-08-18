<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\View\View;

class RegularUsersController extends Controller
{
    /**
     * @return View
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('manage_general_users', User::class );

        return view('usermanagement::regular.index', [
            'users' =>
                User::
//            whereHas('roles', function ($query) {
//                $query->where('name','!=', 'labour');
//            })
//                ->
                with('company')
                ->orderBy('last_name')
                ->paginate(25),
        ]);
    }
//
//    /**
//     * Show the form for creating a new resource.
//     * @return Renderable
//     */
//    public function create()
//    {
//        return view('usermanagement::create');
//    }

//    /**
//     * Store a newly created resource in storage.
//     * @param Request $request
//     * @return Renderable
//     */
//    public function store(Request $request)
//    {
//        //
//    }

    /**
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        $this->authorize('manage_general_users', User::class );

        return view('usermanagement::regular.show', [
            'user' => $user,
            'company'=> $user->company,
        ]);
    }


//
//    /**
//     * Show the form for editing the specified resource.
//     * @param int $id
//     * @return Renderable
//     */
//    public function edit($id)
//    {
//        return view('usermanagement::edit');
//    }
//
//    /**
//     * Update the specified resource in storage.
//     * @param Request $request
//     * @param int $id
//     * @return Renderable
//     */
//    public function update(Request $request, $id)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     * @param int $id
//     * @return Renderable
//     */
//    public function destroy($id)
//    {
//        //
//    }
}

<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class StaffUsersController extends Controller
{
    /**
     * @return Response
     * @throws AuthorizationException
     */
    public function index(): Response
    {
        $this->authorize('manage_production_staff', User::class);

        return response()->view('usermanagement::staff.index', [
            'users' => User::role('labour')
                ->with('department')
                ->orderBy('last_name')
                ->paginate(25),
        ]);
    }

    /**
     * @return Response
     * @throws AuthorizationException
     */
    public function create(): Response
    {
        $this->authorize('manage_production_staff', User::class);

        return response()
            ->view('usermanagement::staff.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('manage_production_staff', User::class);

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'password' => 'required|string|min:6',
        ]);

        $new = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'department_id' => $request->input('department_id'),
            'email' => 'staff.' . $request->input('first_name') . '.' . $request->input('last_name') . '@malleyindustries.com',
            'company_id' => 2, // malley industries
            'password' => Hash::make($request->input('password')),
            'is_enabled' => true,
        ]);

        $new->save();

        $new->assignRole('labour');


        return redirect()->route('staff.index');
    }


    /**
     * @param User $user
     * @return Response
     * @throws AuthorizationException
     */
    public function show(User $user): Response
    {
        $this->authorize('manage_production_staff', User::class);

        return response()
            ->view('usermanagement::staff.show', [
            'user' => $user,
        ]);
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function toggle(User $user): RedirectResponse
    {
        $this->authorize('manage_production_staff', User::class);

        $user->is_enabled = !$user->is_enabled;
        $user->save();
        return redirect()->back();
    }


    /**
     * @param User $user
     * @return Response
     * @throws AuthorizationException
     */
    public function resetPassword(User $user): Response
    {
        $this->authorize('manage_production_staff', User::class);

        return response()
            ->view('usermanagement::staff.resetPassword', ['user' => $user]);
    }


    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function submitResetPassword(Request $request, User $user): RedirectResponse
    {
        $this->authorize('manage_production_staff', User::class);

        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        $user->save();

        return redirect( )
            ->route('staff.index')
            ->with('success', "Changed $user->first_name $user->last_name's password." );
    }



}

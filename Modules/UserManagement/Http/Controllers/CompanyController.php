<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * @return View
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('manage_companies', Company::class );

        //dd( Auth::user()->can('manage_companies') );


        return view('usermanagement::companies.index', [
            'companies' => Company::orderBy('name')
                ->paginate(25),
        ]);
    }


    /**
     * @param Company $company
     * @return View
     * @throws AuthorizationException
     */
    public function show(Company $company): View
    {
        $this->authorize('manage_companies', Company::class );

        return view('usermanagement::companies.show', [
            'company' => $company,
            'active' => User::where('is_enabled', true)
                ->where('company_id', $company->id)
                ->orderBy('last_name')
                ->get(),
            'locked' => User::where('is_enabled', false)
                ->where('company_id', $company->id)
                ->orderBy('last_name')
                ->get(),
        ]);
    }


    /**
     * @return View
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('manage_companies', Company::class );

        return view('usermanagement::companies.create');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store( Request $request ): RedirectResponse
    {
        $this->authorize('manage_companies', Company::class );

        $request->validate([
            'name' => 'required|string',
            'logo' => 'required|mimes:png|max:300',
        ]);

        $company = Company::create( $request->only('name') );

        $logo = request()->file('logo');

        $company->addMedia($logo)
            ->toMediaCollection('logo', 's3');

        return redirect()->route('companies.show', [ $company->id ]);
    }


}

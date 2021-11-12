<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use Illuminate\Http\Request;
//use App\Mail\BlueprintCreatedNotification;
use App\Models\Form;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\BlueprintWizardAnswer;
use Illuminate\Http\RedirectResponse;
use App\Models\Blueprint;
use App\Models\BaseVan;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Modules\Blueprint\Jobs\ResetRenderTemplates;
use Modules\Blueprint\Jobs\EmaiStaffAboutBlueprintCreation;
use Modules\Blueprint\Jobs\UpgradeBlueprint;

class CreateController extends Controller
{

    /**
     * @param BaseVan $baseVan
     * @return View
     * @throws AuthorizationException
     */
    public function create( BaseVan $baseVan ): View
    {
        $this->authorize( 'create', Blueprint::class );

        return view('blueprint::blueprint.create', [
            'baseVan' => $baseVan,
        ]);
    }


    /**
     * This is the function that actually creatse a blueprint
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store( Request $request ): RedirectResponse
    {
        $this->authorize( 'create', Blueprint::class );

        $request->validate([
            "customer_name" => "nullable:255",
            "customer_address_1" => "nullable|max:255",
            "customer_address_2" => "nullable|max:255",
            "customer_address_3" => "nullable|max:255",
            "customer_city"      => "nullable|max:50",
            "customer_province"  => "nullable|max:20",
            "customer_country"   => "nullable|max:20",
            "customer_postalcode"=> "nullable|max:10",
            "customer_email"     => "nullable|email|max:50",
            "customer_phone"     => "nullable|max:255",
            "customer_fax"       => "nullable|max:255",
            "customer_website"   => "nullable|url|max:255",
            "customer_logo"      => "nullable|max:255",
            'name'               => 'string|min:2|max:255',
            'description'        => 'string|nullable|max:255',
            'base_van_id' => 'required|integer',
            'layout_id'=>'nullable|integer',
        ]);

        // create the new blueprint
        $blueprint = new Blueprint( $request->only( [
            'name', 'description', 'base_van_id', 'layout_id', 'config',
             "customer_name",
            "customer_address_1",
            "customer_address_2",
            "customer_address_3",
            "customer_city",
            "customer_province",
            "customer_country",
            "customer_postalcode",
            "customer_email",
            "customer_phone",
            "customer_fax",
            "customer_website",
            "customer_logo",

        ] ) );

        // apply the blueprint to the authorized user
        $blueprint = Auth::user()->blueprints()->save( $blueprint );

        // upgrade that blueprint
        UpgradeBlueprint::dispatch( $blueprint );

        // associate the blueprint with templates
        ResetRenderTemplates::dispatch( $blueprint );

        // fire off emails if necessary
        EmaiStaffAboutBlueprintCreation::dispatch( $blueprint );

        return redirect()
            ->route('blueprint.home', [ $blueprint ]);
    }

}

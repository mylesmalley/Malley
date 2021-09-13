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


        // create the new blueprint
        $blueprint = new Blueprint( $request->only( 'name', 'description', 'base_van_id', 'layout_id', 'config' ) );

        // apply the blueprint to the authorized user
        $blueprint = Auth::user()->blueprints()->save( $blueprint );

        return redirect()
            ->route('blueprint.home', [ $blueprint ]);


//        // run upgrade once to gendc ZXerate the new configurations
//        //	$blueprint->upgrade();
//        app('App\Http\Controllers\Blueprint\ShowController')->upgrade( $blueprint );
//
//        //	$blueprint->resetRenderTemplates();
//
//
//
//        // if a layout is provided, reset the configuration and turn on those options instead.
//        if ( $request->layout_id ) {
//            $blueprint->createFromLayout();
//        }
//
//        // create references to renders
//        $blueprint->resetRenderTemplates();
//
//
//        // FIRE OUT AN EMAIL NOTIFICATION
//
//        $usersToReceive = User::where('email_when_blueprint_created', true)->pluck('email');
//        if (count($usersToReceive))
//        {
//            Mail::to( $usersToReceive )
//                ->send( new BlueprintCreatedNotification( $blueprint ) );
//
//        }
//
//
//        /*
//         * if the blueprint has a layout image, clone it
//         */
//        if ($blueprint->layout->media->first() )
//        {
//            $blueprint->addMediaFromUrl( $blueprint->layout->media->first()->cdnUrl() )
//                ->usingName( 'layoutImage' )
//                ->usingFileName( 'layoutImage' .'.png' )
//                ->toMediaCollection('images', 's3');
//        }
//
//
//        /*
//         * if the base van has a light pod image, clone it
//         */
//        if ($blueprint->platform->getMedia('lightpods')->count() >= 1 )
//        {
//            $blueprint->addMedia( $blueprint->platform->getMedia('lightpods')->first()->getPath() )
//                ->usingName( 'lightpods' )
//                ->usingFileName( 'lightpods' . '.png' )
//                ->preservingOriginal()
//                // specifying s3
//                ->toMediaCollection('images', 's3');
//        }
//
//
//
//        // if the blueprint has forms containing images, this will refresh to generate them.
//        $forms = Form::query()->where('base_van_id',$blueprint->base_van_id)
//            ->with(['elements' => function ($query) {
//                $query->where('type', 'images');
//            }, 'elements.items','elements.items.media','elements.items.option'])
//            ->get();
//
//
//        // if it's a ford transit mobility, go right into the configuration form
//        if ( $blueprint->base_van_id == 11 )
//            return redirect( "blueprint/{$blueprint->id}/form/66" );
//
//        if ( $blueprint->base_van_id == 12 )
//            return redirect( "blueprint/{$blueprint->id}/form/69" );
//
//
//        if ( count($forms)) return redirect("blueprint/{$blueprint->id}/refresh");
//
//        return redirect("blueprint/".enc($blueprint->id));

    }

}

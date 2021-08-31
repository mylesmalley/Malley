<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\View\View;
use App\Models\Blueprint;
use App\Http\Controllers\Controller;
use App\Models\Configuration;

class QuoteController extends Controller
{

    /**
     * shows a page that allows for the creation and editing of quotes for blueprints
     *
     * @param Blueprint $blueprint
     * @return View
     * @throws AuthorizationException
     */
    public function show( Blueprint $blueprint ): View
    {
        $this->authorize('edit_configuration', $blueprint);


        $configs = Configuration::where('blueprint_id', $blueprint->id )
            ->where('obsolete', false)
            ->where('value', 1)
            // narrow things down a bit...
            ->select([
                'id','name','description','obsolete','value', 'quantity','price_tier_3','price_tier_2'
            ])
            // don't filter at all if showAll is present
//            ->when($showAll, function( $query ) {  })
//            // filter all but value > 0 if showAll not present
//            ->when(!$showAll, function( $query ) {
//                return $query->where('value', '>', 0);
//            })
//            // handle sort order and direction if present
//            ->when($orderBy, function( $query, $orderBy ) use ($sortOrder) {
//                return $query->orderBy( $orderBy, $sortOrder );
//            })
            ->get();

        // lets role!
        return view('blueprint::quote.show', [
            'blueprint' => $blueprint,
            'configurations' => $configs,
        ]);
    }








    public function output_to_pdf( Blueprint $blueprint, string $type = 'no_pricing' )
    {
        dd( $blueprint );
    }



}

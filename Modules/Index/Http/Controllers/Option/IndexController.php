<?php

namespace Modules\Index\Http\Controllers\Option;


use App\Http\Controllers\Controller;
use App\Models\BaseVan;
use App\Models\Option;
use App\Models\OptionTag;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @param BaseVan $baseVan
     * @return View
     */
    public function show( BaseVan $baseVan, Request $request): View
    {

        $categories = Tag::where('base_van_id', $baseVan->id)
            ->where('model', 'option')
            ->orderBy('name', 'ASC')
            ->pluck('name', 'id')->toArray();


        $tags = $request->tags ?? null;

        /**
         * start building the query...
         */
        $db = Option::where('base_van_id', $baseVan->id);
        $db->with([
            'tags',
        ]);

//        if ( isset( $request->filter ) && in_array( $request->filter, array_keys($categories) ) )
//        {
//            $filter_string = "{$baseVan->option_prefix}-{$request->filter}%";
//
//            $db->where('option_name', 'like', $filter_string );
//        }


        if ( !$tags )
        {

            if (isset($request->filter) && in_array($request->filter, array_keys($categories))) {
                //      $filter_string = "{$baseVan->option_prefix}-{$request->filter}%";
                $db->whereHas('tags', function ($q) use ($request) {
                    $q->where('tag_id', $request->filter);
                });
    //            $db->where('option_name', 'like', $filter_string );
            }

        }
        else
        {
            $tags = explode( ',', $tags );

            $options = [];

            foreach( $tags as $t)
            {
                $options[] = OptionTag::where('tag_id', '=', $t )
                    ->pluck('option_id')
                    ->toArray();
            }

            $remaining = $options[0];

            foreach( $options as $o )
            {
                $remaining = array_intersect( $remaining, $o );
            }

            $db->whereIn('id', $remaining);

//            $db->whereHas('tags', function ($q) use ($tags) {
//                $q->whereIn('tag_id', $tags);
//            })

        }


        /**
         * filter if the user does not want to see obsolete items
         */
        if (isset(Auth::user()->index_show_obsolete_options)
            && !Auth::user()->index_show_obsolete_options) {
            $db->where('obsolete', '!=', true);
        }

        /**
         * filter if the user wants to see blueprint only options
         */
        if (isset(Auth::user()->index_show_blueprint_only_options)
            && !Auth::user()->index_show_blueprint_only_options) {
            $db->where('option_name', 'not like', '%-Z%');
        }


        /**
         * order and sort column
         */
        if (isset($request->sort)
            && in_array($request->sort, ['option_name', 'option_description', 'created_at', 'updated_at'])
            && isset($request->order)
            && in_array($request->order, ['ASC', 'DESC'])) {

            $db->orderBy($request->sort, $request->order);
        } else
        {
            $db->orderBy('option_name' );

        }



        $options = $db->get();



        return view('index::index.show', [
            'basevan' => $baseVan,
            'options' => $options,
            'total' => $options->count(),
            'categories' => $categories,
        ]);
    }


    /**
     * @return View
     */
    public function editPreferences(): View
    {
        return view('index::index.preferences',['user'=>Auth::user() ]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function savePreferences( Request $request ): RedirectResponse
    {
        $user = User::findOrFail( $request->user_id );

        $user->update( $request->only(['index_show_obsolete_options',
            'index_show_blueprint_only_options',
            'index_show_id_column',
            'index_show_phantom_column',
            'index_show_tags_column',
            'index_show_errors_column',
            'index_show_pricing_columns',
        ]) );

        $user->save();

        return redirect( $request->referer )
            ->with('message','Saved Preferences');
    }

}

<?php

namespace Modules\Index\Http\Controllers\Option;


use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\LayoutOption;
use App\Models\FormElementItem;
use App\Models\TemplateOption;
use Illuminate\Support\Facades\Auth;


class DeleteController extends Controller
{
    /**
     * @param Option $option
     */
    public function delete( Option $option )
    {
        if( Auth::user()->id === 3)
        {

            $option->components()->delete();

            $option->configurations()->delete();

            $media = $option->media;
            foreach( $media as $m )
            {
                $m->delete();
            }

            LayoutOption::where('option_id', $option->id )
                ->delete();

            FormElementItem::where('option_id', $option->id )
                ->delete();

            TemplateOption::where('option_id', $option->id )
                ->delete();

            $option->rules()->delete();

            $option->relatedRules()->delete();

            $index = $option->base_van_id;
            $option->delete();
        }

        return redirect('/index/'.$index );

    }


}

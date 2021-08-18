<?php

namespace Modules\Index\Http\Controllers\FormElement;


use App\Models\FormElement;
use App\Models\FormElementRule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;

class RuleController extends Controller
{

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function add( Request $request ): RedirectResponse
    {
        $el = FormElement::find( $request->input('form_element_id' ));

        // option doesn't already have a rule
        if ( ! $el->rule )
        {
            FormElementRule::create([
                'form_element_id' => $request->input('form_element_id' ),
                'operator' => 'ANY',
                'options' => json_encode( [ $request->input('option_name') ] ),
            ]);
        }

        $existingOptions = json_decode( $el->rule->options ) ?? [];

            if(!in_array( $request->input('option_name') , $existingOptions  ) )
            {
                $existingOptions[] = $request->input('option_name');
                $el->rule->update([
                    'options' => json_encode( array_values( $existingOptions ) )
                ]);
            }



       return redirect()->back();
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function remove( Request $request ): RedirectResponse
    {

        $el = FormElement::find( $request->input('form_element_id' ));

        // option doesn't already have a rule
        if ( ! $el->rule )
        {
            return redirect()->back();
        }

        $existingOptions = json_decode( $el->rule->options);
        if (($key = array_search( $request->input('option_name'), $existingOptions)) !== false) {

            unset($existingOptions[$key]);

            $el->rule->update([
                'options' => json_encode( array_values( $existingOptions ) )
            ]);
        }

        return redirect()->back();

    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function change( Request $request ): RedirectResponse
    {
        $el = FormElement::find( $request->input('form_element_id' ));

        // option doesn't already have a rule
        if ( ! $el->rule )
        {
            FormElementRule::create(['form_element_id' => $request->input('form_element_id' ),
                'operator' => 'ANY',
                'options' => json_encode( [] ),
            ]);
            return redirect()->back();

        }

        $el->rule->update([
            'operator' => json_encode( 'ANY' )
        ]);

        return redirect()->back();

    }

}



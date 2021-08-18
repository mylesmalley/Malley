<?php

namespace Modules\Index\Http\Controllers\Option;


use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Blueprint;
use App\Models\BaseVan;
use App\Models\Option;

use \Illuminate\View\View;
use \Illuminate\Http\Request;

class CreateController extends Controller
{

    public function create( BaseVan $basevan ): View
    {
        /** REMOVE WHEN NEW PHANTOM APPROACH ACCEPTED */
      //  if ($basevan->id != 10) die('currently disabled');

        return view('index::options.new_create', ['basevan'=>$basevan]);
    }



    protected $messages = [];
    protected $errors = [];


    public function store( Request $request )
    {
        /** REMOVE WHEN NEW PHANTOM APPROACH ACCEPTED */
     //   if ($request->base_van_id != 10) die('currently disabled');

        $request->validate([
            'base_van_id' => 'required',
            'engineering_notes' => 'required|string|max:100',
            'nameIdentifier' => 'required|alpha_num|max:4',
          'nameRevision'=> "required|max:999|numeric",

            'option_name' => [
                function ($attribute, $value, $fail) use ($request) {

                    $find = Option::where('option_name', strtoupper( $request->namePrefix .
                        '-' . $request->nameIdentifier .
                        '-' . $request->nameRevision ) )->count();

                    if ($find) {
                        $fail($attribute." must be unique");
                    }
                },
            ],

            "option_description"     => 'required|max:100',
     //       "option_syspro_phantom" => 'nullable|alpha_dash|max:30',
            "option_price_tier_2"    => 'required|numeric',
            "option_price_tier_3"    =>  'required|numeric',
            "option_price_dealer_offset"    =>  'numeric',
            "option_price_msrp_offset"    =>  'numeric',
            "option_labour_qty"    =>  'numeric',
            "option_labour_cost"    =>  'numeric',
            "option_long_lead_time"    => 'required|boolean',
            "option_show_on_quote"     => 'required|boolean',
            'has_pricing' => 'boolean',
            'show_on_templates' => 'boolean',
            'show_on_forms' => 'boolean',

        ]);


        // create the new option from the old one, and update it with the fields supplied
     //   $new = Option::create( $request->except('option_name') );
        $new = new Option( $request->all() );

        $new->option_name = strtoupper( $request->namePrefix .
            '-' . $request->nameIdentifier .
            '-' . $request->nameRevision );

        $new->obsolete = false;
        $new->save();


        $this->messages[] = "Created a new option.";


        // copy any components from the old to new, but preserve old
        if ( $request->option_syspro_phantom )
        {
            // if a phantom is provided, try to import the components
            $import = $new->importComponentsFromSyspro();

            // if no phantom was found in syspro, send an error message.
            if (!$import )
            {
                $this->errors[] = "The Syspro phantom number provided doesn't appear to be valid or there was a problem recovering components.";
            }
            else
            {
                $this->messages[] = "Synced components from Syspro using the phantom provided. ";
            }
        }


        // select all active blueprints for this base van
        $blueprints = Blueprint::where('is_locked',false)
            ->where('base_van_id', $request->base_van_id )
            ->pluck('id');


        $config = [
            "option_id" => $new->id,
            'revision' => 1,
            "name" => $new->option_name,
            "description" => $new->option_description,
            "syspro_phantom" => $new->option_syspro_phantom,
            "price_tier_2" => $new->option_price_tier_2,
            "price_tier_3" => $new->option_price_tier_3,
            "price_dealer_offset" => $new->option_price_dealer_offset,
            "price_msrp_offset" => $new->option_price_msrp_offset,
            "value" => 0,
            'long_lead_time' => $new->option_long_lead_time,
            'show_on_quote' => $new->option_show_on_quote,
            'light_component' => "",
            'locked' => 0,
            'fingerprint' => $new->fingerprint,
        ];

        foreach ( $blueprints as $blueprint )
        {
            $opt = new Configuration( $config );
            $opt->blueprint_id = $blueprint;
            $opt->save();
        }



        return redirect("/index/option/{$new->id}/home")
            ->with(['errors'=>$this->errors, 'info'=>$this->messages ]);

    }




}

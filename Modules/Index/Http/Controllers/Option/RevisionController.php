<?php

namespace Modules\Index\Http\Controllers\Option;


use App\Http\Controllers\Controller;
use App\Models\MediaTag;
use App\Models\Option;
use App\Models\FormElementItem;
use App\Models\TemplateOption;
use App\Models\LayoutOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevisionController extends Controller
{
    /**
     * @param Option $option
     * @return Response
     */
    public function create( Option $option ): Response
    {
        /** REMOVE WHEN NEW PHANTOM APPROACH ACCEPTED */
    //    if ($option->base_van_id != 10) die('currently disabled');

        return response()
            ->view('index::options.revision', ['option'=>$option]);
    }



    protected $messages = [];


    /*
     * 
     */
    public function store( Request $request )
    {

        $request->validate([
            'engineering_notes' => 'required|string',

            "option_description"     => 'required|max:100',

          //  "option_syspro_phantom" => 'nullable|alpha_dash|max:30',

            "option_price_tier_2"    => 'required|numeric',
            "option_price_tier_3"    =>  'required|numeric',
            "option_price_dealer_offset"    =>  'numeric',
            "option_price_msrp_offset"    =>  'numeric',

            "option_labour_qty"    =>  'numeric',
            "option_labour_cost"    =>  'numeric',
            'show_on_templates' => 'boolean',
            'show_on_forms' => 'boolean',

            "option_long_lead_time"    => 'required|boolean',
            "option_show_on_quote"     => 'required|boolean',
            'has_pricing' => 'boolean',

        ]);


        $new = $this->generate_revision( $request );

        // container for any errors to be passed to the user upon redirection
        $errors = [];

        return redirect("/index/option/{$new->id}/home")->with(['errors'=>$errors, 'info'=>$this->messages ]);

    }



    public function revisionFromComponentsPage( Request $request )
    {

        $request->validate([
            'engineering_notes' => 'required|string', //change notes
            "option_name"     => 'required', // used to find revisions
        ]);


        $new = $this->generate_revision( $request );

        // container for any errors to be passed to the user upon redirection
        $errors = [];
        $this->messages[] = "Pushed new changes to Syspro";

        return redirect("/index/option/{$new->id}/home")->with(['errors'=>$errors, 'info'=>$this->messages ]);
//        return redirect("/index/option/".$new->nextID."/components");


    }



    public function revisionFromPricing( Request $request )
    {

        $request->validate([
            'engineering_notes' => 'required|string', //change notes
            "option_name"     => 'required', // used to find revisions
            "option_price_tier_2"    => 'required|numeric|lte:option_price_tier_3',
            "option_price_tier_3"    =>  'required|numeric|gte:option_price_tier_2',
            "option_price_dealer_offset"    =>  'numeric',
            "option_price_msrp_offset"    =>  'numeric',
        ]);


        $new = $this->generate_revision( $request );

        // container for any errors to be passed to the user upon redirection
        $errors = [];
        $this->messages[] = "Pushed new changes to Syspro";

        if ( $new->nextID )
        {
            return redirect()->route('option.pricing.form', [ $new->nextID ])
                ->with([ 'success'=>$this->messages ]);
        }
        
        return redirect()->route('option.home', [$new] )
            ->with(['errors'=>$errors, 'info'=>$this->messages ]);
        
 

    }


//    /**
//     * @param Request $request
//     * @return bool
//     */
//    public function generate_revision_from_pricing_livewire_component( Request $request ): bool
//    {
//
//        $request->validate([
//            'engineering_notes' => 'required|string', //change notes
//            "option_name"     => 'required', // used to find revisions
//            "option_price_tier_2"    => 'required|numeric|lte:option_price_tier_3',
//            "option_price_tier_3"    =>  'required|numeric|gte:option_price_tier_2',
//
//        ]);
//
//        return true;
//
//        //$new = $this->generate_revision( $request );
//
//        // container for any errors to be passed to the user upon redirection
//        $errors = [];
//        $this->messages[] = "Pushed new changes to Syspro";
//
//    }






    /**
     * function that actually creates the revision and marks the old rev as obsolete
     *
     * @param Request $request
     * @return Option
     */
    private function generate_revision( Request $request ) : Option
    {


        // base everything off of the newest revision prior to these changes.
        $old = Option::where('option_name', $request->option_name )
            ->orderBy('revision','DESC')
            ->get()
            ->first();

        /** REMOVE WHEN NEW PHANTOM APPROACH ACCEPTED */
     //   if ($old->base_van_id != 10) die('currently disabled');


        if ( $old->revision == $request->revision )
        {
            die( "You can't submit a form twice." );
            //return redirect("/index/option/{$old->id}/home")->with(['errors'=> $errors]);
        }




        // create the new option from the old one, and update it with the fields supplied
        $new = $old->replicate()
            ->fill( $request->except(['id','revision']) );

        $new->revision ++; // increment the revision number
        $new->obsolete = false;
        $new->user_id = Auth::user()->id;
        $new->save();

        // create a new phantom number for this revision
        $sysproPhantomNumber = $old->option_name . '-'. str_pad("".($new->revision ), 3, '0', STR_PAD_LEFT, );

        // stored procedure that creates records in syspro
        DB::connection('syspro')
            ->update("EXEC dbo.spInsertPhantom
                        @StockCode = ?,
                        @Description = ?,
                        @LongDesc = ? ",
                [
                    $sysproPhantomNumber,
                    substr( $new->option_description, 0, 30), // desc for short desc
                    substr( $new->engineering_notes, 0, 30), // revision notes for long desc
                ]);

        // stored procedure that updates the comments
        DB::connection('syspro')
            ->update("EXEC dbo.spInsertPhantomComment
                        @StockCode = ?,
                        @Text = ?",
                [
                    $sysproPhantomNumber,
                    substr( $new->option_description, 0, 45),
                ]);


        // update the new revision option with the newly created phantom number from syspro
        $new->option_syspro_phantom = $sysproPhantomNumber;
        $new->save();




        // mark the old one as obsolete;
        $old->obsolete = true;
        $old->save();


        $this->messages[] = "Created a new revision and marked the old one as obsolete.";


        // copy any components from the old to new, but preserve old


        $this->copy_components( $old, $new );
        $this->messages[] = "Copied components from the old revision";




        // duplicate rules and reassign related ones handle rules and related rules
        $this->copy_rules( $old, $new );
        $this->copy_related_rules( $old, $new );


        // duplicate related media...
        // fix references to form images to reference duplicated drawings
        $this->copy_drawings_and_update_references( $old, $new );
        $this->copy_photos( $old, $new );
        $this->copy_wizard_image( $old, $new );



        // duplicate the tags to the new revision
        $this->copy_tags( $old, $new );



        // update the form references to point to the new option
        // update form_element_items set option_id = @new where option_id = @old;
        $updatedFormElements = FormElementItem::where('option_id', $old->id )
            ->update([
                'option_id' => $new->id,
            ]);
        $this->messages[] = "Updated {$updatedFormElements} references in forms to newest revision ";


        // update the drawing templates to point to the newest revision
        //  update template_options set option_id = @new where option_id = @old;
        $updatedTemplates = TemplateOption::where('option_id', $old->id )
            ->update([
                'option_id' => $new->id,
            ]);
        $this->messages[] = "Moved {$updatedTemplates}  references in drawing packages";


        // update all layout references
        // update layout_options set option_id = @new where option_id = @old;
        $updatedLayoutOptions = LayoutOption::where('option_id', $old->id )
            ->update([
                'option_id' => $new->id,
            ]);
        $this->messages[] = "Updated {$updatedLayoutOptions} references in layouts. ";



        // if required, update all appropriate blueprint configurations
        $this->copyConfigurationsAndUpdateReferences( $old, $new );






        // wizard actions
        DB::table('wizard_actions')
            ->where('option_id', $old->id )
            ->update(['option_id' => $new->id]);


        Log::info("Option $old->id ($old->option_name), replaced by $new->id ");

        return $new;
    }




    /**
     * copies components from an option to another
     *
     * @param Option $old
     * @param Option $new
     * @return void
     */
    private function copy_components( Option $old, Option $new ): void
    {
        $components = $old->components()->get();

        foreach( $components as $component )
        {
            $c =  $component->replicate()->fill([
                'option_id' => $new->id,
            ]);
            $c->save();


            DB::connection('syspro')
                ->update("EXEC dbo.spInsertPhantomComponent
                        @ParentPart = ?,
                        @Component = ?,
                        @QtyPer = ?,
                        @CreateSubJob ='N'",
                    [
                        $new->option_syspro_phantom,
                        $component->component_stock_code,
                        $component->component_material_qty,
                    ]);

        }

    }



    /**
     * copies components from an option to another
     *
     * @param Option $old
     * @param Option $new
     * @return bool
     */
    private function copyConfigurationsAndUpdateReferences( Option $old, Option $new ): bool
    {
        $configurations = $old->configurations()
            ->where('locked', false) // only update and replace config items that aren't locked
            ->get();

        $counter = 0;

        // duplicate the existing configuration references
        foreach( $configurations as $config )
        {

            /*
             * Sept 1, 2021
             * Tony Goss requested ability to 'lock' pricing on a config line so that it wouldn't be overwritten by a change
             * or new revision
             *
             * if $config->lock_pricing is false, the default, do what has always been done.
             * if it is TRUE, still update all other elements but skip over pricing lines.
             */
            if ( ! $config->lock_pricing )
            {
                $newconfig = $config->replicate()
                ->fill( [
                    "name" => $new->option_name,
                    "description" => $new->option_description,
                    "syspro_phantom" => $new->option_syspro_phantom,
                    "price_tier_2" => $new->option_price_tier_2,
                    "price_tier_3" => $new->option_price_tier_3,
                    "price_dealer_offset" => $new->option_price_dealer_offset,
                    "price_msrp_offset" => $new->option_price_msrp_offset,
                    'long_lead_time' => $new->option_long_lead_time,
                    'show_on_quote' => $new->option_show_on_quote,
                    'light_component' => $new->option_light_component,
                    'fingerprint' => $new->fingerprint,
                    'obsolete' => 0,
                    'revision' => $new->revision,
                ]);
            }
            else
            {
                $newconfig = $config->replicate()
                    ->fill( [
                        "name" => $new->option_name,
                        "description" => $new->option_description,
                        "syspro_phantom" => $new->option_syspro_phantom,
//                        "price_tier_2" => $new->option_price_tier_2,
//                        "price_tier_3" => $new->option_price_tier_3,
//                        "price_dealer_offset" => $new->option_price_dealer_offset,
//                        "price_msrp_offset" => $new->option_price_msrp_offset,
                        'long_lead_time' => $new->option_long_lead_time,
                        'show_on_quote' => $new->option_show_on_quote,
                        'light_component' => $new->option_light_component,
                        'fingerprint' => $new->fingerprint,
                        'obsolete' => 0,
                        'revision' => $new->revision,
                    ]);
            }


            $newconfig->option_id = $new->id;
            $newconfig->save();
            $counter++;
        }

        // turn off references to old revision
        $updated = $old->configurations()
            ->where('locked', false) // only update and replace config items that aren't locked
            ->update([
            'value'=> 0,
            'obsolete'=> 1
        ]);

        // fire off some happy messages.
        $this->messages[] = "Added {$new->fullName} to {$counter} Blueprints.";
        $this->messages[] = "$updated Blueprints that had revision {$old->revision} turned on now have revision $new->revision instead.";

        return true;
    }



    /**
     * copies rules for an option
     *
     * @param Option $old
     * @param Option $new
     * @return void
     */
    private function copy_rules( Option $old, Option $new ): void
    {
        $relatedRules = $old->rules()->get();

        foreach( $relatedRules as $rule )
        {
            $rule->replicate();
            $rule->option_id = $new->id;
            $rule->save();
        }


    }



    /**
     * copies rules for an option
     *
     * @param Option $old
     * @param Option $new
     * @return void
     */
    private function copy_tags( Option $old, Option $new ): void
    {
        $tags = $old->tags;

//        dd( $tags );
        foreach( $tags as $tag )
        {

            DB::table('option_tags')->insert([
                'option_id' => $new->id,
                'tag_id' => $tag->id,
            ]);

        }


    }




    /**
     * @param Option $old
     * @param Option $new
     * @return void
     */
    private function copy_drawings_and_update_references( Option $old, Option $new ): void
    {
        $media = $old->getMedia('drawings');
        $changeCount = 0;
        foreach( $media as $med )
        {
            $copiedMedia = $med->copy( $new, 'drawings', 's3');

            FormElementItem::where('media_id', $med->id )
                ->update([
                    'media_id' => $copiedMedia->id,
                ]);

            foreach( $med->tags as $tag )
            {

                MediaTag::updateOrCreate([
                    'media_id' => $copiedMedia->id,
                    'tag_id' => $tag->id,
                ])->save();
            }

            $changeCount++;
        }

        $this->messages[] = "Updated {$changeCount} references to images in forms.";

    }


    /**
     * @param Option $old
     * @param Option $new
     * @return void
     */
    private function copy_photos(  Option $old, Option $new ): void
    {
        $media = $old->getMedia('photos');
        foreach( $media as $med )
        {
            $med->copy( $new, 'photos', 's3');
        }
    }


    /**
     * @param Option $old
     * @param Option $new
     * @return void
     */
    private function copy_wizard_image(  Option $old, Option $new ): void
    {
        $media = $old->getMedia('wizard_image');
        foreach( $media as $med )
        {
            $med->copy( $new, 'wizard_image', 's3');
        }
    }


    /**
     * copies related rules for an option
     *
     * @param Option $old
     * @param Option $new
     * @return void
     */
    private function copy_related_rules( Option $old, Option $new ): void
    {
        $rules = $old->relatedRules()->get();

        foreach( $rules as $rule )
        {

            $rule->related_option_id = $new->id;
            $rule->save();
        }

    }




}



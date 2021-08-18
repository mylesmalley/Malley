<?php

namespace Modules\Index\Http\Controllers\Option;


use App\Http\Controllers\Controller;
use App\Models\MediaTag;
use App\Models\Option;
use App\Models\FormElementItem;
use App\Models\TemplateOption;
use App\Models\LayoutOption;
use Illuminate\Support\Facades\DB;
use \Illuminate\View\View;
use \Illuminate\Http\Request;

class CloneController extends Controller
{
    /**
     * @param Option $option
     * @return View
     */
    public function form( Option $option ): View
    {
        return view('index::options.clone', ['option'=>$option]);
    }



    protected $messages = [];


    public function clone( Request $request )
    {

        $request->validate([
            'engineering_notes' => 'required|string',
            "option_description"     => 'required|max:100',
            "option_name"     => 'required|max:100',
            "option_syspro_phantom" => 'nullable|alpha_dash|max:30',
            "user_id" => "required|int",
            "old_name" =>  'required|max:100',
        ]);


        // base everything off of the newest revision prior to these changes.
        $old = Option::where('option_name', $request->old_name )
            ->orderBy('revision','DESC')
            ->get()
            ->first();

        // container for any errors to be passed to the user upon redirection
        $errors = [];


        // create the new option from the old one, and update it with the fields supplied
        $new = $old->replicate()
            ->fill( $request->except(['id','revision','old_name']) );

        $new->revision = 1; // increment the revision number
        $new->save();


        $this->messages[] = "Cloned {$request->old_name}.";


        if ( $request->option_syspro_phantom  )
        {
            // if a phantom is provided, try to import the components
            $import = $new->importComponentsFromSyspro();

            // if no phantom was found in syspro, send an error message.
            if (!$import )
            {
                $errors[] = "The Syspro phantom number provided doesn't appear to be valid or there was a problem recovering components.";
            }
            else
            {
                $this->messages[] = "Synced components from Syspro using the phantom provided. ";
            }
        }



        // duplicate rules and reassign related ones handle rules and related rules
        $this->copyRules( $old, $new );
        $this->copyRelatedRules( $old, $new );


        // duplicate related media...
        // fix references to form images to reference duplicated drawings
        $this->copyDrawingsAndUpdateReferences( $old, $new );
        $this->copyPhotos( $old, $new );


        // duplicate the tags to the new revision
        $this->copyTags( $old, $new );



        // update the form references to point to the new option
        // update form_element_items set option_id = @new where option_id = @old;
//        $updatedFormElements = FormElementItem::where('option_id', $old->id )
//            ->update([
//                'option_id' => $new->id,
//            ]);
//        $this->messages[] = "Updated {$updatedFormElements} references in forms to newest revision ";
//

        // update the drawing templates to point to the newest revision
        //  update template_options set option_id = @new where option_id = @old;
//        $updatedTemplates = TemplateOption::where('option_id', $old->id )
//            ->update([
//                'option_id' => $new->id,
//            ]);
//        $this->messages[] = "Moved {$updatedTemplates}  references in drawing packages";


        // update all layout references
        // update layout_options set option_id = @new where option_id = @old;
//        $updatedLayoutOptions = LayoutOption::where('option_id', $old->id )
//            ->update([
//                'option_id' => $new->id,
//            ]);
//        $this->messages[] = "Updated {$updatedLayoutOptions} references in layouts. ";
//


        // if required, update all appropriate blueprint configurations
//        $this->copyConfigurationsAndUpdateReferences( $old, $new );



        return redirect("/index/option/{$new->id}/home")->with(['errors'=>$errors, 'info'=>$this->messages ]);

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
        $this->messages[] = "{$updated} Blueprints that had revision {$old->revision} turned on now have revision {$new->revision} instead.";

        return true;
    }



    /**
     * copies rules for an option
     *
     * @param Option $old
     * @param Option $new
     * @return bool
     */
    private function copyRules( Option $old, Option $new ): bool
    {
        $relatedRules = $old->rules()->get();

        foreach( $relatedRules as $rule )
        {
            $rule->replicate();
            $rule->option_id = $new->id;
            $rule->save();
        }


        return true;
    }



    /**
     * copies rules for an option
     *
     * @param Option $old
     * @param Option $new
     * @return bool
     */
    private function copyTags( Option $old, Option $new )
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


        return true;
    }




    /**
     * @param Option $old
     * @param Option $new
     * @return bool
     */
    private function copyDrawingsAndUpdateReferences(  Option $old, Option $new ): bool
    {
        $media = $old->getMedia('drawings');
        $changeCount = 0;
        foreach( $media as $med )
        {
            $copiedMedia = $med->copy( $new, 'drawings', 's3');

//            FormElementItem::where('media_id', $med->id )
//                ->update([
//                    'media_id' => $copiedMedia->id,
//                ]);

            foreach( $med->tags as $tag )
            {
       //         dd( $tag );
//                $tag->replicate()->fill([
//                    'media_id' => $copiedMedia->id,
//                ]);
                MediaTag::updateOrCreate([
                    'media_id' => $copiedMedia->id,
                    'tag_id' => $tag->id,
                ])->save();
            }

            $changeCount++;
        }

        $this->messages[] = "Updated {$changeCount} references to images in forms.";

        return true;
    }


    /**
     * @param Option $old
     * @param Option $new
     * @return bool
     */
    private function copyPhotos(  Option $old, Option $new ): bool
    {
        $media = $old->getMedia('photos');
        foreach( $media as $med )
        {
            $med->copy( $new, 'photos', 's3');
        }
        return true;
    }


    /**
     * copies related rules for an option
     *
     * @param Option $old
     * @param Option $new
     * @return bool
     */
    private function copyRelatedRules( Option $old, Option $new ): bool
    {
        $rules = $old->relatedRules()->get();

        foreach( $rules as $rule )
        {
            // don't replicate because it will clog up current options with outdated references
           //     $rule->replicate();
            $rule->related_option_id = $new->id;
            $rule->save();
        }

        return true;
    }

}


//( App\Models\FormElementItem::where('form_element_id', 174 ))->each( function( $val, $key ){
//    if(App\Models\Media::find($val->media_id)) \
//    App\Models\MediaTag::updateOrCreate(['media_id'=> $val->media_id, 'tag_id'=> 55 ])->save();
//});
//( App\Models\FormElementItem::where('form_element_id', 80 ))->each( function( $val, $key ){
//    if(App\Models\Media::find($val->media_id)) \
//    App\Models\MediaTag::updateOrCreate(['media_id'=> $val->media_id, 'tag_id'=> 81 ])->save();
//});
//( App\Models\FormElementItem::where('form_element_id', 71 ))->each( function( $val, $key ){
//    if(App\Models\Media::find($val->media_id)) \
//    App\Models\MediaTag::updateOrCreate(['media_id'=> $val->media_id, 'tag_id'=> 86 ])->save();
//});


//174

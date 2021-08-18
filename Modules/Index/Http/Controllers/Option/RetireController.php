<?php

namespace Modules\Index\Http\Controllers\Option;


use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\FormElementItem;
use App\Models\MediaTag;
use App\Models\Option;
use \Illuminate\View\View;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RetireController extends Controller
{
    /**
     * @param Option $option
     * @return View
     */
    public function form( Option $option ): View
    {
        return view('index::options.retire', ['option'=>$option]);
    }



    protected $messages = [];


    public function retire( Request $request )
    {
        $request->validate([
            'engineering_notes' => 'required|string',
            'option_id' => 'required|int',
        ]);


        // base everything off of the newest revision prior to these changes.
        $old = Option::find( $request->input('option_id') );



        // create the new option from the old one, and update it with the fields supplied
        $new = $old->replicate()
            ->fill( $request->except(['id','revision']) );

        $new->revision ++; // increment the revision number
        $new->obsolete = true;
        $new->save();

        // mark the old one as obsolete;
        $old->obsolete = true;
        $old->save();
//
        Configuration::where('option_id', $old->id)->update(
            [
                'obsolete' => true,
            ]);


        if ( $request->option_syspro_phantom  ) {
            // if a phantom is provided, try to import the components
            $import = $new->importComponentsFromSyspro();
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







        return redirect("/index/option/{$old->id}/home");

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

            FormElementItem::where('media_id', $med->id )
                ->update([
                    'media_id' => $copiedMedia->id,
                ]);

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

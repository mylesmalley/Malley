<?php

namespace Modules\Blueprint\Http\Controllers\Form;

use App\Models\Blueprint;
use App\Models\Configuration;
use App\Models\FormElement;
use Error;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{

    /**
     * @param Blueprint $blueprint
     * @param Form $form
     * @return Response
     */
    public function show( Blueprint $blueprint,  Form $form ): Response
    {

         $form_data = $form
            ->load([
                'elements' => function($q){
                    $q->orderby('position');
                },
                'elements.rule',
                'elements.items.option' => function( $query) {
                    $query->select('id','option_name', 'option_description');
                },
            ])->toJson();


         $image_blocks = FormElement::where('type','=','images')
             ->where('form_id', '=', $form->id)
             ->with(['items' => function( $query ){
                    $query->orderBy('position');
                },'items.media'])
             ->get();


         $media = [];

         foreach( $image_blocks as $block )
         {
             $images = [];

             $width = 0;
             $height = 0;

             for($i = 0; $i < count( $block->items ); $i++)
             {
                 $img = $block->items[$i]->media;
                 $url = $img->cdnURL();

                 // pull the first image's dimensions and update from there.
                 if ( $i === 0)
                 {
                     list($width, $height) = getimagesize( $url );
                 }

                 $images[] = [
                     $img->model_id,
                     $url,
                     $width,
                     $height,
                 ];
             }


             $media[ "image_$block->id" ] = $images;
         }





        return response()
            ->view('blueprint::form.show', [
            'blueprint'=>$blueprint,
            'form' => $form,
            'form_data' => $form_data,
            'configuration' => Configuration::where('blueprint_id','=',$blueprint->id)
                ->where('obsolete', '=', false)
                ->select('id', 'value', 'option_id','name')
                ->get()
                ->keyBy('option_id')
                ->toJson(),

            'media' => $media,

        ]);
    }


    /**
     * @param Blueprint $blueprint
     * @return RedirectResponse
     */
    public function submit( Blueprint $blueprint): RedirectResponse
    {
        return redirect()->route('blueprint.home', [ $blueprint ])
            ->with('message','Saved changes to form');

    }

    /**
     * @param Request $request
     * @param Blueprint $blueprint
     * @return Response|
     */
    public function toggle_selection( Request $request, Blueprint $blueprint ): Response
    {
        $request->validate([
            'blueprint_id' => 'required|integer',
            'options_to_turn_on' => 'sometimes|array',
            'options_to_turn_off' => 'sometimes|array',
        ]);

        Configuration::where('blueprint_id', '=', $blueprint->id)
            ->whereIn('option_id', $request->input('options_to_turn_off'))
            ->update([
                "value" => false,
            ]);

        Configuration::where('blueprint_id', '=', $blueprint->id)
            ->whereIn('option_id', $request->input('options_to_turn_on'))
            ->update([
                "value" => true,
            ]);



        return response("Ok", 200);
    }


    /**
     * @param Request $request
     * @param Blueprint $blueprint
     * @return Response|
     */
    public function toggle_checkbox( Request $request, Blueprint $blueprint ): Response
    {
        $request->validate([
            'blueprint_id' => 'required|integer',
            'option_id' => 'required|integer',
        ]);

        try {
            $config = Configuration::where('blueprint_id', '=', $blueprint->id)
                ->where('option_id', $request->input('option_id'))
                ->firstOrFail();
            $config->value = !$config->value;
            $config->save();
        }
        catch ( Error $e )
        {
            Log::error("Couldn't find a matching configuration element when toggling", $e->getMessage());
        }

        return response("Ok", 200);
    }


}

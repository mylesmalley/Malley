<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use App\Models\Configuration;
use App\Models\Form;
use App\Models\Media;
use App\Models\Option;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\Blueprint;

class FormWrapper extends Component
{
    public Blueprint $blueprint;
    public Form $form;
    public Collection $options;
    public Collection $elements;
    public Collection $media;
    public array $configuration;

    public array $form_elements = [];


    protected $listeners = [
        'update-form' =>  'refreshConfiguration',
    ];




    /**
     * listens for changes to the configuration and reloads it when needed and on first load
     */
//    public function refreshConfiguration( array $event_payload = [] )
//    {
//        $this->configuration = Configuration::where('blueprint_id', '=', $this->blueprint->id )
//            ->where('obsolete', '=', false)
//            ->select(['id', 'value', 'name', 'option_id','description'])
//            ->get()
//            ->keyBy('option_id')
//            ->toArray();
//
//        if ( array_key_exists('element-id', $event_payload))
//        {
//            Log::info("has options to be emitted --- ". serialize($event_payload['element-id']));
//
//            foreach( $event_payload['element-id'] as $el_id )
//            {
//                $this->emit("update-element-$el_id");
//                Log::info("emitted  --- update-element-$el_id");
//            }
//        }
//
//        Log::info("Refreshed configuration"  .serialize($event_payload) );
//    }

    /**
     * @param Blueprint $blueprint
     * @param Form $form
     */
    public function mount( Blueprint $blueprint, Form $form )
    {
        $this->form = $form; //->load(['elements', 'elements.items', 'elements.rule']);
        $this->blueprint = $blueprint;
        $this->elements = $this->form->elements;
       // $this->refreshConfiguration();

        $form_options = [];
        $form_media = [];

        foreach( $this->elements as $el )
        {
            $this->form_elements[ $el->id ] = [
                'options' => [],
                'media' => []
            ];

            foreach( $el->items as $i )
            {
                $form_options[] = $i->option_id;

                $this->form_elements[ $el->id]['options'][] = $i->option_id;

                if ( $i->media_id) {
                    $form_media[] = $i->media_id;
                    $this->form_elements[ $el->id]['media'][] = $i->media_id;

                }
            }
        }

        $this->options = Option::whereIn( 'id', $form_options )
                            ->select('id','option_name','option_description')
                            ->get();
     //   $this->options = $this->form->ele

        $this->media = Media::whereIn( 'id', $form_media )
                            ->get();
//        Log::info("Mounted parent");

    }

    /**
     * @return Application|Factory|View
     */
    public function render(): Application|Factory|View
    {
        return view('blueprint::form.components.form-wrapper');
    }
}
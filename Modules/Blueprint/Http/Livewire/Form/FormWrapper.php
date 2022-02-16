<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use App\Models\Configuration;
use App\Models\Form;
use App\Models\FormElement;
use App\Models\Media;
use App\Models\Option;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Blueprint;
use Illuminate\View\View;

class FormWrapper extends Component
{
    public Blueprint $blueprint;
    public Form $form;
    public Collection $options;
    public Collection $elements;
    public Collection $media;
    public Collection $configuration;

    public function mount( Blueprint $blueprint, Form $form )
    {
        $form = $form->load('elements', 'elements.items', 'elements.rule');
        $this->blueprint = $blueprint;
        $this->form = $form;
        $this->elements = $form->elements;
        $this->configuration = Configuration::
            where('blueprint_id', '=', $this->blueprint->id )
            ->where('obsolete', '=', false)
            ->select(['id', 'value', 'option_id'])
            ->get();


        $form_options = [];
        $form_media = [];

        foreach( $this->elements as $el )
        {
            foreach( $el->items as $i )
            {
                $form_options[] = $i->option_id;

                if ( $i->media_id) $form_media[] = $i->media_id;
            }
        }

        $this->options = Option::whereIn( 'id', $form_options )
                            ->select('id','option_name','option_description')
                            ->get();

        $this->media = Media::whereIn( 'id', $form_media )
            ->get();

       // $this->options = $form->elements->items->option;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('blueprint::form.components.form-wrapper');
    }
}
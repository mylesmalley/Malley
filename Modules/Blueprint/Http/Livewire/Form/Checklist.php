<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use App\Models\Configuration;
use App\Models\FormElement;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;
use Modules\Blueprint\Http\Livewire\Form\Traits\HasOptionRules;

class Checklist extends Component
{
    use HasOptionRules;


    public FormElement $element;
    public Collection $items;
    public array $configuration;


//    public $listeners = [
//        'update-configuration' => 'updatedConfiguration'
//    ];


    protected function getListeners(): array
    {
        return [
            "update-element-{$this->element->id}" => "test",
        ];
    }


    public function test()
    {
        Log::info("{$this->element->id} was updated");
    }



    public function mount( FormElement $element, array $configuration )
    {
      //  dd( $configuration);
        $this->element = $element;
        $this->items = $this->element->items;
        $this->configuration = $configuration;

        $this->get_referenced_options();

    }



    /**
     * @param Configuration $configuration
     */
    public function toggle( Configuration $configuration ): void
    {
        $configuration->update([
            'value' => ! $configuration->value,
        ]);

        $this->configuration[ $configuration->option_id ]['value'] = ! $this->configuration[ $configuration->option_id ]['value'] ;
//
//        $this->emit('update-form');
        //Log::info("Clicked on ".$configuration->id);

        $this->emitUp('update-form', ['element-id'=>[$this->element->id]]);
    }


    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function render(): Application|Factory|View
    {
        return view('blueprint::form.components.checklist');
    }
}
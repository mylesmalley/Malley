<?php
namespace Modules\Blueprint\Http\Livewire\Form\Traits;


    use App\Models\FormElement;
    use Illuminate\Support\Collection;

    trait HasOptionRules {
        public array $formElementRules = [];
        public bool $show = true;
        public array $referencedOptions = [];

        /**
         * @param FormElement $element
         */
        public function load_rules( FormElement $element ): void
        {
            if ( $element->rule )
            {
                $this->formElementRules = json_decode( $element->rule->options, true );
            }
        }


        public function set_referenced_options( Collection $configuration ): void
        {
            $this->referencedOptions = $configuration
                                          //  ->pluck('option_name')
                                            ->toArray();
        }

        public function check_visibility()
        {
            if ( count( $this->formElementRules ) === 0) $this->show = true;
            if ( array_intersect( $this->referencedOptions, $this->formElementRules ) ) $this->show = true;
            $this->show = false;
        }
    }
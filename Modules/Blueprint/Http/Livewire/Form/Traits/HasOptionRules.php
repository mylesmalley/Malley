<?php
namespace Modules\Blueprint\Http\Livewire\Form\Traits;


    use App\Models\FormElement;
    use Illuminate\Support\Facades\Log;

    /**
     *  shared code between types of elements in forms to handle whether to show something or not based on rules
     */
    trait HasOptionRules {

        // array of options that the form element requires to be shown.
        public array $formElementRules = [];

        // boolean if the element is visible or not.
        public bool $show = true;

        // options on the blueprint that are checked against
        public array $referencedOptions = [];


        public function updatedConfiguration( string $option_name )
        {
            $this->check_visibility();
            Log::info("The component should be updated $option_name");
        }

        /**
         * pulls in the related rule if it exists and parses it into an array.
         *
         * @param FormElement $element
         */
        public function load_rules( FormElement $element ): void
        {
            if ( $element->rule )
            {
                $this->formElementRules = json_decode( $element->rule->options, true );
            }
        }


        /**
         * receives the configuration for the vehicle and pulls out the option names turned on
         * @param array $referenced_options
         */
        public function set_referenced_options( array $referenced_options ): void
        {
            // filter out to get only active options
            $unfiltered_active_options = array_map( function ($val) {
                    return $val['value'] ? $val['name'] : null;
                }, $referenced_options );

            // remove null values from the array
            $active_options = array_filter( $unfiltered_active_options );

            // store the overlap between the active options and options required by the rules.
            $this->referencedOptions = array_intersect( $active_options, $this->formElementRules );
        }


        /**
         *  determines if a form element should be shown or not
         */
        public function check_visibility(): void
        {
            // if no rules present, show it
            if ( count( $this->formElementRules ) === 0) $this->show = true;
            // if rules present and one of the options overlaps, show it
            else if ( count( $this->referencedOptions ) > 0 ) $this->show = true;
            // otherwise, don't show it
            else $this->show = false;
        }
    }
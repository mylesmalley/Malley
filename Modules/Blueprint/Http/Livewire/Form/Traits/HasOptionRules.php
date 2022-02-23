<?php
namespace Modules\Blueprint\Http\Livewire\Form\Traits;

//
//    use App\Models\FormElement;
//    use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Log;

/**
     *  shared code between types of elements in forms to handle whether to show something or not based on rules
     */
    trait HasOptionRules {

        public array $options_from_form_elements = [];
        public array $options_from_rules = [];
        public array $all_referenced_options;
        public array $active_configuration_options = [];

//        // array of options that the form element requires to be shown.
//        public array $formElementRules = [];
//
//        // boolean if the element is visible or not.
        public bool $show = true;


        public function get_referenced_options(  )
        {
//            $this->options_from_form_elements = array_column( $this->configuration, 'name' );

            //$this->options_from_form_elements = $this->items->pluck('name')->toArray();

          //  dd(  $this->items);

            $active_options = array_filter( $this->configuration, callback: function($c){
                if ( $c['value'] ) return true;
                return false;
            });

            $this->active_configuration_options = array_column($active_options, "name");



            if ( $this->element->rule )
            {
                $this->options_from_rules = json_decode( $this->element->rule->options, true );
            }

            $this->all_referenced_options = array_merge( $this->options_from_form_elements, $this->options_from_rules ) ;

         //   dd( $this->all_referenced_options);
        }



//
//        // options on the blueprint that are checked against
//        public array $referencedOptions = [];
//
//
        public function updatedConfiguration( string $option_name )
        {

        //    $this->check_visibility();
           // Log::info("The component should be updated $option_name");
        }
//
//        /**
//         * pulls in the related rule if it exists and parses it into an array.
//         *
//         * @param FormElement $element
//         */
//        public function load_rules( FormElement $element ): void
//        {
//            if ( $element->rule )
//            {
//                $this->formElementRules = json_decode( $element->rule->options, true );
//            }
//        }
//
//
//        /**
//         * receives the configuration for the vehicle and pulls out the option names turned on
//         * @param array $referenced_options
//         */
//        public function set_referenced_options( array $referenced_options ): void
//        {
//            // filter out to get only active options
//            $unfiltered_active_options = array_map( function ($val) {
//                    return $val['value'] ? $val['name'] : null;
//                }, $referenced_options );
//
//            // remove null values from the array
//            $active_options = array_filter( $unfiltered_active_options );
//
//            // store the overlap between the active options and options required by the rules.
//            $this->referencedOptions = array_intersect( $active_options, $this->formElementRules );
//        }
//
////
        /**
         *  determines if a form element should be shown or not
         */
        public function check_visibility(): void
        {
            // if no rules present, show it
//            if ( count( $this->options_from_rules ) === 0) $this->show = true;
//            // if rules present and one of the options overlaps, show it
//            else if ( count( $this->referencedOptions ) > 0 ) $this->show = true;
//            // otherwise, don't show it
//            else $this->show = false;
        }
    }
<?php

namespace Modules\Blueprint\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use App\Models\Blueprint;
use App\Models\CustomLayout;
use App\Models\Option;

class CustomLayoutProgress extends Component
{

    public Blueprint $blueprint;
    public CustomLayout $customLayout;

    public array $progress = [];
    public array $formatted_progress = [];


    protected array $listeners = [
        'update_floor_layout_progress'
    ];


    /**
     * @param Blueprint $blueprint
     * @param CustomLayout $customLayout
     */
    public function mount( Blueprint $blueprint, CustomLayout $customLayout ): void
    {
        $this->blueprint = $blueprint;
        $this->customLayout = $customLayout;
    }



    public function update_floor_layout_progress()
    {
        $this->progress = [];
        $this->formatted_progress = [];

        $layout = json_decode( $this->customLayout->layout );

        if ( $this->customLayout->layout && $layout->children )
        {
            foreach( $layout->children as $c )
            {

                if ( property_exists($c, 'attrs' ) &&  property_exists( $c->attrs, 'options') )
                {
                    foreach( $c->attrs->options as $o)
                    {

                        if ( array_key_exists( $o, $this->progress ))
                        {
                            $this->progress[$o] ++;
                        }
                        else
                        {
                            $this->progress[$o] = 1;
                        }
                    }
                }
            }
        }


        foreach( $this->progress as $option => $count )
        {
            $newline = Option::where('option_name', $option )
                ->where('obsolete', false)
                ->first();

            $newline->count = $count;

            $this->formatted_progress[] = $newline;
        }


    }


    /**
     * @return View
     */
    public function render(): View
    {
        return view('blueprint::floor_layout.components.floor_layout_progress');
    }
}


//myles-OptiPlex-3050 [2021-11-19 18:33:55] local_live.ERROR: Undefined property: stdClass::$options {"userId":3,"exception":"[object] (ErrorException(code: 0): Undefined property: stdClass::$options at /home/myles/Dropbox/PhpstormProjects/Malley/Modules/Blueprint/Http/Controllers/Blueprint/FloorLayoutController.php:112)
<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use App\Models\Configuration;
use App\Models\FormElement;
use App\Models\Media;
use Exception;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Blueprint;
use Illuminate\View\View;


class ActiveDrawings extends Component
{

    public Collection $ids;


    public function draw()
    {

    }


    /**
     * @param Blueprint $blueprint
     */
    public function mount( Blueprint $blueprint )
    {
        $this->ids = $blueprint->activeDrawingIDs();

    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('blueprint::form.components.activeDrawings');
    }
}
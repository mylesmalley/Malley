<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Blueprint;
use Illuminate\View\View;


class ActiveDrawings extends Component
{

    public Collection $ids;

    /**
     * @param Blueprint $blueprint
     */
    public function mount( Blueprint $blueprint ): void
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
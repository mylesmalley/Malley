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

class FormState extends Component
{



    /**
     * @return Application|Factory|View
     */
    public function render(): Application|Factory|View
    {
        return view('blueprint::form.components.form-state');
    }
}
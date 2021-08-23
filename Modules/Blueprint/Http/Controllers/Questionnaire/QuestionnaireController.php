<?php

namespace Modules\Blueprint\Http\Controllers\Questionnaire;

use App\Models\Blueprint;
use App\Models\Wizard;
//use App\Models\WizardAnswer;
//use App\Models\WizardQuestion;
//use Illuminate\Contracts\Support\Renderable;
//use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class QuestionnaireController extends Controller
{


    /**
     * @param Blueprint $blueprint
     * @param Wizard $wizard
     * @return View
     */
    public function show(Blueprint $blueprint, Wizard $wizard ): View
    {
        return view('blueprint::questionnaire.show',
            compact(['blueprint','wizard'])
        );
    }
}

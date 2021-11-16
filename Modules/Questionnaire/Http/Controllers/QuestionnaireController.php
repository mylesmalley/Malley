<?php

namespace Modules\Questionnaire\Http\Controllers;

use App\Models\Blueprint;
use App\Models\Wizard;
use App\Models\WizardAnswer;
use App\Models\WizardQuestion;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class QuestionnaireController extends Controller
{

    public function graph( Wizard $wizard )
    {
        $graph = "";

        $graph .= "graph LR \r";


        foreach (WizardQuestion::where('wizard_id', $wizard->id )->get() as $q) {
            $graph .= "Q{$q->id}[\" ".htmlentities( $q->text ) ." ({$q->id})\"];\r ";
     //       $graph .= "click Q{$q->id} call test() \"Tooltip\"; \r";

//              click Q{$q->id} \"http://www.github.com \r";
        }

        foreach (WizardAnswer::where('wizard_id', $wizard->id )
                     ->orderBy('position')
                     ->get() as $a) {
            $graph .= "  Q{$a->wizard_question_id} -- ".htmlentities( $a->text ) . " {$a->id} --> Q{$a->next}; \r";

        }


        return view('questionnaire::graph', [ 'wizard'=> $wizard,  'graph'=> $graph ]);

    }


    public function show( Wizard $wizard, Blueprint $blueprint )
    {
        return view('questionnaire::show', compact(['blueprint','wizard']));
  //      dd("hello");
    }
}

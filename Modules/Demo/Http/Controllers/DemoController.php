<?php

namespace Modules\Demo\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\WizardAnswer;
use App\Models\WizardQuestion;
use App\Models\BlueprintWizardAnswer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Inertia\Inertia;


class DemoController extends Controller
{

    /**
     * @param Event $event
     * @return \Inertia\Response
     */
    public function index(Event $event)
    {

        return Inertia::render('Demo', [

        ]);
    }




    public function conditionalInteriorACOptions()
    {
        $selectedAnsers = DB::table('blueprint_wizard_answers')
            ->where('blueprint_id', Auth::user()->id)
            ->pluck('wizard_answer_id');



        if (
                $selectedAnsers->contains(11) ||
                $selectedAnsers->contains(12) ||
                $selectedAnsers->contains(16) ||
                $selectedAnsers->contains(17) ||
                $selectedAnsers->contains(17) ||
                $selectedAnsers->contains(19) ||
                $selectedAnsers->contains(20) ||
                $selectedAnsers->contains(21) ||
                $selectedAnsers->contains(22)
        )
        {
            return redirect( "/demo/question/". 27 ); // malley interior options for heat and AC
        }

        return redirect( "/demo/question/". 11 ); // no options for oem, so go straight to lift

    }


    public function conditionalTransitOptions(  )
    {
        $selectedAnsers = DB::table('blueprint_wizard_answers')
            ->where('blueprint_id', Auth::user()->id)
            ->pluck('wizard_answer_id');

        /*
         * SMART FLOOR SIDE ENTRY
         */
        if (
            $selectedAnsers->contains(29)  // side entry
            &&
            ( // ONE OF THE FOLLOWING
                $selectedAnsers->contains(23) ||  // smartfloor
                $selectedAnsers->contains(25) || // smartfloor
                $selectedAnsers->contains(27)  // smartfloor
            )
        )
        {
            return redirect( "/demo/question/". 22 );
        }


        /*
         *  SMART FLOOR REAR ENTRY
         */
        if (
            $selectedAnsers->contains(30)   // rear entry
            &&
            ( // ONE OF THE FOLLOWING
                $selectedAnsers->contains(23) ||  // smartfloor
                $selectedAnsers->contains(25) || // smartfloor
                $selectedAnsers->contains(27)  // smartfloor
            )
        )
        {
            return redirect( "/demo/question/". 21 );

        }





        /*
 *  Malley FLOOR REAR ENTRY
 */
        if (
            $selectedAnsers->contains(30)   // rear entry
            &&
            ( // ONE OF THE FOLLOWING
                $selectedAnsers->contains(24) ||  // malley floor
                $selectedAnsers->contains(26) || // malley
                $selectedAnsers->contains(28)  // malley
            )
        )
        {
            return redirect( "/demo/question/". 23 );

        }

        // malley floor side entry

        if (
            $selectedAnsers->contains(29)   // side entry
            &&
            ( // ONE OF THE FOLLOWING
                $selectedAnsers->contains(24) ||  // malley
                $selectedAnsers->contains(26) || // malley
                $selectedAnsers->contains(28)  // malley
            )
        )
        {
            return redirect( "/demo/question/". 23 );

        }


        dd( "dead end...");

    }



    /**
     * @param WizardQuestion $question
     */
    public function show( WizardQuestion $question )
    {
        if ($question->type === 'redirect')
        {
            switch ( $question->id )
            {
                case ( 18 ):
                    return $this->conditionalTransitOptions();
                case (26):
                    return $this->conditionalInteriorACOptions();
                default:
                    dd( 'missing path from conditional');
            }
        }




                return Inertia::render('Pages/Wizard', [
            'question' => $question,
            'answers' => $question->answers,
        ]);

    }



    public function submit(  Request $request  )
    {

        $ids = $request->answer_id;
        if (!is_array($request->answer_id)) {
            $ids = [$request->answer_id];
        }

        $answers = WizardAnswer::whereIn('id', $ids)->get();
        //    dd( $answers );

        foreach ($answers as $answer) {
            BlueprintWizardAnswer::updateORcreate([
                'blueprint_id' => Auth::user()->id,
                'wizard_answer_id' => $answer->id,
                'wizard_question_id' => $answer->wizard_question_id,
            ])->save();
        }


        // loop through answer actions

//        foreach( $answer->actions as $action)
//        {
//            $action->do( 1418 );
//        }

        // redirect to answer NEXT question

        // if no options were selected, such as in a checkbox list with none picked, go with the next question id provided
        if ($request->next_question) return redirect('/demo/question/'.$request->next_question );

        return redirect('/demo/question/'. $answers->first()->next );

    }



    public function graph()
    {
        $graph = "";

        $graph .=   "graph LR \r";


        foreach( WizardQuestion::get() as $q )
        {
            $graph .= "Q{$q->id}[\" {$q->text} ({$q->id})\"]\r ";
//              click Q{$q->id} \"http://www.github.com \r";
        }

        foreach( WizardAnswer::get() as $a )
        {
            $graph .= "  Q{$a->wizard_question_id} -- {$a->text} {$a->id} --> Q{$a->next} \r";

        }

        return Inertia::render('Pages/Graph', [
            'graph' => $graph
        ]);
    }



    public function progress()
    {
        return DB::table('blueprint_wizard_answers')
            ->select(["blueprint_wizard_answers.id",
                "wizard_questions.text as question",
                "wizard_answers.text as answer"
            ])
            ->where('blueprint_id', Auth::user()->id)
            ->leftJoin('wizard_questions', 'wizard_questions.id','=','blueprint_wizard_answers.wizard_question_id')
            ->leftJoin('wizard_answers', 'wizard_answers.id','=','blueprint_wizard_answers.wizard_answer_id')
            ->get()
            ->toJson();
    }



    public function restart()
    {
        DB::table('blueprint_wizard_answers')
            ->where('blueprint_id', Auth::user()->id)
            ->delete();

        return redirect('/demo/question/1');
    }

}

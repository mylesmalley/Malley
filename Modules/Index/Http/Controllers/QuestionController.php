<?php

namespace Modules\Index\Http\Controllers;

use App\Models\Question;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(  )
    {
        $tree = Question::get()->toTree();
        return view('index::questions.index', [  'tree'=>$tree  ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( int $parent )
    {
        return view('index::questions.create', ['question'=>Question::class, 'parent_id'=>$parent ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $question = new Question( $request->except('parent_id') );
        $parent = Question::find($request->parent_id);
        $question->parent()->associate($parent)->save();
        return redirect( '/questions/'.$request->parent_id );
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('index::questions.edit', ['question'=>$question ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $question->update( $request->only(['category','question','layout_id']) );
        //dd($request->());
        return redirect('questions/'.$question->id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if ( $question->isLeaf() ){
            $question->delete();
        }
        return redirect( )->back( );

    }
}

<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except('index');
    }


    public function index(Question $question) {
        return $question->answers()->with('user')->simplePaginate(3);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
           'body' => 'required'
        ]);


        $answer = $question->answers()->create([
            'body' => $request->body,
            'user_id' => \Auth::id()
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your answer has been submited',
                'answer' => $answer->load('user')
            ]);
        }

        return back()->with('success', "Your answer has been submited");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        return view('answers.edit', compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        $answer->update($request->validate([
            'body' => 'required',
        ]));

        if($request->expectsJson()) {

            return response()->json([
                'message' => 'Answer Updated',
                'body_html' => $answer->body_html
            ]);
        }

//        return redirect()->route('questions.show', $question->slug)->with('success', 'Answer Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);

        $answer->delete();

        if(request()->expectsJson()) {
            return response()->json([
                'message' => 'Answer deleted'
            ]);
        }

        return back()->with('success', 'Answer deleted');
    }
}

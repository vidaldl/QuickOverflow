<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Answer;
use App\Http\Resources\AnswerResource;
use App\Question;
use Illuminate\Http\Request;


class AnswersController extends Controller
{




    public function index(Question $question) {
        $answers = $question->answers()
            ->with('user')
            ->where(function ($q) {
                if (request()->has('excludes')) {
                    $q->whereNotIn('id', request()->query('excludes'));
                }
            })->simplePaginate(3);

        return AnswerResource::collection($answers);
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


        return response()->json([
            'message' => 'Your answer has been submited',
            'answer' => new AnswerResource($answer->load('user'))
        ]);

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

        return response()->json([
            'message' => 'Answer Updated',
            'body_html' => $answer->body_html
        ]);

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

        return response()->json([
            'message' => 'Answer deleted'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => [
            'show',
            'index',
        ]]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(5);

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();

        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
//        dd($request->user());
        $request->user()->questions()->create($request->only('title', 'body'));

        if($request->expectsJson()) {
            return response()->json([
                'message' => 'Your Question has been submitted'
            ]);
        }

        return redirect()->route('questions.index')->with('success', "Your Question has been submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views');

        return view('questions.show', compact('question'));
//        $question->views = $question->views + 1;
//        $question->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $this->authorize("update", $question);
        return view("questions.edit", compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        $this->authorize("update", $question);

        $question->update($request->only('title', 'body'));

        if($request->expectsJson()) {
            return response()->json([
                'message' => 'Question Updated!',
                'body_html' => $question->body_html
            ]);
        }

        return redirect()->route('questions.index')->with('success', "Question Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $this->authorize("delete", $question);

        $question->delete();

        if (request() ->expectsJson()) {
            return response()->json([
                'message' => 'Question Deleted'
            ]);
        }

        return redirect()->route('questions.index')->with('success', "Question Deleted");
    }
}

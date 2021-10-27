<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Answer;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
{


    public function __invoke(Answer $answer) {
        $vote = (int) request()->vote;
        $votesCount = auth()->user()->voteAnswer($answer, $vote);

        return response()->json([
            'message' => 'Thanks for the feedback.',
            'votesCount' => $votesCount
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer) {
        $this->authorize('accept', $answer);
        $answer->question->acceptBestAnswer($answer);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Question accepted as best answer'
            ]);
        }

        return back();
    }
}

<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Answer;
use Illuminate\Http\Request;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer) {
        $this->authorize('accept', $answer);
        $answer->question->acceptBestAnswer($answer);

        return response()->json([
            'message' => 'Question accepted as best answer'
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answers;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answers $answer)
    {
        $this->authorize('accept', $answer);
        $answer->questions->acceptBestAnswer($answer);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'You have accepted answer as best answer'
            ]);
        }
        return back();
    }
}

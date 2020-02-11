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
        return back();
    }
}

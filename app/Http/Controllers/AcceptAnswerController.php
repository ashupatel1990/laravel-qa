<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answers;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answers $answer)
    {
        $answer->question->acceptBestAnswer($answer);
        return back();
    }
}

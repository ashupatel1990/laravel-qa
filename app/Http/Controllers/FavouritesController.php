<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;

class FavouritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Questions $question)
    {
        $question->favourites()->attach(auth()->id());

        return back();
    }

    // type hine (argument)
    public function destroy(Questions $question)
    {
        $question->favourites()->detach(auth()->id());

        return back();
    }
}

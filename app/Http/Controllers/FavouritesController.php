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
        
        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'You favourited question'
            ]);
            // return response()->json(null, 204); //status = 204
        }
        return back();
    }

    // type hine (argument)
    public function destroy(Questions $question)
    {
        $question->favourites()->detach(auth()->id());

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'You unfavourited question'
            ]);
        }
        return back();
    }
}

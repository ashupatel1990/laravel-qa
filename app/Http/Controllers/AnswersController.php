<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\Answers;

class AnswersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Questions $question, Request $request)
    {
        $answers = $question->answers_count + 1;
        $question->update(['answers_count' => $answers]);
        $request->validate(['body' => 'required']);
        $question->answers()->create(['body' => $request->body, 'user_id' => \Auth::id()]);

        return back()->with('success', "Your answer has been submitted successfully");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

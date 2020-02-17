<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\Answers;

class AnswersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Questions $question)
    {
        return $question->answers()->with('user')->simplePaginate(3);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Questions $question, Request $request)
    {
        // we now added logic inside model to increment answerscount when answer added.
        //$answers = $question->answers_count + 1;
        //   $question->update(['answers_count' => $answers]);
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
    public function edit(Questions $question, Answers $answer)
    {
        $this->authorize('update', $answer);

        return view('answers.edit', compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questions $question, Answers $answer)
    {
        $this->authorize('update', $answer);

        $answer->update($request->validate([
            'body' => 'required'
        ]));
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your answer has been updated',
                'body' => $answer->body
            ]);
        }
        return redirect()->route('questions.show', $question->slug)->with('success', 'Your answer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questions $question, Answers $answer)
    {
        $this->authorize('delete', $answer);
        //$answers = $question->answers_count - 1;
        //$question->update(['answers_count' => $answers]);
        $answer->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Answer has beedn deleted!'
            ]);
        }
        return back()->with('success', 'Answer deleted');
    }
}

<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Questions;

class VotableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('votables')->where('votable_type', 'App\Questions')->delete();

		$users = User::all();

		$numberofUsers = $users->count();
		$votes = [-1, 1];

		foreach (Questions::all() as $question)
		{
			for ($i = 0; $i < rand(1, $numberofUsers); $i++)
			{
				$user = $users[$i];

				$user->voteQuestions($question, $votes[rand(0, 1)]);
			}
		}
    }
}

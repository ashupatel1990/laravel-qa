<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Questions;

class FavouritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('favourites')->delete();

        $users = User::pluck('id')->all();
        $numberOfUsers = count($users);

        foreach (Questions::all() as $question)
        {
            for ($i = 0; $i < rand(0, $numberOfUsers); $i++)
            {
                $user = $users[$i];

                $question->favourites()->attach($user);
            }
        }
    }
}

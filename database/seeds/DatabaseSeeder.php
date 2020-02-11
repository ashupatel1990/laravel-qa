<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            UsersQuestionsAnswersTableSeeder::class,
            FavouritesTableSeeder::class,
			VotableTableSeeder::class,
        );
    }
}

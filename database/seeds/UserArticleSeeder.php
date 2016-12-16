<?php

use App\Article;
use App\Libraries\Deviate;
use App\User;
use Illuminate\Database\Seeder;

class UserArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty database tables
        DB::statement("SET foreign_key_checks=0");
        Article::truncate();
        User::truncate();
        DB::statement("SET foreign_key_checks=1");

        $numberOfUsers = 10;
        $numberOfArticles = new Deviate(10, 0.3, true);

        // Create users and random amount of articles that belong to each user
        factory(User::class, $numberOfUsers)->create()->each(
            function ($user) use ($numberOfArticles) {
                foreach (range(1, $numberOfArticles->random()) as $x) {
                    $user->articles()->save(factory(Article::class)->make());
                }
            });

    }
}

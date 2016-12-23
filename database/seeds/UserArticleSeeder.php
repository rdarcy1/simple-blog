<?php

use App\Article;
use App\Libraries\Deviate;
use App\User;
use Illuminate\Database\Seeder;

/**
 * Class UserArticleSeeder
 */
class UserArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Config variables
        $numberOfUsers = 10;
        $articlesPerUser = 10;

        $this->emptyDatabaseTables();

        $articlesDeviate = Deviate::makeUnsigned()
            ->setCentre($articlesPerUser)
            ->setDeviation(0.8);

        // Create users and random amount of articles that belong to each user
        factory(User::class, $numberOfUsers)->create()->each(
            function ($user) use ($articlesDeviate) {

                // For each user, create specified number of articles +/- given deviation
                for ($x = 1; $x <= $articlesDeviate->generateSingle('triangular'); $x++) {
                    $user->articles()->save(factory(Article::class)->make());
                }
            });

    }

    /**
     * Disable foreign key checks and truncate database tables.
     */
    protected function emptyDatabaseTables()
    {
        DB::statement("SET foreign_key_checks=0");
        /** @noinspection PhpUndefinedMethodInspection */
        Article::truncate();
        /** @noinspection PhpUndefinedMethodInspection */
        User::truncate();
        DB::statement("SET foreign_key_checks=1");
    }
}

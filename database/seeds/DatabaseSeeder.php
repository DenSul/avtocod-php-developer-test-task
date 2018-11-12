<?php

use App\Models\User;
use App\Models\Posts;
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
        factory(User::class)->times(\mt_rand(1, 5))->create()->each(function ($user) {
            $user->messages()->saveMany(factory(Posts::class, \mt_rand(1, 5))->make());
        });
    }
}

<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(App\State::class, 50)->create()->each(function ($user) {
            $user->posts()->save(factory(App\Post::class)->make());
        }); */

        factory(App\State::class, 50)->create();
    }
}

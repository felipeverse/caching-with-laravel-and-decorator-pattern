<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
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
        User::factory(2500)->create()->each(function ($user) {
            Post::factory(rand(50, 500))->create(['user_id' => $user->id]);
        });
    }
}

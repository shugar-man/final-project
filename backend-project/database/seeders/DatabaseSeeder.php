<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $users = User::get();
        $user = User::find(1);
        $user2 = User::find(2);
        $post = Post::find(2);
        $post->userWhoLikes()->attach($user->id);
        $user->comments()->attach($post->id);
        $user->subscribes()->attach($user2->id);
        // foreach ($users as $key => $user) {
        //     foreach ($user->comments->where('id', 1) as $comment) {
        //         $comment->pivot->value;
        //     }
        // }


        
        

    }
}

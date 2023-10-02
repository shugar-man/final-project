<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $post = new Post();
        $post->name = "myArt";
        $post->detail = "myFirstWork";
        $user = User::find(1);
        $user->posts()->save($post);

        $post2 = new Post();
        $post2->name = "myArt 2";
        $post2->detail = "mySecondWork";
        $user->posts()->save($post2);
        // $post->user_id = $user->id;
        // $post->save();
    }
}

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
        $user = User::find(1);
        $user2 = User::find(2);
        $post = new Post();
        $post->name = "myArt";
        $post->detail = "myFirstWork";
        $user->posts()->save($post);

        $post2 = new Post();
        $post2->name = "myArt 2";
        $post2->detail = "mySecondWork";
        $user2->posts()->save($post2);


        $post3 = new Post();
        $post3->name = "myArt 3";
        $post3->detail = "my3Work";
        $user2->posts()->save($post3);
        $post->user_id = $user->id;
        $post->save();

        $post4 = new Post();
        $post4->name = "myArt 4";
        $post4->detail = "my3Work";
        $user2->posts()->save($post4);
        $post->user_id = $user->id;
        $post->save();

        $post5 = new Post();
        $post5->name = "myArt 5";
        $post5->detail = "my3Work";
        $user2->posts()->save($post5);
        $post->user_id = $user->id;
        $post->save();
    }
}

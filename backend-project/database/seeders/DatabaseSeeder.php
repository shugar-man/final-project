<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostTopic;
use App\Models\Subscribe;
use App\Models\Topic;
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
        foreach ($users as $key => $user) {
            foreach ($user->comments->where('id', 1) as $comment) {
                $comment->pivot->value;
            }
        }
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->post_id = $post->id;
        $comment->text = "sadsafdgfdhgf";
        $comment->save();
        $subscribe = new Subscribe();
        $subscribe->user_id = $user->id;
        $subscribe->subscribe_id = $user2->id;
        $subscribe->save();

        $subscribe = new Subscribe();
        $subscribe->user_id = $user->id;
        $subscribe->subscribe_id = 3;
        $subscribe->save();

        $subscribe = new Subscribe();
        $subscribe->user_id = $user->id;
        $subscribe->subscribe_id = 4;
        $subscribe->save();

        $like = new Like();
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        $like->save();

        $topic = new Topic();
        $topic->topic = "ghost";
        $topic->save();

        $postTopic = new PostTopic();
        $postTopic->post_id = $post->id;
        $postTopic->topic_id = $topic->id;
        $postTopic->save();


        
        

    }
}

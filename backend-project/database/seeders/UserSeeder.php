<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = new User();
        $user->name = "shushu";
        $user->email = "user01@example.com";
        $user->password = Hash::make("password");
        $user->status = false;
        $user->save();

        $user2 = new User();
        $user2->name = "the sun";
        $user2->email = "user02@example.com";
        $user2->profile_image = "miku.jpg";
        $user2->password = Hash::make("password");
        $user2->status = true;
        $user2->save();
        $user3 = new User();
        $user3->name = "Admin";
        $user3->email = "admin@example.com";
        $user3->password = Hash::make("admin");
        $user3->status = true;
        $user3->role = true; //true = admin
        $user3->save();

        $user3 = new User();
        $user3->name = "jame No. 1";
        $user3->email = "test@test.test";
        $user3->profile_image = "art1.jpg";
        $user3->password = Hash::make("password");
        $user3->save();

        $user4 = new User();
        $user4->name = "nonninonni";
        $user4->email = "user03@example.com";
        $user4->profile_image = "art2.jpg";
        $user4->password = Hash::make("password");
        $user4->save();

        $user5 = new User();
        $user5->name = "micheal norrington";
        $user5->email = "user04@example.com";
        $user5->profile_image = "art3.jpg";
        $user5->password = Hash::make("password");
        $user5->save();

        $user6 = new User();
        $user6->name = "markthegreat";
        $user6->email = "user05@example.com";
        $user6->profile_image = "art4.jpg";
        $user6->password = Hash::make("password");
        $user6->save();

    }
}

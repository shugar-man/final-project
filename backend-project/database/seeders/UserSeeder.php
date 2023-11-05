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
        $user->name = "User 01";
        $user->email = "user01@example.com";
        $user->password = Hash::make("password");
        $user->status = false;
        $user->save();
        $user2 = new User();
        $user2->name = "User 02";
        $user2->email = "user02@example.com";
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

        
    }
}

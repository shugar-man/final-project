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
        $user->username = "shushu man";
        $user->email = "user01@example.com";
        $user->password = Hash::make("password");
        $user->save();
        $user2 = new User();
        $user2->name = "User 02";
        $user2->username = "shushu woman";
        $user2->email = "user02@example.com";
        $user2->password = Hash::make("password");
        $user2->save();
        
        
    }
}
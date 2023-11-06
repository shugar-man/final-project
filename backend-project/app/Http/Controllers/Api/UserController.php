<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUser(){
        $users = User::get();
        return $users;
    }

    public function userShowName(Request $request) {
        $id = $request->get('id');
        return User::where('id',$id)->get('name');
    }
}

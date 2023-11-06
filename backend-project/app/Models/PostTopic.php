<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTopic extends Model
{
    use HasFactory;
    public function post()
    {
        return $this->belongsTo(Post::class);
    }


    public function topic() {
        return $this->belongsTo(Topic::class);
    }
}

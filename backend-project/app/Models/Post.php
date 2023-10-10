<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory; 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function userWhoLikes(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, "post_like_user");
    // }
    // public function userWhoComments(): BelongsToMany{
    //     return $this->belongsToMany(User::class,"comments")->withPivot('text');
    // }
    public function topics(): BelongsToMany{
        return $this->belongsToMany(Topic::class,"post_topic")->withPivot('text');
    }
}

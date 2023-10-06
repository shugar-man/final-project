<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, "post_like_user");
    }
    public function comments(): BelongsToMany{
        return $this->belongsToMany(Post::class,"comments")->withPivot('text');
    }

    public function subscribes(): BelongsToMany{
        return $this->belongsToMany(User::class,"subscribe_user",'user_id', 'subscribe_id');
    }



    public function isAdmin():bool{
        return $this->role === 0;
    }
    public function isUser():bool{
        return $this->role === 1;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [
            'provider' => 'Music Lover'
        ];
    }

}

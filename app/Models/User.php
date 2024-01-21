<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function post_comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class);

        // return $this->hasManyThrough(
        //     Comment::class,
        //     Post::class,
        //     'user_id', // postsテーブル（中間）の外部キー
        //     'post_id', // commentsテーブルの外部キー
        //     'id', // usersテーブルのローカルキー
        //     'id' // テーブルのローカルキー
        // );
    }
}

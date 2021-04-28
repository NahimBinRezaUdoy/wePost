<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function likedBy(User $user)
    {
        //contains() is a laravel Collection Method.It allows us to look inside of that collection of object at a particular key.
        return $this->likes->contains('user_id', $user->id);
        // it returns a true or false value
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}

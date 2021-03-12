<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    
    //relacion muchos a muchos con post
    // public function posts()
    // {
    //     return $this->belongsToMany(Post::class);
    // }

    //relacion muchos a muchos con user y post, se dice que se etiquetan usuarios y posts
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'taggable');
    }
}

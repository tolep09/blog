<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'post_id'
    ];

    public function post()
    {
        //hasOne inverso belongsTo
        return $this->belongsTo(Post::class);
    }
}

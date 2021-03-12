<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Category;
use App\Models\PostImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'url_clean', 'content', 'category_id', 'posted'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    //relacion muchos a muchos con tag
    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class);
    // }
    
    //relacion de muchos a muchos entre tag, user y post
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}

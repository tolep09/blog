<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'comments', 'post_id', 'user_id', 'approved'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

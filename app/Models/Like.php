<?php

namespace App\Models;
use App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'post_id',
        'user_id'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}

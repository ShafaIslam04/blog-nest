<?php

namespace App\Models;
use App\Models\User;
use App\Models\Category;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class,'category_post');
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function isLikedByUser(){
        return $this->likes()->where('user_id',auth()->id())->exists();
    }
    public function likeCount(){
        return $this->likes()->count();
    }
}

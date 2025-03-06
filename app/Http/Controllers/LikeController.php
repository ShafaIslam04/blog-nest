<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;

class LikeController extends Controller
{
    public function store(Post $post){
        $user = auth()->User(); 

    if(!$user) {
        return redirect()->route('login');
    }
       $existingLike=$post->likes()->where('user_id',$user->id)->first();
       if($existingLike){
        $existingLike->delete();
       }else{
        $post->likes()->create([
            'user_id'=>$user->id
        ]);
       }
       return redirect(route('blogs.show', $post));

    }
}

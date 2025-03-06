<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Post $post, Request $request){
        
        $data = $request->validate([
            'body' => 'required|string'
        ]);
        
        $data['user_id'] = auth()->id();
        $data['post_id'] = $post->id;
        Comment::create($data);
        // dd($data);
        session()->flash('success', 'Your comment has been posted!');
        return redirect(route('blogs.detail',$post));
        
   }
    public function show(Post $post){
        $comments = $post->comments; 
    // return view('comment.show', compact('comments','post'));
    return redirect(route('blogs.detail',$comments,$post));

    }

    public function destroy(Comment $comment){
        if(auth()->id() !== $comment->user_id && auth()->user()->role !== 'admin'){
            return redirect(route('blogs.detail',['post' => $comment->post_id]));
             
        }
      $comment->delete();
      return redirect(route('blogs.detail',['post' => $comment->post_id]));
    }
}

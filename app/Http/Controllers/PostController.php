<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Category;


class PostController extends Controller

{   
    public function show(){
        $posts= Post::all();
        $categories = Category::all();
       
        // return view('blogs',['categories'=>$categories]);
        return view('blogs', compact('posts','categories'));
      
    }
    public function detail(Post $post){
        return view('posts.posts', compact('post'));
    }

    public function store(Request $request){
        $data =$request-> validate([
            'title'=>'required',
            'content'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'categories'=>'required|array',
            'categories.*'=>'exists:categories,id'
        ]);

        $imagePath = $request->file('image')->store('images', 'public');
        $posts = Post::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'image'=>$imagePath,
            'user_id' => Auth::id()
        ]);

        $posts->categories()->attach($request->categories);
        return redirect(route('blogs.show'));      
    }
    public function edit(Post $post){
        $categories = Category::all();
        // $post->load('categories');
        return view('posts.edit',compact('post', 'categories'));
    }
    public function update(Post $post, Request $request){
        Log::info($request->all());
        $data = $request->validate([
            'title'=>'required|string',
            'content'=>'required|string',
            'image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categories' => 'required|array',
        ]);
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        } else {
            $data['image'] = $post->image;
        }
        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        }
       
        $post->update($data);
    
        // return redirect(route('blogs.show'));
        return redirect(route('blogs.show'));
        
    }  
    public function destroy(Post $post){
        $post->delete();
        return redirect(route('blogs.show'));
    }  
    public function filter(Request $request)
{
    $query = Post::query();

    if ($request->has('categories')) {
        $query->whereHas('categories', function ($q) use ($request) {
            $q->whereIn('categories.id', $request->categories);
        });
    }

    $posts = $query->get();
    $categories = Category::all();

    return view('filteredPage', compact('posts', 'categories'));
}

public function myposts(){
    $user = Auth::user();
    $posts=Post::where('user_id',$user->id)->with('categories')->get();
    return view('myposts',compact('posts'));
    
}

    
    
}

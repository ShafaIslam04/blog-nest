<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 space-y-6 bg-pink-100 p-6 rounded-lg shadow-lg">
        <div class="bg-white shadow-lg rounded-lg p-6 flex items-center space-x-6 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
            
            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-40 h-40 object-cover rounded-lg shadow-md">

            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $post->title }}</h2>
                    
                    <div>
                        <form method="post" action={{ route('posts.store', $post) }}>
                            @csrf
                            <button type="submit" class="{{ $post->isLikedByUser() ? 'text-pink-600' : 'text-gray-500' }}">
                                <i class="far fa-heart"></i>
                            </button>
                            <span class="text-pink-600">{{ $post->likeCount() }}</span>
                        </form>
                    </div>
                </div>

                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $post->content }}</p>
                <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                    <span class="font-semibold text-pink-600">Categories:</span>
                    @foreach ($post->categories as $category)
                        <span class="bg-pink-200 text-pink-600 px-3 py-1 rounded-full text-xs">{{ $category->name }}</span>
                    @endforeach
                </div>
                <div class="flex justify-between items-center text-xs text-gray-500">
                    <p>
                        <strong>Posted by:</strong> 
                        {{ $post->user->name ?? 'Anonymous' }} 
                        <span class="text-pink-600">({{ ucfirst($post->user->role ?? 'User') }})</span>
                    </p>
                    <p><strong>Posted on:</strong> {{ $post->created_at->format('F d, Y') }}</p>
                </div>
                @if(auth()->check() && (auth()->user()->role === 'author' || auth()->user()->role === 'admin'))
                    <div class="flex justify-end items-center mt-4 space-x-4">
                        <a href="{{ route('posts.edit', $post) }}" class="text-pink-600 hover:text-pink-800 font-semibold text-sm px-4 py-2 border border-pink-600 rounded-lg hover:bg-pink-100 transition-all duration-200">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-pink-600 hover:text-pink-800 font-semibold text-sm px-4 py-2 border border-pink-600 rounded-lg hover:bg-pink-100 transition-all duration-200">
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Comments</h3>
            <form method="POST" action="{{ route('comment.store', $post) }}" class="mb-6">
                @csrf
                <div class="flex flex-col flex-grow">
                    <textarea 
                        name="body" 
                        rows="4" 
                        class="w-80 p-2 border-2 border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-gray-700"
                        placeholder="Write your comment here..." 
                        required
                    ></textarea>
                </div>
                <button type="submit" 
                    class="w-24 mt-4 py-2 bg-pink-600 text-white font-semibold text-lg rounded-lg shadow-md hover:bg-pink-700 transition-all duration-300">
                    Submit
                </button>
            </form>
        </div>

        <div class="max-w-4xl mx-auto mt-10 space-y-6 bg-pink-100 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Comments</h3>

            @if($post->comments->isEmpty())
                <p class="text-gray-500">No comments yet. Be the first to comment!</p>
            @endif

            @foreach($post->comments as $comment)
                <div class="flex items-start space-x-4 p-4 bg-pink-50 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 mb-3">
                    
                    <div class="w-10 h-10 rounded-full bg-pink-300 flex items-center justify-center text-white font-bold text-lg">
                        {{ substr($comment->user->name ?? 'A', 0, 1) }}
                    </div>

                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-pink-600">{{ $comment->user->name ?? 'Anonymous' }}</span>
                            <span class="text-xs text-gray-500">{{ $comment->created_at->format('F d, Y') }}</span>
                        </div>
                        <p class="text-gray-700 mt-1">{{ $comment->body }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

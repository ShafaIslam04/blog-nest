<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Document</title>
</head>
<x-app-layout>
<body>
    <div class="text-4xl text-slate-800 text-center font-bold p-10 font-serif">My Posts</div>
    <div class="max-w-4xl mx-auto mt-10 space-y-6 bg-pink-100 p-6 rounded-lg shadow-lg">
        @foreach ($posts as $post)
            <a href="{{ route('blogs.detail', $post) }}" class="block">
            <div class="bg-white shadow-md rounded-lg p-4 flex items-center space-x-6">
                
              <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-32 h-32 object-cover rounded-lg shadow-md">
                
                <div class="flex-1">
                    <div class="flex justify-between">
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
                    <p class="text-gray-600 text-sm mb-2">{{ $post->content }}</p>
    
                    <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                        <span class="font-semibold">Categories:</span>
                        @foreach ($post->categories as $category)
                            <span class="bg-pink-200 text-pink-600 px-2 py-1 rounded-full text-xs">{{ $category->name }}</span>
                        @endforeach
                    </div>
    
                    <div class="flex justify-between items-center text-xs text-gray-500">
                        <p><strong>Posted by:</strong> {{ $post->user->name ?? 'Anonymous' }} <span class="text-pink-600">({{ $post->user->role ?? 'Unknown Role' }})</span></p>
                        <p><strong>Posted on:</strong> {{ $post->created_at->format('F d, Y') }}</p>
                    </div>
                    @if(auth()->check()&&(auth()->user()->role==='author'||auth()->user()->role==='admin'))
                    <div class="flex justify-end items-center mt-4 space-x-4">
                        <a href="{{ route('posts.edit', ['post' => $post]) }}" class="text-pink-600 hover:text-pink-800 font-semibold text-sm px-4 py-2 border border-pink-600 rounded-lg hover:bg-pink-100 transition-all duration-200">
                            Edit
                        </a>
    
                        <form method="post" action="{{ route('posts.destroy', ['post' => $post]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-pink-600 hover:text-pink-800 font-semibold text-sm px-4 py-2 border border-pink-600 rounded-lg hover:bg-pink-100 transition-all duration-200">
                                Delete
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            </a>
        @endforeach
    </div>
</body>
</x-app-layout>
</html>
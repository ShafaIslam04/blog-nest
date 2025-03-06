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
<body class="bg-gray-100 p-8" x-data="{ openModal: false }">
 

    @if(auth()->check() && (auth()->user()->role==='author' || auth()->user()->role==='admin'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 flex justify-end">
        <button @click="openModal = true" class="bg-pink-400 text-white px-4 py-2 rounded-md hover:bg-pink-400 transition duration-300">
            Create Post
        </button>
    </div>
    @endif
    <div x-show="openModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <h2 class="text-xl font-bold mb-4">Create a Post</h2>
            <form method="POST" action="{{route('blogs.store')}}" enctype="multipart/form-data">
                @csrf
                <label class="block font-medium">Title:</label>
                <input type="text" name="title" class="border p-2 w-full rounded mb-3" required>

                <label class="block font-medium">Content:</label>
                <textarea name="content" class="border p-2 w-full rounded mb-3" required></textarea>
                
                <label class="block font-medium">Categories:</label>
                <select name="categories[]" class="border p-2 w-full rounded mb-3" required multiple>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                
                <label class="block font-medium">Image:</label>
                <input type="file" name="image" class="border p-2 w-full rounded mb-3" required>

                <div class="flex justify-end">
                    <button type="button" @click="openModal = false" class="bg-gray-400 text-white px-4 py-2 rounded mr-2">
                        Cancel
                    </button>
                    <button type="submit" class="bg-pink-300 text-white px-4 py-2 rounded">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
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
</x-app-layout>

</body>
</html>

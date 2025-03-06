<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body>
    <x-app-layout>
        @php
            $categories = App\Models\Category::all();
        @endphp
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 grid grid-cols-12 gap-6">
            <div class="col-span-12 md:col-span-3 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Filter by Category</h3>
                <form method="GET" action="{{ route('filtered.filter') }}">
                    <div class="space-y-2">
                        @foreach($categories as $category)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                    class="text-pink-500 focus:ring-pink-500"
                                    {{ in_array($category->id, request()->categories ?? []) ? 'checked' : '' }}>
                                <span class="text-gray-800">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <button type="submit" class="mt-4 w-full bg-pink-500 text-white py-2 rounded-lg shadow-md hover:bg-pink-600 transition duration-300">
                        Filter
                    </button>
                </form>
            </div>
            <div class="col-span-12 md:col-span-9">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @forelse ($posts as $post)
                    <a href="{{ route('blogs.detail', $post) }}" class="block">
                        <div class="bg-white shadow-md rounded-lg p-4">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full h-48 object-cover rounded-lg mb-4">
                            <h2 class="text-xl font-bold text-gray-800">{{ $post->title }}</h2>
                            <p class="text-gray-600 text-sm mt-2">{{ Str::limit($post->content, 100, '...') }}</p>
                        </div>
                    </a>
                    @empty
                        <p class="text-center text-gray-600 col-span-2">No posts found for selected categories.</p>
                    @endforelse
                </div>
            </div>

        </div>  

    </x-app-layout>
</body>
</html>

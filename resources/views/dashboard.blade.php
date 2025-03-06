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
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
{{-- @php
    $categories = App\Models\Category::all();
     
@endphp --}}
            {{-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 ">
                <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 flex">
                    <form method="GET" action="{{ route('dashboard.filter') }}" class="flex flex-wrap items-center space-x-4 space-y-4 sm:space-y-0">
                        <div class="w-full sm:w-auto">
                            <label for="categories" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select Categories</label>
                            <select name="categories[]" id="categories" multiple class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full p-2">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                        {{ in_array($category->id, request()->categories ?? []) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="w-full sm:w-auto">
                            <button type="submit" class="inline-block bg-pink-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-pink-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
                
            
                <div class="max-w-4xl mx-auto mt-10 space-y-6 bg-pink-100 p-6 rounded-lg shadow-lg">
                    @forelse ($posts as $post)
                        <div class="bg-white shadow-md rounded-lg p-4 flex items-center space-x-6">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-32 h-32 object-cover rounded-lg shadow-md">
                            <div class="flex-1">
                                <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $post->title }}</h2>
                                <p class="text-gray-600 text-sm mb-2">{{ $post->content }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-600">No posts found for selected categories.</p>
                    @endforelse
                </div>
            </div>
             --}}    
        
    </x-app-layout>
    
</body>
</html>


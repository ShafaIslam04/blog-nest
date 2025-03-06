<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<x-app-layout>
<body class="bg-gray-100 p-8" x-data="{ openModal: true }">

    <div x-show="openModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <h2 class="text-xl font-bold mb-4">Create a Post</h2>
@php
    $categories = App\Models\Category::all();
@endphp
<form method="post" action="{{ route('blogs.update', $post) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label class="block font-medium">Title:</label>
    <input type="text" name="title" value="{{ $post->title }}" class="border p-2 w-full rounded mb-3" required>

    <label class="block font-medium">Content:</label>
    <textarea name="content" class="border p-2 w-full rounded mb-3" required>{{ $post->content }}</textarea>

    <label class="block font-medium">Categories:</label>
    <select name="categories[]" class="border p-2 w-full rounded mb-3" multiple>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $post->categories->pluck('id')->contains($category->id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @if ($post->image)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-32 h-32 object-cover rounded-lg shadow-md mb-3">
        </div>
    @endif

    <label class="block font-medium">Image:</label>
    <input type="file" name="image" class="border p-2 w-full rounded mb-3">

    <div class="flex justify-end">
        <button type="button" @click="openModal = false" class="bg-gray-400 text-white px-4 py-2 rounded mr-2">
            Cancel
        </button>
        <button type="submit" class="bg-pink-300 text-white px-4 py-2 rounded">
            Update
        </button>
    </div>
</form>
        </div>
    </div>
</body>
</x-app-layout>
</html>

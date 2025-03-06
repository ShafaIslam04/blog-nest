<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<x-app-layout>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-6 mx-auto mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-4">Edit User</h2>

        <form method="POST" action="{{ route('show.update', $user->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div>
                <label class="block text-gray-600 font-medium mb-1">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
            </div>

            <!-- Email Field -->
            <div>
                <label class="block text-gray-600 font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
            </div>

            <div>
                <label class="block text-gray-600 font-medium mb-1">Role</label>
                <select name="role" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="author" {{ $user->role == 'author' ? 'selected' : '' }}>Author</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-pink-300 hover:bg-pink-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                    Update User
                </button>
            </div>
        </form>
    </div>

</body>
</x-app-layout>
</html>

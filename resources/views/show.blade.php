<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<x-app-layout>
<body class="bg-gray-100 p-8">

    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">
        <div class="p-6 bg-pink-200 text-white text-xl font-semibold">
            User List
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200">
                <thead class="bg-pink-100 text-gray-800">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">Id</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Role</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Edit</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Delete</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($users as $user)
                    <tr class="odd:bg-gray-100 even:bg-white hover:bg-pink-100 transition duration-300">
                        <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->role }}</td>
                            <td>
                            <a href="{{route('show.edit', ['user'=>$user])}}" class="text-pink-600 hover:text-pink-800 font-semibold text-sm px-4 py-2 border border-pink-600 rounded-lg hover:bg-pink-100 transition-all duration-200">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form method="post" action="{{route('table.destroy',['user'=>$user])}}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-pink-600 hover:text-pink-800 font-semibold text-sm px-4 py-2 border border-pink-600 rounded-lg hover:bg-pink-100 transition-all duration-200">
                                    Delete
                                </button>
                            </form>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-gray-200 text-center text-gray-700">
            Total Users: {{ count($users) }}
        </div>
    </div>

</body>
</x-app-layout>
</html>

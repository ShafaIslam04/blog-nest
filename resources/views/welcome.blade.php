<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Styles / Scripts -->
       
    </head>
    <body class=" dark:bg-[#0a0a0a]  flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="text-pink-600 hover:text-pink-800 font-semibold text-sm px-4 py-2 border border-pink-600 rounded-lg hover:bg-pink-100 transition-all duration-200"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="text-pink-600 hover:text-pink-800 font-semibold text-sm px-4 py-2 border border-pink-600 rounded-lg hover:bg-pink-100 transition-all duration-200"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="text-pink-600 hover:text-pink-800 font-semibold text-sm px-4 py-2 border border-pink-600 rounded-lg hover:bg-pink-100 transition-all duration-200">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        
                
                <!-- Left Section - Welcome Text -->
                <div class="flex justify-center items-center w-full py-16 bg-gradient-to-r from-pink-200 via-purple-300 to-indigo-400">
                    <main class="max-w-7xl w-full flex flex-col lg:flex-row justify-between items-center px-6 sm:px-12 lg:px-24 gap-12">
                        
                        <!-- Left Section - Welcome Text -->
                        <div class="flex-1 p-10 lg:p-16 bg-white dark:bg-[#2D2D2D] text-[#2C3E50] dark:text-[#EDEDED] rounded-lg shadow-2xl ">
                            <h1 class="text-5xl font-extrabold text-[#FF4081] mb-5">Welcome to Blog Nest!</h1>
                            <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                                A community to read, write, and explore diverse stories. Connect with creative minds and immerse yourself in a world of imagination.
                            </p>
                        
                            <h3 class="text-2xl text-[#FF4081] font-semibold mb-4">How to Get Started:</h3>
                            <ul class="space-y-6">
                                <li class="flex items-center gap-3 text-lg text-gray-700 dark:text-gray-300">
                                    <span class="w-6 h-6 rounded-full bg-[#FF4081] text-white flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                    Discover our <a href="{{ route('blogs.show') }}" class="text-[#FF4081] font-bold hover:underline">Latest Blog Posts</a>
                                </li>
                                <li class="flex items-center gap-3 text-lg text-gray-700 dark:text-gray-300">
                                    <span class="w-6 h-6 rounded-full bg-[#FF4081] text-white flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </span>
                                    Join and create your first post today
                                </li>
                            </ul>
                        
                            <a href="{{ route('register') }}" class="mt-6 inline-block px-8 py-3 bg-[#FF4081] text-white font-semibold rounded-full text-lg ">
                                Start Writing
                            </a>
                        </div>
                
                        <!-- Right Section - Blog Image -->
                        <div class="w-full lg:w-[450px] relative mt-8 lg:mt-0 rounded-lg overflow-hidden shadow-xl">
                            <img src="{{ asset('storage/images/cartoon-blog.jpg') }}" alt="Cartoon Blog Image" class="w-full h-full object-cover rounded-lg shadow-2xl">
                        </div>
                        
                    </main>
                </div>
                
        
        
        
        
        

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>

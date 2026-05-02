<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>School Announcement Bulletin Board</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-50">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-blue-500 selection:text-white">
            <div class="max-w-7xl mx-auto p-6 lg:p-8 w-full">
                <div class="flex justify-center mb-8">
                    <x-application-logo class="w-20 h-20 fill-current text-blue-600" />
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl p-8 md:p-12 text-center border border-gray-100">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">
                        School Announcement & <br>
                        <span class="text-blue-600">Bulletin Board System</span>
                    </h1>
                    
                    <p class="max-w-2xl mx-auto text-lg text-gray-600 mb-10 leading-relaxed">
                        Stay informed with the latest updates, events, and important news from our school. 
                        A centralized digital space for students and staff.
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        @auth
                            <a href="{{ route('bulletin') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out shadow-lg">
                                View Bulletin Board
                            </a>
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-semibold rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition duration-150 ease-in-out">
                                My Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out shadow-lg">
                                Login to System
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-semibold rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition duration-150 ease-in-out">
                                    Register Account
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 text-center">
                        <div class="bg-blue-50 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.2cfm7.532-4.706C22.239 13.181 23.193 10.4 23.193 7.5a8.959 8.959 0 01-2.012-5.707L21.108 1.5l-1.071.121c-5.255.585-10.51 1.171-15.765 1.757l-.759.085v17.307c0 .195.14.364.331.396.111.018.225-.018.318-.088l5.856-4.392 6.425-4.818z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Real-time Updates</h3>
                        <p class="text-sm text-gray-500 text-balance">Get announcements as soon as they are posted by the administration.</p>
                    </div>
                    
                    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 text-center">
                        <div class="bg-indigo-50 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Pinned Priority</h3>
                        <p class="text-sm text-gray-500 text-balance">Crucial news is pinned to the top, so you never miss what's important.</p>
                    </div>

                    <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 text-center">
                        <div class="bg-green-50 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Easy Filtering</h3>
                        <p class="text-sm text-gray-500 text-balance">Quickly sort through announcements by category or importance.</p>
                    </div>
                </div>

                <div class="mt-16 text-center text-sm text-gray-400">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </div>
            </div>
        </div>
    </body>
</html>

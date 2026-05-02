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
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">Welcome back, {{ Auth::user()->name }}!</h3>
                            <p class="text-sm text-gray-500 italic">You are logged in as a {{ ucfirst(Auth::user()->role) }}.</p>
                        </div>
                    </div>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-100">
                            <h4 class="font-semibold text-gray-700 mb-2">Bulletins</h4>
                            <p class="text-xs text-gray-500 mb-4">View the latest announcements and school updates.</p>
                            <a href="{{ route('bulletin') }}" class="text-sm text-blue-600 hover:underline font-medium">Go to Bulletin Board &rarr;</a>
                        </div>

                        @if(Auth::user()->role === 'admin')
                        <div class="p-4 bg-indigo-50 rounded-lg border border-indigo-100">
                            <h4 class="font-semibold text-indigo-700 mb-2">Admin Management</h4>
                            <p class="text-xs text-indigo-500 mb-4">Manage posts, pin important news, and view statistics.</p>
                            <a href="{{ route('admin.dashboard') }}" class="text-sm text-indigo-600 hover:underline font-medium">Admin Dashboard &rarr;</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

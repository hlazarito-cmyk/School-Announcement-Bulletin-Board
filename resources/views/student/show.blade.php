<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('bulletin') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Announcement Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full uppercase tracking-wider">
                            {{ $announcement->category }}
                        </span>
                        <span class="px-3 py-1 text-xs font-bold rounded-full uppercase tracking-wider
                            {{ $announcement->priority === 'high' ? 'bg-red-100 text-red-800' : ($announcement->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                            {{ $announcement->priority }} Priority
                        </span>
                        @if($announcement->is_pinned)
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-bold rounded-full uppercase tracking-wider">
                                Pinned
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl font-extrabold text-gray-900 mb-4">{{ $announcement->title }}</h1>
                    
                    <div class="flex items-center text-sm text-gray-500 mb-8 border-b border-gray-100 pb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Posted {{ $announcement->created_at->format('F d, Y \a\t h:i A') }}
                        <span class="mx-2">•</span>
                        By {{ $announcement->user->name }}
                    </div>

                    <div class="prose max-w-none text-gray-700 leading-relaxed whitespace-pre-wrap">
                        {{ $announcement->content }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

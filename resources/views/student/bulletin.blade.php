<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('School Bulletin Board') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filtering Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('bulletin') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                        <div>
                            <x-input-label for="category" :value="__('Category')" />
                            <select id="category" name="category" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="priority" :value="__('Priority')" />
                            <select id="priority" name="priority" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">All Priorities</option>
                                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="sort" :value="__('Sort By')" />
                            <select id="sort" name="sort" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            </select>
                        </div>

                        <div class="flex gap-2">
                            <x-primary-button>Filter</x-primary-button>
                            @if(request()->anyFilled(['category', 'priority']))
                                <a href="{{ route('bulletin') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Announcements Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($announcements as $announcement)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 {{ $announcement->is_pinned ? 'border-indigo-500' : 'border-gray-200' }} hover:shadow-md transition-shadow duration-300">
                        <div class="p-6 flex flex-col h-full">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex flex-col">
                                    <span class="text-xs font-semibold text-gray-400 uppercase">
                                        {{ $announcement->category->name ?? 'Uncategorized' }}
                                    </span>
                                    <h3 class="text-xl font-bold text-gray-900 mt-1 line-clamp-1">{{ $announcement->title }}</h3>
                                </div>
                                @if($announcement->is_pinned)
                                    <span class="bg-indigo-100 text-indigo-800 text-[10px] px-2 py-1 rounded-full font-bold uppercase shrink-0 ml-2">Pinned</span>
                                @endif
                            </div>
                            
                            <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                {{ $announcement->content }}
                            </p>

                            <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-100">
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-0.5 text-[10px] font-bold rounded-full uppercase
                                        {{ $announcement->priority === 'high' ? 'bg-red-100 text-red-800' : ($announcement->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                        {{ $announcement->priority }}
                                    </span>
                                    <span class="text-xs text-gray-400">{{ $announcement->created_at->diffForHumans() }}</span>
                                </div>
                                <a href="{{ route('bulletin.show', $announcement) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold flex items-center">
                                    Read More
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-12 text-center rounded-lg shadow-sm">
                        <p class="text-gray-500">No announcements match your criteria.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

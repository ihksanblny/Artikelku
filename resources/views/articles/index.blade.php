<x-app-layout>
    {{-- Slot untuk header halaman --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('My Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Menghapus wrapper yang berlebihan untuk menghindari card di dalam card --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Header Konten dengan Tombol Aksi --}}
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Your Articles</h3>
                        <a href="{{ route('articles.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            + Create Article
                        </a>
                    </div>

                    {{-- Cek jika tidak ada artikel --}}
                    @if ($articles->isEmpty())
                        <p class="text-gray-500">You have not written any articles yet.</p>
                    @else
                        {{-- Daftar Artikel --}}
                        <div class="space-y-4">
                            @foreach ($articles as $article)
                                <div class="flex justify-between items-center p-4 border rounded-lg hover:bg-gray-50 transition">
                                    {{-- Informasi Artikel --}}
                                    <div>
                                        <h4 class="text-md font-bold text-gray-800">{{ $article->title }}</h4>
                                        <p class="text-sm text-gray-600">
                                            Category: {{ $article->category->name ?? 'Uncategorized' }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Published at: {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d M Y') : 'Draft' }}
                                        </p>
                                    </div>
                                    
                                    {{-- Tombol Aksi (Details, Edit, Delete) dibuat simetris --}}
                                    <div class="flex items-center space-x-4">
                                        {{-- Tautan Detail --}}
                                        <a href="{{ route('articles.show', $article->id) }}"
                                           class="text-sm font-medium text-blue-600 hover:underline">Details</a>

                                        {{-- Tautan Edit --}}
                                        <a href="{{ route('articles.edit', $article->id) }}"
                                           class="text-sm font-medium text-indigo-600 hover:underline">Edit</a>

                                        {{-- Form untuk Hapus --}}
                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this article?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination Links --}}
                        @if ($articles->hasPages())
                            <div class="mt-6">
                                {{ $articles->links() }}
                            </div>
                        @endif

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
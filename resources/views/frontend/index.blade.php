@extends('frontend.layouts.app')

@section('content')
    <section class="bg-gray-50 min-h-screen py-8 px-2 sm:px-4 lg:px-0">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">📰 Artikel Terbaru</h1>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($articles as $article)
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition duration-200 p-5">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">
                            {{ $article->title }}
                        </h2>
                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit(strip_tags($article->content), 100) }}
                        </p>
                        <a href="{{ route('articles.show', $article->id) }}"
                           class="inline-block text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Baca Selengkapnya →
                        </a>
                    </div>
                @empty
                    <p class="text-gray-600 col-span-full text-center">Belum ada artikel yang tersedia.</p>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $articles->links() }}
            </div>
        </div>
    </section>
@endsection

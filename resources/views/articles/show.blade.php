<x-app-layout>
    {{-- Header halaman, menampilkan judul artikel --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight truncate">
            {{ $article->title }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 md:p-8">

                {{-- Judul Utama Artikel --}}
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>

                {{-- Gambar Thumbnail --}}
                @if ($article->thumbnail)
                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="Thumbnail"
                         class="w-full h-auto max-h-80 object-cover rounded-lg mb-4">
                @endif

                {{-- Kutipan/Excerpt --}}
                @if ($article->excerpt)
                    <p class="text-lg italic text-gray-600 border-l-4 border-gray-200 pl-4 mb-6">
                        "{{ $article->excerpt }}"
                    </p>
                @endif

                {{-- Blok Metadata (Tanggal, Kategori, Penulis) --}}
                {{-- Digabungkan dalam satu div untuk mengatur jarak secara konsisten --}}
                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-gray-600 mb-6">
                    <span>
                        Published: <strong>{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('d M Y') : 'Draft' }}</strong>
                    </span>
                    <span class="text-gray-300">|</span>
                    <span>
                        Category: <strong>{{ $article->category->name ?? 'Uncategorized' }}</strong>
                    </span>
                    <span class="text-gray-300">|</span>
                    <span>
                        Author: <strong>{{ $article->user->username }}</strong>
                    </span>
                </div>

                {{-- Konten Artikel Utama --}}
                {{-- Ditambahkan 'break-words' untuk memaksa teks panjang pindah baris --}}
                <div class="text-base text-gray-800 leading-relaxed mb-8" style="word-wrap: break-word; white-space: pre-line;">
                    {!! nl2br(e($article->content)) !!}
                </div>
                
                {{-- Menggunakan 'prose' akan menghilangkan kebutuhan nl2br dan e() jika konten disimpan sebagai HTML dari editor WYSIWYG.
                     Jika konten adalah plain text, gunakan yang ini: --}}
                {{-- <div class="text-base text-gray-800 leading-relaxed whitespace-pre-line break-words mb-8">
                    {!! nl2br(e($article->content)) !!}
                </div> --}}


                {{-- Link Kembali --}}
                <div>
                    <a href="{{ route('articles.index') }}"
                       class="inline-flex items-center text-indigo-600 hover:text-indigo-800 hover:underline text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to My Articles
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
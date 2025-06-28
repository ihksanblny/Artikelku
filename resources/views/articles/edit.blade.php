<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Edit Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Title</label>
                        <input type="text" name="title" value="{{ old('title', $article->title) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <!-- Slug -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $article->slug) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <!-- Category -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Category</label>
                        <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Excerpt -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Excerpt</label>
                        <textarea name="excerpt" rows="3" class="w-full border-gray-300 rounded-md shadow-sm">{{ old('excerpt', $article->excerpt) }}</textarea>
                    </div>

                    <!-- Content -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Content</label>
                        <textarea name="content" rows="10" class="w-full border-gray-300 rounded-md shadow-sm" required>{{ old('content', $article->content) }}</textarea>
                    </div>

                    <!-- Thumbnail -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Thumbnail</label>
                        @if ($article->thumbnail)
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" class="w-32 h-20 object-cover mb-2 rounded">
                        @endif
                        <input type="file" name="thumbnail" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="flex justify-between items-center">
                        <x-primary-button>Update Article</x-primary-button>
                        <a href="{{ route('articles.index') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

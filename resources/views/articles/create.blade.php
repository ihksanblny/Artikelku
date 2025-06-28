<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                            :value="old('title')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <!-- Slug -->
                    <div class="mb-4">
                        <x-input-label for="slug" :value="__('Slug')" />
                        <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full"
                            :value="old('slug')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                    </div>

                    <!-- Category Dropdown -->
                    <div class="mb-4">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                    </div>

                    <!-- Excerpt -->
                    <div class="mb-4">
                        <x-input-label for="excerpt" :value="__('Excerpt')" />
                        <textarea name="excerpt" id="excerpt" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('excerpt') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('excerpt')" />
                    </div>

                    <!-- Content -->
                    <div class="mb-4">
                        <x-input-label for="content" :value="__('Content')" />
                        <textarea name="content" id="content" rows="10"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('content') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('content')" />
                    </div>

                    <!-- Thumbnail -->
                    <div class="mb-4">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <input type="file" name="thumbnail" id="thumbnail"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0 file:text-sm file:font-semibold
                            file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
                    </div>

                    <!-- Published At -->
                    <div class="mb-4">
                        <x-input-label for="published_at" :value="__('Publish Date')" />
                        <x-text-input id="published_at" name="published_at" type="datetime-local"
                            class="mt-1 block w-full" :value="old('published_at')" />
                        <x-input-error class="mt-2" :messages="$errors->get('published_at')" />
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <x-primary-button>{{ __('Publish') }}</x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<section class="max-w-3xl mx-auto">
    <header>
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __("Update your account's profile information.") }}
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        @php $isAdmin = $user->role === 'admin'; @endphp

        {{-- Username --}}
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input id="username" name="username" type="text" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                value="{{ old('username', $user->username) }}" @disabled($isAdmin) required>
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                value="{{ old('email', $user->email) }}" @disabled($isAdmin) required>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        {{-- Bio --}}
        <div>
            <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
            <textarea id="bio" name="bio" rows="4" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                @disabled($isAdmin)>{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        {{-- Avatar --}}
        <div>
            <label for="avatar" class="block text-sm font-medium text-gray-700">Avatar</label>
            @if ($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-20 h-20 rounded-full object-cover mt-2 mb-3">
            @endif
            <input id="avatar" name="avatar" type="file" @disabled($isAdmin)
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        {{-- Role --}}
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <input id="role" type="text" value="{{ $user->role }}" disabled
                class="mt-1 w-full rounded-md bg-gray-100 border-gray-300 text-gray-700 cursor-not-allowed shadow-sm" />
        </div>

        {{-- Submit --}}
        <div class="flex justify-end mt-6">
            @if (!$isAdmin)
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            @else
                <x-primary-button disabled class="opacity-50 cursor-not-allowed">
                    {{ __('Save') }}
                </x-primary-button>
            @endif
        </div>
    </form>
</section>

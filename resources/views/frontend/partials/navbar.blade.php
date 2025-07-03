<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ url('/home') }}" class="text-2xl font-bold text-blue-600">ArtikelKu</a>

        <div class="space-x-6 text-sm font-medium">
            <a href="{{ url('/home') }}" class="text-gray-700 hover:text-blue-600">Beranda</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Kategori</a>

            @auth
                <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700">Login</a>
            @endauth
        </div>
    </div>
</nav>

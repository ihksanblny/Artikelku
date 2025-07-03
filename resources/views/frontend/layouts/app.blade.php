<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ArtikelKu - Reader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    @include('frontend.partials.navbar')

    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    @include('frontend.partials.footer')

</body>
</html>

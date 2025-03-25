<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Larisin Aja Mart - Toko Idamanmu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Selamat Datang Di Larisin Aja Mart</h1>
        <p class="text-gray-600 mb-6">Tujuan Belanja Untuk Anda</p>
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Daftar</a>
            <a href="{{ route('login') }}" class="px-6 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-800">Masuk</a>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans bg-gray-100 flex justify-center items-center min-h-screen p-8">
    <div class="bg-white p-10 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Daftar Akun Baru</h2>

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="bg-red-50 text-red-700 border border-red-200 p-4 mb-6 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="name" class="block font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="mb-6">
                <label for="email" class="block font-semibold text-gray-700 mb-2">Email Address</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" value="{{ old('email') }}" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block font-semibold text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" required>
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" required>
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-bold rounded-xl cursor-pointer transition-colors duration-200 ease-in-out border-none shadow-md hover:bg-indigo-700">Daftar</button>
            </div>

            <div class="mt-6 text-center text-sm">
                Sudah punya akun? <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Login di sini</a>
            </div>
        </form>
    </div>
</body>
</html>

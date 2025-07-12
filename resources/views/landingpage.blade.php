<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Aplikasi Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* No custom video background styles needed anymore */
    </style>
</head>
<body class="font-sans bg-gray-100 flex justify-center items-center min-h-screen p-8">

    {{-- Navbar --}}
    <nav class="bg-indigo-700 p-4 fixed top-0 w-full z-20 shadow-md">
        <div class="container mx-auto flex justify-between items-center px-4">
            {{-- Logo in Navbar --}}
            <a href="#" class="flex items-center space-x-2 text-white text-2xl font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                </svg>
                <span>Aplikasi Mahasiswa</span>
            </a>

            {{-- Navigation Links --}}
            <div class="space-x-6">
                <a href="{{ route('landingPage') }}" class="text-white hover:text-indigo-200 transition-colors duration-200">Home</a>
                <a href="{{ route('indexRegistration') }}" class="text-white hover:text-indigo-200 transition-colors duration-200">Registrasi</a>
            </div>
        </div>
    </nav>

    {{-- Main content area --}}
    <div class="bg-white p-10 rounded-2xl shadow-lg w-full max-w-2xl text-center relative z-10 mt-16 md:mt-20"> 
        
        {{-- PNJ Logo --}}
        <img src="{{ asset('PNJLOGO.jpeg') }}" alt="PNJ Logo" class="mx-auto mb-8 h-28 sm:h-32 object-contain">

        <h1 class="text-4xl font-bold text-gray-800 mb-6">Selamat Datang di Aplikasi Mahasiswa!</h1>

        {{-- Display session status messages (e.g., from successful login) --}}
        @if (session('status'))
            <div class="bg-blue-50 text-blue-700 border border-blue-200 p-4 mb-6 rounded-lg mx-auto max-w-md">
                {{ session('status') }}
            </div>
        @endif

        {{-- Display session error messages (e.g., from unauthorized access) --}}
        @if (session('error'))
            <div class="bg-red-50 text-red-700 border border-red-200 p-4 mb-6 rounded-lg mx-auto max-w-md">
                {{ session('error') }}
            </div>
        @endif

        {{-- Display session success messages (e.g., from data submission) --}}
        @if (session('success'))
            <div class="bg-green-50 text-green-700 border border-green-200 p-4 mb-6 rounded-lg mx-auto max-w-md">
                {{ session('success') }}
            </div>
        @endif

        <p class="text-lg text-gray-600 mb-8">
            Anda telah berhasil login. Di sini Anda dapat mendaftarkan data mahasiswa baru.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4">
            {{-- Button to navigate to the registration form --}}
            <a href="{{ route('indexRegistration') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl cursor-pointer transition-colors duration-200 ease-in-out border-none no-underline shadow-md hover:bg-indigo-700">
                Daftar Mahasiswa Baru
            </a>
            
            {{-- Logout button --}}
            <form action="{{ route('logout') }}" method="POST" class="inline-block">
                @csrf
                <button type="submit" class="inline-block px-6 py-3 bg-red-600 text-white font-semibold rounded-xl cursor-pointer transition-colors duration-200 ease-in-out border-none shadow-md hover:bg-red-700">
                    Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Aplikasi</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Inter from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans bg-gray-100 flex justify-center items-center min-h-screen p-8">
    <div class="bg-white p-10 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Login Aplikasi</h2>

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

        {{-- Display session errors (e.g., from failed login attempt) --}}
        @if (session('error'))
            <div class="bg-red-50 text-red-700 border border-red-200 p-4 mb-6 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        {{-- Display session success/info messages --}}
        @if (session('status'))
            <div class="bg-blue-50 text-blue-700 border border-blue-200 p-4 mb-6 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="email" class="block font-semibold text-gray-700 mb-2">Email Address</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-6">
                <label for="password" class="block font-semibold text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" required>
            </div>

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        Ingat Saya
                    </label>
                </div>

                {{-- Link to forgot password (optional, uncomment if you implement it) --}}
                {{--
                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Lupa Password?
                    </a>
                </div>
                --}}
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-bold rounded-xl cursor-pointer transition-colors duration-200 ease-in-out border-none shadow-md hover:bg-indigo-700">Login</button>
            </div>
            
            <div class="mt-6 text-center text-sm">
                Belum punya akun? <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Daftar di sini</a>
            </div>
           
        </form>
    </div>
</body>
</html>

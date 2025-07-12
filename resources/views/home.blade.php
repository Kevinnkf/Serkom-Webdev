<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Inter from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans bg-gray-100 min-h-screen p-8">
    <div class="bg-white p-10 rounded-2xl shadow-lg w-full max-w-5xl mx-auto my-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Mahasiswa</h1>

        {{-- Success message display --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 p-4 mb-6 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- Button to add new student --}}
        <form action="{{ route('logout') }}" method="POST" class="inline-block">
            @csrf
            <button type="submit" class="inline-block px-6 py-3 bg-red-600 text-white font-semibold rounded-xl cursor-pointer transition-colors duration-200 ease-in-out border-none shadow-md hover:bg-red-700">
                Logout
            </button>
        </form>
        <a href="{{ route('indexRegistration') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl cursor-pointer transition-colors duration-200 ease-in-out border-none no-underline shadow-md hover:bg-indigo-700 mb-6">Tambah Mahasiswa</a>

        {{-- Mahasiswa list table --}}
        <div class="overflow-x-auto"> {{-- Add horizontal scroll for small screens --}}
            <table class="w-full border-collapse mt-6">
                <thead>
                    <tr>
                        <th class="bg-gray-50 font-semibold text-gray-700 uppercase text-sm p-4 border border-gray-200 text-left">Nama Lengkap</th>
                        <th class="bg-gray-50 font-semibold text-gray-700 uppercase text-sm p-4 border border-gray-200 text-left">Email</th>
                        <th class="bg-gray-50 font-semibold text-gray-700 uppercase text-sm p-4 border border-gray-200 text-left">Domisili</th>
                        <th class="bg-gray-50 font-semibold text-gray-700 uppercase text-sm p-4 border border-gray-200 text-left">Tanggal Lahir</th>
                        <th class="bg-gray-50 font-semibold text-gray-700 uppercase text-sm p-4 border border-gray-200 text-left">Jenis Kelamin</th>
                        <th class="bg-gray-50 font-semibold text-gray-700 uppercase text-sm p-4 border border-gray-200 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswas as $mahasiswa)
                        {{-- Make the row clickable using JavaScript --}}
                        <tr class="even:bg-gray-50 hover:bg-blue-50 cursor-pointer"
                            onclick="window.location='{{ route('edit', $mahasiswa->id) }}'">
                            <td class="p-4 border border-gray-200 text-left">{{ $mahasiswa->namaLengkap }}</td>
                            <td class="p-4 border border-gray-200 text-left">{{ $mahasiswa->email }}</td>
                            <td class="p-4 border border-gray-200 text-left">{{ $mahasiswa->domisili }}</td>
                            <td class="p-4 border border-gray-200 text-left">{{ $mahasiswa->tanggalLahir }}</td>
                            <td class="p-4 border border-gray-200 text-left">{{ $mahasiswa->jenisKelamin }}</td>
                            <td class="p-4 border border-gray-200 text-left">
                                {{-- Aksi button --}}
                                <a href="{{ route('edit', $mahasiswa->id) }}" class="inline-block px-3 py-1 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 mr-2">Edit</a>
                                <form action="{{ route('destroy', $mahasiswa->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin hapus data ini?')" class="px-3 py-1 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4 p-4 border border-gray-200">Belum ada data mahasiswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
       <div class="mt-6 flex m-3 justify-center">
            {{ $mahasiswas->links('pagination::tailwind') }}
        </div>
    </div>
</body>
</html>

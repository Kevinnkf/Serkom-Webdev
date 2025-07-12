<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran Mahasiswa</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
                font-size: 10pt;
            }
            .no-print {
                display: none !important;
            }
            .bg-white, .shadow-lg {
                background-color: transparent !important;
                box-shadow: none !important;
            }
            .grid-cols-1.md\:grid-cols-2 {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body class="font-sans bg-gray-100 flex justify-center items-center min-h-screen p-8">
    <div class="bg-white p-10 rounded-2xl shadow-lg w-full max-w-4xl mx-auto my-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Bukti Pendaftaran Mahasiswa</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 p-4 mb-6 rounded-lg mx-auto max-w-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-gray-700 text-lg">
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Nama Lengkap:</p>
                <p>{{ $mahasiswa->namaLengkap }}</p>
            </div>
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Email:</p>
                <p>{{ $mahasiswa->email }}</p>
            </div>
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Nomor Telepon:</p>
                <p>{{ $mahasiswa->nomorTelepon ?? '-' }}</p>
            </div>
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Nomor HP:</p>
                <p>{{ $mahasiswa->nomorHP }}</p>
            </div>
            <!-- Kewarganegaraan -->
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Kewarganegaraan:</p>
                <p>
                    {{ $mahasiswa->kewarganegaraan }}
                    @if ($mahasiswa->kewarganegaraan == 'WNA' && $mahasiswa->kewarganegaraan_detail)
                        ({{ $mahasiswa->kewarganegaraan_detail }})
                    @endif
                </p>
            </div>
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Tanggal Lahir:</p>
                <p>{{ \Carbon\Carbon::parse($mahasiswa->tanggalLahir)->format('d F Y') }}</p>
            </div>
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Tempat Lahir:</p>
                <p>{{ $mahasiswa->tempatLahir }}</p>
            </div>
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Provinsi Lahir:</p>
                <p>{{ $mahasiswa->provinsiLahir }}</p>
            </div>
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Kota Lahir:</p>
                <p>{{ $mahasiswa->kotaLahir }}</p>
            </div>
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Jenis Kelamin:</p>
                <p>{{ $mahasiswa->jenisKelamin }}</p>
            </div>
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Status Menikah:</p>
                <p>{{ $mahasiswa->statusMenikah }}</p>
            </div>
            {{-- {{ dd($mahasiswa->agama) }} --}}
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Agama:</p>
                <p>{{ $mahasiswa->agama->name ?? '-' }}</p> {{-- Menggunakan relasi agama --}}
            </div>
            <!-- AKHIR PERUBAHAN AGAMA -->
            <div class="mb-2 md:col-span-2">
                <p class="font-semibold text-gray-800">Alamat Lengkap:</p>
                <p>{{ $mahasiswa->alamat }}</p>
            </div>
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Domisili:</p>
                <p>{{ $mahasiswa->domisili }}</p>
            </div>
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Provinsi Domisili:</p>
                <p>{{ $mahasiswa->province->name ?? '-' }}</p>
            </div>
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Kota/Kabupaten Domisili:</p>
                <p>{{ $mahasiswa->city->name ?? '-' }}</p>
            </div>
            <div class="mb-2">
                <p class="font-semibold text-gray-800">Kecamatan Domisili:</p>
                <p>{{ $mahasiswa->district->name ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-8 text-center no-print">
            <a href="{{ route('registration.proof.pdf', $mahasiswa->id) }}" class="inline-block px-6 py-3 bg-green-600 text-white font-semibold rounded-xl cursor-pointer transition-colors duration-200 ease-in-out border-none no-underline shadow-md hover:bg-green-700 mr-4">
                Unduh PDF
            </a>
            <a href="{{ route('landingPage') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl cursor-pointer transition-colors duration-200 ease-in-out border-none no-underline shadow-md hover:bg-indigo-700">
                Kembali ke Halaman Utama
            </a>
        </div>
    </div>
</body>
</html>

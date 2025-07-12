<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }
        .form-container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 800px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            color: #4b5563;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        .form-radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .form-radio-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: #4b5563;
        }
        .form-radio-input {
            margin-right: 0.5rem;
            accent-color: #6366f1; /* Untuk mengubah warna radio button */
        }
        .submit-button {
            width: 100%;
            padding: 1rem;
            background-color: #6366f1;
            color: #ffffff;
            font-weight: 700;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .submit-button:hover {
            background-color: #4f46e5;
        }
        .grid-cols-2 {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.5rem;
        }
        @media (min-width: 640px) {
            .grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Edit Data Mahasiswa</h2>

        <form action="{{ route('update', $mahasiswa->id) }}" method="POST">
            @csrf <!-- Laravel CSRF Token untuk keamanan -->
            @method('PUT') <!-- Menggunakan metode PUT untuk update data -->

            <div class="grid-cols-2">
                <!-- Nama Lengkap -->
                <div class="form-group">
                    <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" id="namaLengkap" name="namaLengkap" class="form-input" placeholder="Masukkan nama lengkap" value="{{ old('namaLengkap', $mahasiswa->namaLengkap) }}" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="Masukkan alamat email" value="{{ old('email', $mahasiswa->email) }}" required>
                </div>

                <!-- Nomor Telepon -->
                <div class="form-group">
                    <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                    <input type="tel" id="nomorTelepon" name="nomorTelepon" class="form-input" placeholder="Masukkan nomor telepon (opsional)" value="{{ old('nomorTelepon', $mahasiswa->nomorTelepon) }}">
                </div>

                <!-- Nomor HP -->
                <div class="form-group">
                    <label for="nomorHP" class="form-label">Nomor HP</label>
                    <input type="tel" id="nomorHP" name="nomorHP" class="form-input" placeholder="Masukkan nomor HP" value="{{ old('nomorHP', $mahasiswa->nomorHP) }}" required>
                </div>

                <!-- Kewarganegaraan -->
                <div class="form-group">
                    <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
                    <input type="text" id="kewarganegaraan" name="kewarganegaraan" class="form-input" placeholder="Contoh: Indonesia" value="{{ old('kewarganegaraan', $mahasiswa->kewarganegaraan) }}" required>
                </div>

                <!-- Tanggal Lahir -->
                <div class="form-group">
                    <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" id="tanggalLahir" name="tanggalLahir" class="form-input" value="{{ old('tanggalLahir', $mahasiswa->tanggalLahir) }}" required>
                </div>

                <!-- Tempat Lahir -->
                <div class="form-group">
                    <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                    <input type="text" id="tempatLahir" name="tempatLahir" class="form-input" placeholder="Contoh: Jakarta" value="{{ old('tempatLahir', $mahasiswa->tempatLahir) }}" required>
                </div>

                <!-- Provinsi Lahir -->
                <div class="form-group">
                    <label for="provinsiLahir" class="form-label">Provinsi Lahir</label>
                    <input type="text" id="provinsiLahir" name="provinsiLahir" class="form-input" placeholder="Contoh: DKI Jakarta" value="{{ old('provinsiLahir', $mahasiswa->provinsiLahir) }}" required>
                </div>

                <!-- Kota Lahir -->
                <div class="form-group">
                    <label for="kotaLahir" class="form-label">Kota Lahir</label>
                    <input type="text" id="kotaLahir" name="kotaLahir" class="form-input" placeholder="Contoh: Jakarta Pusat" value="{{ old('kotaLahir', $mahasiswa->kotaLahir) }}" required>
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <div class="form-radio-group">
                        <label class="form-radio-label">
                            <input type="radio" name="jenisKelamin" value="Laki-laki" class="form-radio-input" {{ old('jenisKelamin', $mahasiswa->jenisKelamin) == 'Laki-laki' ? 'checked' : '' }} required> Laki-laki
                        </label>
                        <label class="form-radio-label">
                            <input type="radio" name="jenisKelamin" value="Perempuan" class="form-radio-input" {{ old('jenisKelamin', $mahasiswa->jenisKelamin) == 'Perempuan' ? 'checked' : '' }}> Perempuan
                        </label>
                    </div>
                </div>

                <!-- Status Menikah -->
                <div class="form-group">
                    <label class="form-label">Status Menikah</label>
                    <div class="form-radio-group">
                        <label class="form-radio-label">
                            <input type="radio" name="statusMenikah" value="Belum Menikah" class="form-radio-input" {{ old('statusMenikah', $mahasiswa->statusMenikah) == 'Belum Menikah' ? 'checked' : '' }} required> Belum Menikah
                        </label>
                        <label class="form-radio-label">
                            <input type="radio" name="statusMenikah" value="Menikah" class="form-radio-input" {{ old('statusMenikah', $mahasiswa->statusMenikah) == 'Menikah' ? 'checked' : '' }}> Menikah
                        </label>
                        <label class="form-radio-label">
                            <input type="radio" name="statusMenikah" value="Cerai Hidup" class="form-radio-input" {{ old('statusMenikah', $mahasiswa->statusMenikah) == 'Cerai Hidup' ? 'checked' : '' }}> Cerai Hidup
                        </label>
                        <label class="form-radio-label">
                            <input type="radio" name="statusMenikah" value="Cerai Mati" class="form-radio-input" {{ old('statusMenikah', $mahasiswa->statusMenikah) == 'Cerai Mati' ? 'checked' : '' }}> Cerai Mati
                        </label>
                    </div>
                </div>

                <!-- Agama -->
                <div class="form-group">
                    <label for="agama" class="form-label">Agama</label>
                    <select id="agama" name="agama" class="form-select" required>
                        <option value="">Pilih Agama</option>
                        <option value="Islam" {{ old('agama', $mahasiswa->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ old('agama', $mahasiswa->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ old('agama', $mahasiswa->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ old('agama', $mahasiswa->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ old('agama', $mahasiswa->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ old('agama', $mahasiswa->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        <option value="Lainnya" {{ old('agama', $mahasiswa->agama) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
            </div>

            <!-- Alamat (di luar grid agar mengambil seluruh lebar) -->
            <div class="form-group">
                <label for="alamat" class="form-label">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" rows="3" class="form-textarea" placeholder="Masukkan alamat lengkap Anda" required>{{ old('alamat', $mahasiswa->alamat) }}</textarea>
            </div>

            <div class="grid-cols-2">
                <!-- Domisili -->
                <div class="form-group">
                    <label for="domisili" class="form-label">Domisili</label>
                    <input type="text" id="domisili" name="domisili" class="form-input" placeholder="Masukkan domisili saat ini" value="{{ old('domisili', $mahasiswa->domisili) }}" required>
                </div>

                <!-- Provinsi -->
                <div class="form-group">
                    <label for="provinsi" class="form-label">Provinsi</label>
                    <input type="text" id="provinsi" name="provinsi" class="form-input" placeholder="Contoh: Jawa Barat" value="{{ old('provinsi', $mahasiswa->provinsi) }}" required>
                </div>

                <!-- Kota -->
                <div class="form-group">
                    <label for="kota" class="form-label">Kota/Kabupaten</label>
                    <input type="text" id="kota" name="kota" class="form-input" placeholder="Contoh: Bandung" value="{{ old('kota', $mahasiswa->kota) }}" required>
                </div>

                <!-- Kecamatan -->
                <div class="form-group">
                    <label for="kecamatan" class="form-label">Kecamatan</label>
                    <input type="text" id="kecamatan" name="kecamatan" class="form-input" placeholder="Contoh: Coblong" value="{{ old('kecamatan', $mahasiswa->kecamatan) }}" required>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="form-group mt-6">
                <button type="submit" class="submit-button">Update Data Mahasiswa</button>
            </div>
        </form>
    </div>
</body>
</html>

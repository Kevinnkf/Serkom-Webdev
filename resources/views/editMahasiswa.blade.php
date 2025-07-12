<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans bg-gray-100 flex justify-center items-center min-h-screen p-8">
    <div class="bg-white p-10 rounded-2xl shadow-lg w-full max-w-4xl mx-auto my-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Edit Data Mahasiswa</h2>
        
        @if ($errors->any())
            <div class="bg-red-50 text-red-700 border border-red-200 p-4 mb-6 rounded-lg">
                <p class="font-bold mb-2">Ada beberapa masalah dengan input Anda:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('update', $mahasiswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <div class="mb-6">
                    <label for="namaLengkap" class="block font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" id="namaLengkap" name="namaLengkap" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" placeholder="Masukkan nama lengkap" value="{{ old('namaLengkap', $mahasiswa->namaLengkap) }}" required>
                </div>

                
                <div class="mb-6">
                    <label for="email" class="block font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" placeholder="Masukkan alamat email" value="{{ old('email', $mahasiswa->email) }}" required>
                </div>

                
                <div class="mb-6">
                    <label for="nomorTelepon" class="block font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="tel" id="nomorTelepon" name="nomorTelepon" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" placeholder="Masukkan nomor telepon (opsional)" value="{{ old('nomorTelepon', $mahasiswa->nomorTelepon) }}">
                </div>

                
                <div class="mb-6">
                    <label for="nomorHP" class="block font-semibold text-gray-700 mb-2">Nomor HP</label>
                    <input type="tel" id="nomorHP" name="nomorHP" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" placeholder="Masukkan nomor HP" value="{{ old('nomorHP', $mahasiswa->nomorHP) }}" required>
                </div>

                @php
                    $selectedKewarganegaraan = old('kewarganegaraan', $mahasiswa->kewarganegaraan ?? '');
                @endphp
                            
                <div class="mb-6 col-span-full">
                    <label class="block font-semibold text-gray-700 mb-2">Kewarganegaraan</label>
                    <div class="flex flex-wrap gap-4 mb-4">
                        <label class="flex items-center cursor-pointer text-gray-700">
                            <input type="radio" name="kewarganegaraan" value="WNI"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mr-2"
                                {{ $selectedKewarganegaraan === 'WNI' ? 'checked' : '' }} required>
                            WNI
                        </label>

                        <label class="flex items-center cursor-pointer text-gray-700">
                            <input type="radio" name="kewarganegaraan" value="WNI Keturunan"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mr-2"
                                {{ $selectedKewarganegaraan === 'WNI Keturunan' ? 'checked' : '' }}>
                            WNI Keturunan
                        </label>

                        <label class="flex items-center cursor-pointer text-gray-700">
                            <input type="radio" name="kewarganegaraan" value="WNA"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mr-2"
                                {{ ($selectedKewarganegaraan !== 'WNI' && $selectedKewarganegaraan !== 'WNI Keturunan') ? 'checked' : '' }}>    
                            WNA
                        </label>
                    </div>

                    {{-- <label class="block font-semibold text-gray-700 mb-2">{{ old('kewarganegaraan_detail', $mahasiswa->kewarganegaraan ?? '') }}</label> --}}

                    <div id="wnaDetailField" class="{{ $selectedKewarganegaraan === 'WNA' ? '' : 'hidden' }} mt-4">
                        <label for="kewarganegaraan_detail" class="block font-semibold text-gray-700 mb-2">Sebutkan Kewarganegaraan Anda</label>
                        <input type="text" id="kewarganegaraan_detail" name="kewarganegaraan_detail"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out"
                            placeholder="Contoh: Malaysia, Singapura"
                            value="{{ old('kewarganegaraan_detail', $mahasiswa->kewarganegaraan ?? '') }}">
                    </div>
                </div>

                
                <div class="mb-6">
                    <label for="tanggalLahir" class="block font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                    <input type="date" id="tanggalLahir" name="tanggalLahir" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" value="{{ old('tanggalLahir', $mahasiswa->tanggalLahir ? \Carbon\Carbon::parse($mahasiswa->tanggalLahir)->format('Y-m-d') : '') }}" required>
                </div>

                
                <div class="mb-6">
                    <label for="tempatLahir" class="block font-semibold text-gray-700 mb-2">Tempat Lahir</label>
                    <input type="text" id="tempatLahir" name="tempatLahir" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" placeholder="Contoh: Jakarta" value="{{ old('tempatLahir', $mahasiswa->tempatLahir) }}" required>
                </div>

                
                <div class="mb-6">
                    <label for="provinsiLahir" class="block font-semibold text-gray-700 mb-2">Provinsi Lahir</label>
                    <input type="text" id="provinsiLahir" name="provinsiLahir" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" placeholder="Contoh: DKI Jakarta" value="{{ old('provinsiLahir', $mahasiswa->provinsiLahir) }}" required>
                </div>

                
                <div class="mb-6">
                    <label for="kotaLahir" class="block font-semibold text-gray-700 mb-2">Kota Lahir</label>
                    <input type="text" id="kotaLahir" name="kotaLahir" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" placeholder="Contoh: Jakarta Pusat" value="{{ old('kotaLahir', $mahasiswa->kotaLahir) }}" required>
                </div>
                
                <div class="mb-6">
                    <label for="domisili" class="block font-semibold text-gray-700 mb-2">Domisili</label>
                    <input type="text" id="domisili" name="domisili" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" placeholder="Contoh: Jakarta Pusat" value="{{ old('domisili', $mahasiswa->domisili) }}" required>
                </div>

                
                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">Jenis Kelamin</label>
                    <div class="flex flex-wrap gap-4">
                        <label class="flex items-center cursor-pointer text-gray-700">
                            <input type="radio" name="jenisKelamin" value="Laki-laki" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mr-2" {{ old('jenisKelamin', $mahasiswa->jenisKelamin) == 'Laki-laki' ? 'checked' : '' }} required> Laki-laki
                        </label>
                        <label class="flex items-center cursor-pointer text-gray-700">
                            <input type="radio" name="jenisKelamin" value="Perempuan" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mr-2" {{ old('jenisKelamin', $mahasiswa->jenisKelamin) == 'Perempuan' ? 'checked' : '' }}> Perempuan
                        </label>
                    </div>
                </div>

                
                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">Status Menikah</label>
                    <div class="flex flex-wrap gap-4">
                        <label class="flex items-center cursor-pointer text-gray-700">
                            <input type="radio" name="statusMenikah" value="Belum Menikah" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mr-2" {{ old('statusMenikah', $mahasiswa->statusMenikah) == 'Belum Menikah' ? 'checked' : '' }} required> Belum Menikah
                        </label>
                        <label class="flex items-center cursor-pointer text-gray-700">
                            <input type="radio" name="statusMenikah" value="Menikah" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mr-2" {{ old('statusMenikah', $mahasiswa->statusMenikah) == 'Menikah' ? 'checked' : '' }}> Menikah
                        </label>
                        <label class="flex items-center cursor-pointer text-gray-700">
                            <input type="radio" name="statusMenikah" value="Cerai Hidup" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mr-2" {{ old('statusMenikah', $mahasiswa->statusMenikah) == 'Cerai Hidup' ? 'checked' : '' }}> Cerai Hidup
                        </label>
                        <label class="flex items-center cursor-pointer text-gray-700">
                            <input type="radio" name="statusMenikah" value="Cerai Mati" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mr-2" {{ old('statusMenikah', $mahasiswa->statusMenikah) == 'Cerai Mati' ? 'checked' : '' }}> Cerai Mati
                        </label>
                    </div>
                </div>

                
                <div class="mb-6 col-span-full">
                    <label class="block font-semibold text-gray-700 mb-2">Agama</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach($agamas as $agama)
                            <label class="flex items-center cursor-pointer text-gray-700">
                                <input type="radio" name="agama_id" value="{{ $agama->id }}" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mr-2" {{ old('agama_id', $mahasiswa->agama_id) == $agama->id ? 'checked' : '' }} required> {{ $agama->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            
            <div class="mb-6">
                <label for="alamat" class="block font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" placeholder="Masukkan alamat lengkap Anda" required>{{ old('alamat', $mahasiswa->alamat) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <div class="mb-6">
                    <label for="province_id" class="block font-semibold text-gray-700 mb-2">Provinsi</label>
                    <select id="province_id" name="province_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" required>
                        <option value="">Pilih Provinsi</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}" {{ old('province_id', $mahasiswa->province_id) == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>

                
                <div class="mb-6">
                    <label for="city_id" class="block font-semibold text-gray-700 mb-2">Kota/Kabupaten</label>
                    <select id="city_id" name="city_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" required disabled>
                        <option value="">Pilih Kota/Kabupaten</option>
                        {{-- Options will be loaded by JavaScript --}}
                        @if(isset($cities))
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id', $mahasiswa->city_id) == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                
                <div class="mb-6">
                    <label for="district_id" class="block font-semibold text-gray-700 mb-2">Kecamatan</label>
                    <select id="district_id" name="district_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-150 ease-in-out" required disabled>
                        <option value="">Pilih Kecamatan</option>
                        {{-- Options will be loaded by JavaScript --}}
                        @if(isset($districts))
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" {{ old('district_id', $mahasiswa->district_id) == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            
            <div class="mt-8">
                <button type="submit" class="w-full py-4 bg-indigo-600 text-white font-bold rounded-xl cursor-pointer transition-colors duration-200 ease-in-out border-none shadow-md hover:bg-indigo-700">Update Data Mahasiswa</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Dropdowns for Domicile
            const provinceSelect = document.getElementById('province_id');
            const citySelect = document.getElementById('city_id');
            const districtSelect = document.getElementById('district_id');

            // Kewarganegaraan elements
            const kewarganegaraanRadios = document.querySelectorAll('input[name="kewarganegaraan"]');
            const wnaDetailField = document.getElementById('wnaDetailField');
            const kewarganegaraanDetailInput = document.getElementById('kewarganegaraan_detail');


            // Function to load cities based on province ID
            async function loadCities(provinceId, selectedCityId = null) {
                citySelect.innerHTML = '<option value="">Memuat...</option>';
                citySelect.disabled = true;
                districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                districtSelect.disabled = true;

                if (!provinceId) {
                    citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                    return;
                }

                try {
                    const response = await fetch(`/api/cities/${provinceId}`);
                    const cities = await response.json();

                    citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        if (selectedCityId && selectedCityId == city.id) {
                            option.selected = true;
                        }
                        citySelect.appendChild(option);
                    });
                    citySelect.disabled = false;
                    if (selectedCityId) {
                        loadDistricts(selectedCityId, {{ old('district_id', $mahasiswa->district_id ?? 'null') }});
                    }
                } catch (error) {
                    console.error('Error loading cities:', error);
                    citySelect.innerHTML = '<option value="">Gagal memuat kota</option>';
                }
            }

            // Function to load districts based on city ID
            async function loadDistricts(cityId, selectedDistrictId = null) {
                districtSelect.innerHTML = '<option value="">Memuat...</option>';
                districtSelect.disabled = true;

                if (!cityId) {
                    districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    return;
                }

                try {
                    const response = await fetch(`/api/districts/${cityId}`);
                    const districts = await response.json();

                    districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    districts.forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.id;
                        option.textContent = district.name;
                        if (selectedDistrictId && selectedDistrictId == district.id) {
                            option.selected = true;
                        }
                        districtSelect.appendChild(option);
                    });
                    districtSelect.disabled = false;
                } catch (error) {
                    console.error('Error loading districts:', error);
                    districtSelect.innerHTML = '<option value="">Gagal memuat kecamatan</option>';
                }
            }

            // Event listeners for Domicile dropdowns
            provinceSelect.addEventListener('change', function () {
                loadCities(this.value);
            });

            citySelect.addEventListener('change', function () {
                loadDistricts(this.value);
            });

            // Initial load for edit form (pre-fill existing data)
            const initialProvinceId = {{ old('province_id', $mahasiswa->province_id ?? 'null') }};
            const initialCityId = {{ old('city_id', $mahasiswa->city_id ?? 'null') }};
            const initialDistrictId = {{ old('district_id', $mahasiswa->district_id ?? 'null') }};

            if (initialProvinceId) {
                loadCities(initialProvinceId, initialCityId);
            }

            // --- JavaScript for Kewarganegaraan conditional field ---
            function toggleWnaDetailField() {
                let selectedValue = document.querySelector('input[name="kewarganegaraan"]:checked')?.value;
                if (selectedValue === 'WNA') {
                    wnaDetailField.classList.remove('hidden');
                    kewarganegaraanDetailInput.setAttribute('required', 'required');
                } else {
                    wnaDetailField.classList.add('hidden');
                    kewarganegaraanDetailInput.removeAttribute('required');
                    kewarganegaraanDetailInput.value = ''; // Clear value when hidden
                }
            }

            // Add event listeners to all kewarganegaraan radio buttons
            kewarganegaraanRadios.forEach(radio => {
                radio.addEventListener('change', toggleWnaDetailField);
            });

            // Initial check on page load (for old values after validation failure)
            toggleWnaDetailField();
            // --- AKHIR JavaScript for Kewarganegaraan conditional field ---
        });
    </script>
</body>
</html>

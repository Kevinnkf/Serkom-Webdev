<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\Mahasiswa;
use App\Models\Province; // <--- TAMBAHKAN INI
use App\Models\City;     // <--- TAMBAHKAN INI
use App\Models\District; // <--- TAMBAHKAN INI (Ganti dari 'Region' jika sebelumnya ada)
use App\Models\Districts;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan ini diimpor jika belum
use Illuminate\Validation\ValidationException; // Pastikan ini diimpor jika belum
use Carbon\Carbon; // Pastikan ini diimpor jika Anda menggunakan format tanggal

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::paginate(5);
        return view('home', ['mahasiswas' => $mahasiswas]);
    }

    public function indexRegistration()
    {
        // <--- UBAH INI: Kirim daftar provinsi ke view pendaftaran
        $provinces = Province::orderBy('name')->get();
        $agamas = Agama::orderBy('id')->get();
        return view('registrationMahasiswa', compact('provinces', 'agamas'));
    }

    public function store(Request $request)
    {
        $rules = [
            'namaLengkap' => 'required|string|max:255',
            'alamat' => 'required|string',
            'domisili' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'nomorTelepon' => 'nullable|string|max:20',
            'nomorHP' => 'required|string|max:20',
            'email' => 'required|email|unique:mahasiswas,email',
            'kewarganegaraan' => 'required|string',
            'kewarganegaraan_detail' => 'nullable|string|max:255',
            'tanggalLahir' => 'required|date',
            'tempatLahir' => 'required|string|max:255',
            'provinsiLahir' => 'required|string|max:255',
            'kotaLahir' => 'required|string|max:255',
            'jenisKelamin' => 'required|in:Laki-laki,Perempuan',
            'statusMenikah' => 'required|in:Belum Menikah,Menikah,Cerai Hidup,Cerai Mati',
            'agama_id' => 'required|exists:agamas,id'
        ];


        if ($request->input('kewarganegaraan') === 'WNA') {
            $rules['kewarganegaraan_detail'] = 'required|string|max:255';
        }

        $validatedData = $request->validate($rules);

        $finalKewarganegaraan = $validatedData['kewarganegaraan'];
        if ($finalKewarganegaraan === 'WNA' && !empty($validatedData['kewarganegaraan_detail'])) {
            $finalKewarganegaraan = $validatedData['kewarganegaraan_detail'];
        }

        $mahasiswa = new Mahasiswa();

        $mahasiswa->fill($validatedData);

        $mahasiswa->kewarganegaraan = $finalKewarganegaraan;

        $mahasiswa->save();

        return redirect()->route('registration.proof', $mahasiswa->id)->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $provinces = Province::orderBy('name')->get();
        $agamas = Agama::orderBy('id')->get();
        $cities = $mahasiswa->province_id ? City::where('province_id', $mahasiswa->province_id)->orderBy('name')->get() : collect();
        $districts = $mahasiswa->city_id ? Districts::where('city_id', $mahasiswa->city_id)->orderBy('name')->get() : collect();

        return view('editMahasiswa', compact('mahasiswa', 'provinces', 'cities', 'districts', 'agamas'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // 1. Define the base validation rules
        $rules = [
            'namaLengkap' => 'required|string|max:255',
            'alamat' => 'required|string',
            'domisili' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'nomorTelepon' => 'nullable|string|max:20',
            'nomorHP' => 'required|string|max:20',
            'email' => 'required|email|unique:mahasiswas,email,' . $mahasiswa->id,
            'kewarganegaraan' => 'required|string',
            'kewarganegaraan_detail' => 'nullable|string|max:255',
            'tanggalLahir' => 'required|date',
            'tempatLahir' => 'required|string|max:255',
            'provinsiLahir' => 'required|string|max:255',
            'kotaLahir' => 'required|string|max:255',
            'jenisKelamin' => 'required|in:Laki-laki,Perempuan',
            'statusMenikah' => 'required|in:Belum Menikah,Menikah,Cerai Hidup,Cerai Mati',
            'agama_id' => 'required|exists:agamas,id'
        ];

        if ($request->input('kewarganegaraan') === 'WNA') {
            $rules['kewarganegaraan_detail'] = 'required|string|max:255';
        }

        $validatedData = $request->validate($rules);

        $finalKewarganegaraan = $validatedData['kewarganegaraan'];
        if ($finalKewarganegaraan === 'WNA' && !empty($validatedData['kewarganegaraan_detail'])) {
            $finalKewarganegaraan = $validatedData['kewarganegaraan_detail'];
        }

        $mahasiswa->fill($validatedData);

        $mahasiswa->kewarganegaraan = $finalKewarganegaraan;

        $mahasiswa->save();

        return redirect()->route('index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect()->route('index')->with('success', 'Data mahasiswa berhasil dihapus!'); // <--- UBAH INI: Redirect ke 'home'
    }

    public function getCities($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->orderBy('name')->get();
        return response()->json($cities);
    }

    public function getDistricts($cityId)
    {
        $districts = Districts::where('city_id', $cityId)->orderBy('name')->get();
        return response()->json($districts);
    }

    public function showRegistrationProof(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('agama');
        return view('buktiPendaftaran', compact('mahasiswa'));
    }

    public function exportRegistrationProofPdf(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('agama');

        $pdf = Pdf::loadView('buktiPendaftaran', compact('mahasiswa'));

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('bukti_pendaftaran_' . $mahasiswa->namaLengkap . '.pdf');
    }
}

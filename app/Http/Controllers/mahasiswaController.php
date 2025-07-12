<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class mahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('home', ['mahasiswas' => $mahasiswas]);
    }

    public function indexRegistration()
    {
        $mahasiswas = Mahasiswa::all();
        return view('registrationMahasiswa', ['mahasiswas' => $mahasiswas]);
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::create($request->all());
        return redirect()->route('index')->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        // dd($mahasiswa);
        return view('editMahasiswa', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // Validasi data (sangat penting!)
        $validatedData = $request->validate([
            'namaLengkap' => 'required|string|max:255',
            'alamat' => 'required|string',
            'domisili' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'nomorTelepon' => 'nullable|string|max:20',
            'nomorHP' => 'required|string|max:20',
            'email' => 'required|email|unique:mahasiswas,email,' . $mahasiswa->id, // Email unik, kecuali untuk ID ini sendiri
            'kewarganegaraan' => 'required|string|max:255',
            'tanggalLahir' => 'required|date',
            'tempatLahir' => 'required|string|max:255',
            'provinsiLahir' => 'required|string|max:255',
            'kotaLahir' => 'required|string|max:255',
            'jenisKelamin' => 'required|in:Laki-laki,Perempuan',
            'statusMenikah' => 'required|in:Belum Menikah,Menikah,Cerai Hidup,Cerai Mati',
            'agama' => 'required|string|max:255',
        ]);

        $mahasiswa->update($validatedData);

        return redirect()->route('index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return response()->json(['message' => 'Deleted']);
    }
}

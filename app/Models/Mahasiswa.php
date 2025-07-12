<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaLengkap',
        'alamat',
        'domisili',
        'provinsi',
        'kota',
        'kecamatan',
        'nomorTelepon',
        'nomorHP',
        'email',
        'kewarganegaraan',
        'tanggalLahir',
        'tempatLahir',
        'provinsiLahir',
        'kotaLahir',
        'jenisKelamin',
        'statusMenikah',
        'agama',
    ];
}

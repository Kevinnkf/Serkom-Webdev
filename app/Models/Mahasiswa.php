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
        'province_id',
        'city_id',
        'district_id',
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
        'agama_id'
    ];
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(Districts::class);
    }
    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }
}

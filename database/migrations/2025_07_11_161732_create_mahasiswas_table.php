<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('namaLengkap');
            $table->string('alamat');
            $table->string('domisili');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->integer('nomorTelepon');
            $table->integer('nomorHP');
            $table->string('email');
            $table->string('kewarganegaraan');
            $table->date('tanggalLahir');
            $table->string('tempatLahir');
            $table->string('provinsiLahir');
            $table->string('kotaLahir');
            $table->string('jenisKelamin');
            $table->string('statusMenikah');
            $table->string('agama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropTimestamps(); 
        });
    }
};

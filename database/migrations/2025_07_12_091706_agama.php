    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\DB; // Tambahkan baris ini

    return new class extends Migration
    {
        /**
         * Jalankan migrasi.
         */
        public function up(): void
        {
            // Membuat tabel 'agamas'
            Schema::create('agamas', function (Blueprint $table) {
                $table->id(); // Kolom ID otomatis (primary key)
                $table->string('name')->unique(); // Kolom untuk nama agama, harus unik
                $table->timestamps(); // Kolom 'created_at' dan 'updated_at'
            });

            // Mengisi data awal ke tabel 'agamas'
            // Ini akan menambahkan agama-agama yang umum secara otomatis saat migrasi dijalankan
            DB::table('agamas')->insert([
                ['name' => 'Islam', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Kristen', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Katolik', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Hindu', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Buddha', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Konghucu', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Lainnya', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        /**
         * Balikkan migrasi (saat rollback).
         */
        public function down(): void
        {
            // Menghapus tabel 'agamas' jika migrasi di-rollback
            Schema::dropIfExists('agamas');
        }
    };

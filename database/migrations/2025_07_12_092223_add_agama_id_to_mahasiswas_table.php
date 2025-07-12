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
            Schema::table('mahasiswas', function (Blueprint $table) {
                // 1. Tambahkan kolom foreign key baru
                // 'nullable()' agar tidak error jika ada data mahasiswa yang sudah ada
                // 'constrained('agamas')' membuat foreign key ke tabel 'agamas'
                // 'onDelete('set null')' berarti jika agama dihapus, agama_id di mahasiswa menjadi NULL
                $table->foreignId('agama_id')->nullable()->constrained('agamas')->onDelete('set null')->after('agama');
            });

            // 2. Migrasikan data dari kolom 'agama' (string) ke 'agama_id' (foreign key)
            // Penting: Gunakan double quotes untuk nama kolom di PostgreSQL jika nama kolom aslinya mixed-case
            DB::statement("UPDATE mahasiswas SET agama_id = (SELECT id FROM agamas WHERE name = mahasiswas.\"agama\" LIMIT 1);");

            Schema::table('mahasiswas', function (Blueprint $table) {
                // 3. Hapus kolom 'agama' yang lama setelah data dimigrasikan
                $table->dropColumn('agama');
            });
        }

        /**
         * Balikkan migrasi (saat rollback).
         */
        public function down(): void
        {
            Schema::table('mahasiswas', function (Blueprint $table) {
                // 1. Tambahkan kembali kolom 'agama' yang lama (string)
                $table->string('agama')->nullable()->after('agama_id');

                // 2. Migrasikan data dari 'agama_id' kembali ke 'agama' (string)
                // Penting: Gunakan double quotes untuk nama kolom di PostgreSQL jika nama kolom aslinya mixed-case
                DB::statement("UPDATE mahasiswas SET \"agama\" = (SELECT name FROM agamas WHERE id = mahasiswas.agama_id LIMIT 1);");

                // 3. Hapus foreign key dan kolom 'agama_id'
                $table->dropConstrainedForeignId('agama_id');
            });
        }
    };

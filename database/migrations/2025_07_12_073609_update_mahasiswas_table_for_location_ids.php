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
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->foreignId('province_id')->nullable()->constrained('provinces')->onDelete('set null')->after('domisili');
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('set null')->after('province_id');
            $table->foreignId('district_id')->nullable()->constrained('districts')->onDelete('set null')->after('city_id');

            $table->dropColumn(['provinsi', 'kota', 'kecamatan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kecamatan')->nullable();

            $table->dropConstrainedForeignId('province_id');
            $table->dropConstrainedForeignId('city_id');
            $table->dropConstrainedForeignId('district_id');
        });
    }
};

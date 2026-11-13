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
        Schema::create('ruang_kelas', function (Blueprint $table) {
            $table->id(); // Big integer Primary key
            $table->string('kode_ruang', 20)->unique(); // Wajib diisi, unik, maksimal 20 karakter
            $table->string('nama_ruang', 100); // Wajib diisi, maksimal 100 karakter
            $table->string('gedung', 100); // Wajib diisi, maksimal 100 karakter
            $table->integer('kapasitas'); // Integer, wajib diisi
            $table->string('jenis_ruang'); // Teori, Laboratorium, atau Seminar
            $table->boolean('status')->default(true); // true = Tersedia, false = Tidak Tersedia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruang_kelas');
    }
};

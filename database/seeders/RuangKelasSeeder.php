<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RuangKelas;
use Carbon\Carbon;

class RuangKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $jenisOptions = ['Teori', 'Laboratorium', 'Seminar'];
        $gedungOptions = ['Gedung A', 'Gedung B', 'Gedung C', 'Gedung D'];

        // Looping untuk membuat 20 data dummy
        for ($i = 1; $i <= 20; $i++) {
            $gedung = $gedungOptions[array_rand($gedungOptions)];
            $jenis = $jenisOptions[array_rand($jenisOptions)];
            
            // Bikin kode ruang unik, contoh: A-001, B-002
            $kode = substr($gedung, -1) . '-' . str_pad($i, 3, '0', STR_PAD_LEFT);

            // Bikin nama dan kapasitas yang logis berdasarkan jenis ruangannya
            if ($jenis == 'Laboratorium') {
                $nama = "Lab Komputer " . $i;
                $kapasitas = rand(20, 35); // Kapasitas lab biasanya lebih kecil
            } elseif ($jenis == 'Seminar') {
                $nama = "Ruang Seminar " . $i;
                $kapasitas = rand(60, 100); // Ruang seminar biasanya besar
            } else {
                $nama = "Ruang Kelas " . $i;
                $kapasitas = rand(30, 50); // Ruang teori standar
            }

            $data[] = [
                'kode_ruang' => $kode,
                'nama_ruang' => $nama,
                'gedung' => $gedung,
                'kapasitas' => $kapasitas,
                'jenis_ruang' => $jenis,
                // Status dibikin acak, probabilitas 80% ruangannya tersedia (1)
                'status' => rand(1, 10) <= 8 ? 1 : 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // Insert 20 data tersebut sekaligus ke tabel ruang_kelas
        RuangKelas::insert($data);
    }
}
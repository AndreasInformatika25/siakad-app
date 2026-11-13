<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        // Daftar 20 nama mata kuliah khas anak IT
        $listMataKuliah = [
            'Algoritma dan Pemrograman', 
            'Struktur Data', 
            'Basis Data', 
            'Sistem Operasi',
            'Kecerdasan Buatan', 
            'Jaringan Komputer', 
            'Rekayasa Perangkat Lunak', 
            'Pemrograman Web',
            'Pemrograman Mobile', 
            'Matematika Diskrit', 
            'Aljabar Linear', 
            'Kalkulus',
            'Sistem Informasi Manajemen', 
            'Data Mining', 
            'Machine Learning', 
            'Keamanan Siber',
            'Interaksi Manusia dan Komputer', 
            'Pengolahan Citra Digital', 
            'Etika Profesi IT', 
            'Metodologi Penelitian'
        ];

        $data = [];
        
        foreach ($listMataKuliah as $index => $namaMK) {
            // Bikin kode urut, misal: TI001, TI002
            $kodeUrut = str_pad($index + 1, 3, '0', STR_PAD_LEFT);
            
            $data[] = [
                'kode' => 'TI' . $kodeUrut,
                'nama' => $namaMK,
                'sks' => rand(2, 4), // SKS diacak antara 2 sampai 4
                'dosen_id' => rand(1, 10), // Asumsi mengambil ID dosen dari 1 sampai 10 (dari seeder dosen lu)
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Insert data ke tabel mata_kuliah
        DB::table('mata_kuliah')->insert($data);
    }
}
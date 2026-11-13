<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TahunAkademik;
use Carbon\Carbon;

class TahunAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startYear = 2000;
        $data = [];

        // Looping 25 kali untuk menghasilkan 50 record (Ganjil & Genap)
        for ($i = 0; $i < 25; $i++) {
            $year1 = $startYear + $i;
            $year2 = $year1 + 1;
            $tahunLabel = "{$year1}/{$year2}";

            // Data Semester Ganjil
            $data[] = [
                'tahun' => $tahunLabel,
                'semester' => 'Ganjil',
                'tanggal_mulai' => "{$year1}-09-01",
                'tanggal_selesai' => "{$year2}-02-28", // Februari tahun berikutnya
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            // Data Semester Genap
            $data[] = [
                'tahun' => $tahunLabel,
                'semester' => 'Genap',
                'tanggal_mulai' => "{$year2}-03-01",
                'tanggal_selesai' => "{$year2}-08-31",
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // Set record paling terakhir (terbaru) menjadi Aktif (1)
        $data[count($data) - 1]['status'] = 1;

        // Insert semua data sekaligus menggunakan Eloquent
        TahunAkademik::insert($data);
    }
}
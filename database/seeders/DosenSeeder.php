<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        $data = [
            [
                'nidn' => '0412038501', 
                'nama' => 'Dr. Budi Santoso, S.Kom., M.Kom.', 
                'prodi' => 'Teknik Informatika'
            ],
            [
                'nidn' => '0422058802', 
                'nama' => 'Siti Aminah, S.T., M.T.', 
                'prodi' => 'Sistem Informasi'
            ],
            [
                'nidn' => '0415087503', 
                'nama' => 'Prof. Dr. Andi Wijaya', 
                'prodi' => 'Teknik Komputer'
            ],
            [
                'nidn' => '0408119004', 
                'nama' => 'Rina Melati, M.Eng.', 
                'prodi' => 'Sistem Informasi'
            ],
            [
                'nidn' => '0430018205', 
                'nama' => 'Ahmad Fauzi, S.Kom., M.Cs.', 
                'prodi' => 'Teknik Informatika'
            ],
            [
                'nidn' => '0417098606', 
                'nama' => 'Dr. Eka Pratama, M.T.', 
                'prodi' => 'Teknik Elektro'
            ],
            [
                'nidn' => '0425048907', 
                'nama' => 'Dwi Kusuma, S.Kom., M.Kom.', 
                'prodi' => 'Sistem Informasi'
            ],
            [
                'nidn' => '0411128108', 
                'nama' => 'Tri Nugroho, M.IT.', 
                'prodi' => 'Teknik Informatika'
            ],
            [
                'nidn' => '0405069209', 
                'nama' => 'Fitriani, S.T., M.Sc.', 
                'prodi' => 'Ilmu Komputer'
            ],
            [
                'nidn' => '0418027910', 
                'nama' => 'Dr. Hendra Saputra', 
                'prodi' => 'Teknik Komputer'
            ],
        ];

        // Tambahkan timestamp ke setiap data biar otomatis keisi
        foreach ($data as &$row) {
            $row['created_at'] = $now;
            $row['updated_at'] = $now;
        }

        // Insert data ke tabel dosen
        DB::table('dosen')->insert($data);
    }
}
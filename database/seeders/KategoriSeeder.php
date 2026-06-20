<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $sektors = ['IT', 'F&B', 'Manufaktur', 'Kesehatan', 'Pendidikan'];
        $kebutuhans = [
            'Pengembangan Website / Web App',
            'Pengembangan Aplikasi Mobile',
            'Desain UI/UX & Branding',
            'Konsultasi IT & Sistem Bisnis',
            'Digital Marketing',
        ];

        foreach ($sektors as $s) {
            Kategori::firstOrCreate(['tipe' => 'sektor', 'nama' => $s]);
        }

        foreach ($kebutuhans as $k) {
            Kategori::firstOrCreate(['tipe' => 'kebutuhan', 'nama' => $k]);
        }
    }
}

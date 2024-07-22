<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kantor;

class KantorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data pertama
        Kantor::create([
            'nama_kantor' => 'Dinas Pendidikan Kota Banjarmasin',
            'alamat' => 'Jl. Kapten Piere Tendean No.29, RT.40, Gadang, Kec. Banjarmasin Tengah, Kota Banjarmasin, Kalimantan Selatan 70231',
            'kota' => 'Banjarmasin',
            'telepon' => '(0511) 3253373'
        ]);

        // Menambahkan data kedua
        Kantor::create([
            'nama_kantor' => 'Kantor Sekolah',
            'alamat' => 'Jl. Banjarmasin',
            'kota' => 'Banjarmasin',
            'telepon' => '(0511) 3253373'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jenis;

class JenisSeeder extends Seeder
{
    public function run()
    {
        $jenisList = ['SD', 'SMP', 'SMA'];

        foreach ($jenisList as $jenis) {
            Jenis::create(['name' => $jenis]);
        }
    }
}


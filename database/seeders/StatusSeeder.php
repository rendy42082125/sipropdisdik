<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['Terverifikasi', 'Belum Terverifikasi'];

        foreach ($statuses as $status) {
            Status::create(['name' => $status]);
        }
    }
}


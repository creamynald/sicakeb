<?php

namespace Database\Seeders\data;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\opd;

class opdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        opd::insert([
            [
                'nama' => 'Diskominfotik Kab. Bengkalis',
                'singkatan' => 'Diskominfotik'
            ],
            [
                'nama' => 'Dinas Perikanan dan Perindustrian Kab. Bengkalis',
                'singkatan' => 'Disperindag'
            ],
        ]);
    }
}

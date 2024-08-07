<?php

namespace Database\Seeders\data;

use App\Models\Dokumen\dokRenaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class dokRenaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        dokRenaksi::insert([
            [
                'opd_id' => 1,
                'urutan' => '1',
                'link' => 'https://www.google.com',
                'tahun' => '2024',
            ],
            [
                'opd_id' => 2,
                'urutan' => '2',
                'link' => 'https://www.google.com',
                'tahun' => '2024',
            ],
            [
                'opd_id' => 1,
                'urutan' => '3',
                'link' => 'https://www.google.com',
                'tahun' => '2024',
            ],
        ]);
    }
}

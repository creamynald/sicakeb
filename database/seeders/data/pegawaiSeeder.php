<?php

namespace Database\Seeders\data;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Opd\Pegawai;

class pegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pegawai::insert([
                [
                    'opd_id' => '1', //diskominfotik
                    'nama' => 'Agus Salim',
                    'nip' => '192.168.100.1',
                    'jabatan' => 'Kepala Dinas',
                    'golongan' => 'IV/c',
                    'eselon' => 'IV'
                ],
                [
                    'opd_id' => '2', //disperindag
                    'nama' => 'Heri Maulana',
                    'nip' => '192.168.100.2',
                    'jabatan' => 'Sekretaris',
                    'golongan' => 'IV/a',
                    'eselon' => 'IV'
                ],
            ]);
    }
}

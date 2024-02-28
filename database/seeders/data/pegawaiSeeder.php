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
                    'nama' => 'Dr. Suwarto, S.Pd, M.Pd',
                    'nip' => '19690909 198908 1 001',
                    'jabatan' => 'Kepala Dinas',
                    'golongan' => 'IV/b',
                    'eselon' => 'II'
                ],
                [
                    'opd_id' => '2', //disperindag
                    'nama' => 'Zulpan, ST',
                    'nip' => '19730402 2000312 1 002',
                    'jabatan' => 'Kepala Dinas',
                    'golongan' => 'III/d',
                    'eselon' => 'III'
                ],
            ]);
    }
}

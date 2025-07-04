<?php

namespace Database\Seeders;

use App\Models\data_warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataWargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        data_warga::create([
            'nomor_induk_PSHT_lampung' => '23016000001',
            'nomor_induk_warga' => '202009050647',
            'nik' => '1801142905060001',
            'name' => 'AHMAD NUR KHOLIS',
            'gender' => 'Laki-Laki',
            'tempat_lahir' => 'Lampung Timur ',
            'tanggal_lahir' => '2003-11-23',
            'agama' => 'islam',
            'tahun_pengesahan' => '2020',
            'ranting' => 'Rajabasa',
            'cabang' => 'BANDAR LAMPUNG',
            'alamat_saat_ini' => 'Labuhan dalam ',
            'no_hp' => '081367341408',
            'ktw' => 'Ada',
            'alasan_tidak_ada_ktw' => null,
            'penanda_tangan_ktw' => 'Drs. R. Murjoko HW',
            'ketua_umum' => 'R. Murjoko HW',
            'profile' => 'image',
            'image' => 'KTW',
            'pekerjaan' => null,
            'keterangan' => null,
            'email' => 'nurkholisahmad971@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}

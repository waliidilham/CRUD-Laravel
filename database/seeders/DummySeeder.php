<?php

namespace Database\Seeders;

use App\Models\data_warga; // Pastikan nama model sudah benar
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker; // Import Faker

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inisialisasi Faker untuk data Indonesia
        $faker = Faker::create('id_ID');

        // Siapkan array kosong untuk menampung semua data
        $wargaData = [];

        for ($i = 1; $i <= 497; $i++) {
            // str_pad untuk memastikan panjang nomor selalu konsisten
            // Contoh: $i=1 -> 001, $i=10 -> 010, $i=100 -> 100
            $paddedIndex = str_pad($i, 3, '0', STR_PAD_LEFT);

            $wargaData[] = [ // Tambahkan data ke array, jangan langsung create()
                'nomor_induk_PSHT_lampung' => '23016000' . $paddedIndex,
                'nomor_induk_warga'      => '202009050' . $paddedIndex,
                'nik'                      => $faker->unique()->nik(), // NIK unik & valid dari Faker
                'name'                     => $faker->name(), // Nama acak dari Faker
                'gender'                   => $faker->randomElement(['Laki-Laki', 'Perempuan']), // Gender acak
                'tempat_lahir'             => $faker->city(), // Kota acak
                'tanggal_lahir'            => $faker->dateTimeBetween('-40 years', '-18 years')->format('Y-m-d'), // Tgl lahir acak
                'agama'                    => 'islam',
                'tahun_pengesahan'         => '2020',
                'ranting'                  => 'Rajabasa',
                'cabang'                   => 'BANDAR LAMPUNG',
                'alamat_saat_ini'          => $faker->address(), // Alamat acak
                'no_hp'                    => $faker->unique()->phoneNumber(), // No. HP unik & acak
                'ktw'                      => 'Ada',
                'alasan_tidak_ada_ktw'     => null,
                'penanda_tangan_ktw'       => 'Drs. R. Murjoko HW',
                'ketua_umum'               => 'R. Murjoko HW',
                'profile'                  => 'image',
                'image'                    => 'KTW',
                'pekerjaan'                => $faker->jobTitle(), // Pekerjaan acak
                'keterangan'               => null,
                'email'                    => $faker->unique()->safeEmail(), // Email unik & acak
                'password'                 => Hash::make('123456'),
                'created_at'               => now(), // Tambahkan timestamp
                'updated_at'               => now(),
            ];
        }

        // Jalankan satu query untuk memasukkan semua data sekaligus
        data_warga::insert($wargaData);
    }
}

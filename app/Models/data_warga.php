<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class data_warga extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model.
     *
     * @var string
     */
    protected $table = 'data_wargas';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_induk_PSHT_lampung',
        'nomor_induk_warga',
        'nik',
        'name',
        'gender',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'tahun_pengesahan',
        'ranting',
        'cabang',
        'alamat_saat_ini',
        'no_hp',
        'ktw',
        'alasan_tidak_ada_ktw',
        'penanda_tangan_ktw',
        'ketua_umum',
        'profile',
        'image',
        'pekerjaan',
        'keterangan',
        'email',
        'password',
    ];

    /**
     * Atribut yang harus disembunyikan saat serialisasi.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Atribut yang harus di-cast ke tipe data asli.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'tanggal_lahir' => 'date',
        // 'password' => 'hashed', // Gunakan ini di Laravel 10+ jika password selalu di-hash
    ];
}

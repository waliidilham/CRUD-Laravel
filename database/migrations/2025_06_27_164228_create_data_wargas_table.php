<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_wargas', function (Blueprint $table) {
            $table->id();
            // Ganti varchar dengan string untuk VARCHAR, dan tentukan panjangnya
            $table->string('nomor_induk_PSHT_lampung', 12)->unique();
            $table->string('nomor_induk_warga', 12)->unique();
            $table->string('nik', 16)->unique();
            $table->string('name');
            $table->string('gender');
            $table->string('tempat_lahir');
            // Untuk tanggal dan waktu, gunakan date atau datetime. Timestamp umumnya untuk created_at/updated_at.
            // Jika hanya tanggal, gunakan date(). Jika tanggal dan waktu, gunakan dateTime().
            $table->date('tanggal_lahir'); // Menggunakan date() jika hanya menyimpan tanggal
            $table->string('agama');
            $table->string('tahun_pengesahan', 4); // Ganti varchar dengan string
            $table->string('ranting');
            $table->string('cabang');
            $table->string('alamat_saat_ini');
            // Untuk nomor HP, string lebih fleksibel daripada varchar dengan panjang default
            // Jika Anda ingin membatasi panjang, gunakan string('kolom', panjang)
            $table->string('no_hp')->nullable(); // Menambahkan nullable karena no_hp bisa saja kosong
            $table->string('ktw')->nullable(); // Mungkin bisa null jika tidak ada KTW
            $table->string('alasan_tidak_ada_ktw')->nullable(); // Ini jelas bisa null
            $table->string('penanda_tangan_ktw')->nullable(); // Mungkin bisa null
            $table->string('ketua_umum')->nullable(); // Mungkin bisa null
            $table->string('profile', 255)->nullable();
            $table->string('image', 255)->nullable(); // Menambahkan nullable karena gambar mungkin opsional
            $table->string('pekerjaan')->nullable(); // Mungkin bisa null
            $table->string('keterangan')->nullable(); // Mungkin bisa null
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_wargas');
    }
};

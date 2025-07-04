@extends('layout.main')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Data Warga</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tambah Data</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      {{-- Tambahkan enctype untuk upload file --}}
      <form action="{{ route('admin.user.store_data_warga') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          {{-- Kolom Kiri --}}
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Pribadi</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Nama Lengkap</label>
                  <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan nama lengkap"
                    value="{{ old('name') }}">
                  @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                  <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                  <input type="text" name="nik" class="form-control" id="nik" placeholder="Masukkan NIK"
                    value="{{ old('nik') }}">
                  @error('nik')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                  <label for="gender">Jenis Kelamin</label>
                  <select name="gender" class="form-control" id="gender">
                    <option value="Laki-laki" {{ old('gender')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('gender')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                  </select>
                  @error('gender')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tempat_lahir">Tempat Lahir</label>
                      <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                        placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}">
                      @error('tempat_lahir')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tanggal_lahir">Tanggal Lahir</label>
                      <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                        value="{{ old('tanggal_lahir') }}">
                      @error('tanggal_lahir')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="agama">Agama</label>
                  <input type="text" name="agama" class="form-control" id="agama" placeholder="Masukkan agama"
                    value="{{ old('agama') }}">
                  @error('agama')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                  <label for="alamat_saat_ini">Alamat Saat Ini</label>
                  <textarea name="alamat_saat_ini" class="form-control" id="alamat_saat_ini" rows="3"
                    placeholder="Masukkan alamat lengkap">{{ old('alamat_saat_ini') }}</textarea>
                  @error('alamat_saat_ini')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                  <label for="pekerjaan">Pekerjaan</label>
                  <input type="text" name="pekerjaan" class="form-control" id="pekerjaan"
                    placeholder="Masukkan pekerjaan" value="{{ old('pekerjaan') }}">
                  @error('pekerjaan')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                  <label for="profile">Foto Profil</label>
                  <input type="file" name="profile" class="form-control" id="profile">
                  @error('profile')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
              </div>
            </div>
          </div>

          {{-- Kolom Kanan --}}
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Keanggotaan & Akun</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="nomor_induk_PSHT_lampung">Nomor Induk Warga PSHT Lampung</label>
                  <input type="text" name="nomor_induk_PSHT_lampung" class="form-control" id="nomor_induk_PSHT_lampung"
                    placeholder="Masukkan NIW" value="{{ old('nomor_induk_PSHT_lampung') }}">
                  @error('nomor_induk_PSHT_lampung')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                  <label for="nomor_induk_warga">Nomor Induk Warga (Pusat)</label>
                  <input type="text" name="nomor_induk_warga" class="form-control" id="nomor_induk_warga"
                    placeholder="Masukkan NIW Pusat" value="{{ old('nomor_induk_warga') }}">
                  @error('nomor_induk_warga')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                  <label for="tahun_pengesahan">Tahun Pengesahan</label>
                  <input type="text" name="tahun_pengesahan" class="form-control" id="tahun_pengesahan"
                    placeholder="Contoh: 2022" value="{{ old('tahun_pengesahan') }}">
                  @error('tahun_pengesahan')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ranting">Ranting</label>
                      <input type="text" name="ranting" class="form-control" id="ranting" placeholder="Asal ranting"
                        value="{{ old('ranting') }}">
                      @error('ranting')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cabang">Cabang</label>
                      <input type="text" name="cabang" class="form-control" id="cabang" placeholder="Asal cabang"
                        value="{{ old('cabang') }}">
                      @error('cabang')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                  </div>
                </div>

                {{-- =================================== --}}
                {{-- INPUTAN BARU MULAI --}}
                {{-- =================================== --}}

                <div class="form-group">
                  <label for="ktw">Apakah Anda memiliki KTW?</label>
                  <select name="ktw" class="form-control" id="ktw">
                    <option value="Ada" {{ old('ktw')=='Ada' ? 'selected' : '' }}>Ada</option>
                    <option value="Tidak Ada" {{ old('ktw')=='Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                  </select>
                  @error('ktw')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group" id="alasan-container" style="display: none;">
                  <label for="alasan_tidak_ada_ktw">Alasan Tidak Memiliki KTW</label>
                  <textarea name="alasan_tidak_ada_ktw" class="form-control" id="alasan_tidak_ada_ktw" rows="2"
                    placeholder="Sebutkan alasannya">{{ old('alasan_tidak_ada_ktw') }}</textarea>
                  @error('alasan_tidak_ada_ktw')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                  <label for="penanda_tangan_ktw">Penanda Tangan KTW</label>
                  <input type="text" name="penanda_tangan_ktw" class="form-control" id="penanda_tangan_ktw"
                    placeholder="Contoh: Ketua Cabang Metro" value="{{ old('penanda_tangan_ktw') }}">
                  @error('penanda_tangan_ktw')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                  <label for="ketua_umum">Ketua Umum</label>
                  <input type="text" name="ketua_umum" class="form-control" id="ketua_umum"
                    placeholder="Nama Ketua Umum Pusat" value="{{ old('ketua_umum') }}">
                  @error('ketua_umum')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                {{-- =================================== --}}
                {{-- INPUTAN BARU SELESAI --}}
                {{-- =================================== --}}

                <div class="form-group">
                  <label for="no_hp">Nomor HP</label>
                  <input type="tel" name="no_hp" class="form-control" id="no_hp" placeholder="Masukkan nomor HP aktif"
                    value="{{ old('no_hp') }}">
                  @error('no_hp')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email"
                    value="{{ old('email') }}">
                  @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" id="password"
                    placeholder="Masukkan password">
                  @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                  <label for="image">Upload Scan/Foto KTW</label>
                  <input type="file" name="image" class="form-control" id="image">
                  @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="{{ route('admin.data_warga') }}" class="btn btn-default">Batal</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>
@endsection
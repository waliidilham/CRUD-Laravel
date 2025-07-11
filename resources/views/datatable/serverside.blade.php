@extends('layout.main')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />

@endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Warga</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Warga (Server Side)</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  {{-- Letakkan ini di atas tabel data warga Anda --}}



  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-12">
          <a href="{{ route('admin.user.create_data_warga') }}" class="btn btn-primary mb-3">Tambah Data</a>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Responsive Hover Table</h3>


            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap" id="serverside">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Induk PSHT Lampung</th>
                    <th>Nomor Induk Warga</th>
                    <th>Nomor Induk Kependudukan</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Agama</th>
                    <th>Tahun Pengesahan</th>
                    <th>Ranting</th>
                    <th>Cabang</th>
                    <th>Alamat Saat Ini</th>
                    <th>No HP</th>
                    <th>Kartu Tanda Warga</th>
                    <th>Alasan Tidak Memiliki KTW</th>
                    <th>Penanda Tangan KTW</th>
                    <th>Ketua Umum</th>
                    <th>Profile Image</th>
                    <th>KTW Image</th>
                    <th>Pekerjaan</th>
                    <th>Keterangan</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>



            </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script>
  $(document).ready( function () {
   loadData();
} );

function loadData() {
   $('#serverside').DataTable({
    processing:true,
    pagination:true,
    responsive:false,
    serverSide:true,
    searching:true,
    ordering:false,
    ajax:{
      url:"{{ route('admin.serverside') }}",
    },
    columnsL[
      {
        data: 'no',
        name : 'no',
      },
      {
        data: 'nomor_induk_PSHT_lampung',
        name : 'nomor_induk_PSHT_lampung',
      },
      {
        data: 'nomor_induk_warga',
        name : 'nomor_induk_warga',
      }
      {
        data: 'nik',
        name : 'nik',
      },
      {
        data: 'name',
        name : 'name',
      },
      {
        data: 'gender',
        name : 'gender',
      },
      {
        data: 'tempat_lahir',
        name : 'tanggal_lahir',
      },
      {
        data: 'agama',
        name : 'agama',
      },
      {
        data: 'tahun_pengesahan',
        name : 'tahun_pengesahan',
      },
      {
        data: 'ranting',
        name : 'ranting',
      },
      {
        data: 'cabang',
        name : 'cabang',
      },
      {
        data: 'alamat_saat_ini',
        name : 'alamat_saat_ini',
      },
      {
        data: 'no_hp',
        name : 'no_hp',
      },
      {
        data: 'ktw',
        name : 'ktw',
      },
      {
        data: 'alasan_tidak_ada_ktw',
        name : 'alasan_tidak_ada_ktw',
      },
      {
        data: 'penanda_tangan_ktw',
        name : 'penanda_tangan_ktw',
      },
      {
        data: 'ketua_umum',
        name : 'ketua_umum',
      },
      {
        data: 'profile',
        name : 'profile',
      },
      {
        data: 'image',
        name : 'image',
      },
      {
        data: 'pekerjaan',
        name : 'pekerjaan',
      },
      {
        data: 'keterangan',
        name : 'keterangan',
      },
      {
        data: 'email',
        name : 'email',
      },
      {
        data: 'action',
        name : 'action',
      },

    ],
   });
}
</script>

@endsection
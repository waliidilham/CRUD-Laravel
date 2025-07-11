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
            <li class="breadcrumb-item active">Data Warga (Client Side)</li>
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
              <table class="table table-hover text-nowrap" id="clientside">
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
                  @forelse ($data as $index => $warga)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $warga->nomor_induk_PSHT_lampung }}</td>
                    <td>{{ $warga->nomor_induk_warga }}</td>
                    <td>{{ $warga->nik }}</td>
                    <td>{{ $warga->name }}</td>
                    <td>{{ $warga->gender }}</td>
                    <td>{{ $warga->tempat_lahir }}</td>
                    <td>{{ $warga->tanggal_lahir }}</td>
                    <td>{{ $warga->agama }}</td>
                    <td>{{ $warga->tahun_pengesahan }}</td>
                    <td>{{ $warga->ranting }}</td>
                    <td>{{ $warga->cabang }}</td>
                    <td>{{ $warga->alamat_saat_ini }}</td>
                    <td>{{ $warga->no_hp }}</td>
                    <td>{{ $warga->ktw }}</td>
                    <td>{{ $warga->alasan_tidak_ada_ktw }}</td>
                    <td>{{ $warga->penanda_tangan_ktw }}</td>
                    <td>{{ $warga->ketua_umum }}</td>
                    <td>{{ $warga->profile }}</td>
                    <td>{{ $warga->image }}</td>
                    <td>{{ $warga->pekerjaan }}</td>
                    <td>{{ $warga->keterangan }}</td>
                    <td>{{ $warga->email }}</td>



                    <td>
                      <a href="{{ route('admin.user.edit_data_warga', ['id'=>$warga->id]) }}" class="btn btn-primary"><i
                          class="fas fa-pen"></i>Edit</a>
                      <a href="" class="btn btn-danger" data-toggle="modal"
                        data-target="#modal-hapus{{ $warga->id }}"><i class="fas fa-trash-alt"></i>Hapus</a>
                    </td>
                  </tr>
                  <div class="modal fade" id="modal-hapus{{ $warga->id }}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Apakah Anda yakin untuk menghapus Data User <b>{{ $warga->name }}</b></p>
                        </div>
                        <div class="modal-footer ">
                          <form action="{{ route('admin.user.delete_data_warga', ['id'=>$warga->id]) }}" method="POST">
                            <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                          </form>

                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                  </tr>
                  @endforelse
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
    $('#clientside').DataTable();
} );
</script>

@endsection
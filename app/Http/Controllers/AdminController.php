<?php

namespace App\Http\Controllers;

use App\Models\data_warga;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Str;

use function Laravel\Prompts\search;

class AdminController extends Controller
{
    public function dashboard()
    {

        return view('dashboard');
    }

    public function index(Request $request)
    {

        $data = new User;
        if ($request->get('search')) {
            $data = $data->where('name', 'LIKE', '%' . $request->get('search') . '%')
                ->orWhere('email', 'LIKE', '%' . $request->get('search') . '%');
        }

        $data = $data->get();
        return view('index', compact('data', 'request'));
    }
    public function create()
    {

        return view('create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['name'] = $request->nama;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('admin.index');
    }

    public function edit(Request $request, $id)
    {
        $data = User::find($id);

        // dd($data);
        return view('edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all()); // untuk melihar  reques data apakah sudah masuk atau belum
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required',
            'email' => 'nullable',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['name'] = $request->nama;
        $data['email'] = $request->email;
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($data);

        return redirect()->route('admin.index');
    }

    public function delete(Request $request, $id)
    {
        $data = User::find($id);
        if ($data) {
            $data->delete();
        }
        return redirect()->route('admin.index');
    }

    public function data_warga(Request $request)
    {
        // 1. Mulai dengan query dasar ke model data_warga
        $query = data_warga::query();

        // 2. Cek apakah ada input pencarian dari request
        if ($request->filled('search')) {
            $search = $request->input('search');

            // 3. Terapkan filter pencarian ke query
            // Mencari di beberapa kolom sekaligus (name, nik, nomor_induk_warga, dll.)
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('nomor_induk_warga', 'like', "%{$search}%")
                    ->orWhere('nomor_induk_PSHT_lampung', 'like', "%{$search}%")
                    ->orWhere('ranting', 'like', "%{$search}%")
                    ->orWhere('cabang', 'like', "%{$search}%");
            });
        }

        // 4. Ambil data dengan paginasi dan teruskan parameter pencarian
        // Menggunakan latest() untuk mengurutkan dari yang terbaru
        $data_warga = $query->latest()->paginate(10)->withQueryString();

        return view('data_warga', compact('data_warga'));
    }
    public function create_data_warga()
    {

        return view('create_data_warga');
    }

    public function store_data_warga(Request $request)
    {
        // Mendefinisikan aturan validasi
        $rules = [
            'nomor_induk_PSHT_lampung' => 'required|string|max:12|unique:data_wargas',
            'nomor_induk_warga' => 'required|string|max:12|unique:data_wargas',
            'nik' => 'required|string|max:16|unique:data_wargas',
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:255',
            'tahun_pengesahan' => 'required|string|max:4',
            'ranting' => 'required|string|max:255',
            'cabang' => 'required|string|max:255',
            'alamat_saat_ini' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'ktw' => 'nullable|string|max:20',
            'Alasan_tidak_ada_ktww' => 'nullable|string|max:20',
            'penandatangan_ktw' => 'nullable|string|max:20',
            'ketua_umum' => 'nullable|string|max:20',
            'profile' => 'nullable|file|image|max:2048', // Foto profil
            'image' => 'nullable|file|image|max:2048',   // Foto KTW
            'pekerjaan' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:data_wargas',
            'password' => 'nullable|string|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = $request->except(['_token', 'password', 'profile', 'image']);

        // ==========================================================
        // PERUBAHAN LOGIKA UPLOAD FILE DENGAN TIMESTAMP
        // ==========================================================

        $namaDasarFile = Str::slug($request->name, '_');
        $waktuUpload = time(); // Mendapatkan Unix timestamp saat ini

        // Logika untuk file 'profile'
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            // Membuat nama file baru: nama_warga_timestamp.jpg
            $nama_file = $namaDasarFile . '_' . $waktuUpload . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profile'), $nama_file);
            $data['profile'] = 'profile/' . $nama_file;
        }

        // Logika untuk file 'image' (KTW)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // Membuat nama file baru: kartu_tanda_warga_nama_warga_timestamp.jpg
            $nama_file = 'kartu_tanda_warga_' . $namaDasarFile . '_' . $waktuUpload . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image'), $nama_file);
            $data['image'] = 'image/' . $nama_file;
        }

        // ==========================================================

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        data_warga::create($data);

        return redirect()->route('admin.data_warga')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit_data_warga(Request $request, $id)
    {
        $data = data_warga::find($id);

        // dd($data);
        return view('edit_data_warga', compact('data'));
    }

    public function update_data_warga(Request $request, $id)
    {
        // 1. Mencari data yang akan diupdate
        $dataWarga = data_warga::findOrFail($id);

        // 2. Perbaikan Aturan Validasi untuk proses UPDATE
        // Aturan 'unique' harus diubah agar mengabaikan data yang sedang diedit
        $rules = [
            // Contoh: unique:nama_tabel,nama_kolom,ID_yang_diabaikan
            'nomor_induk_PSHT_lampung' => 'required|string|max:12|unique:data_wargas,nomor_induk_PSHT_lampung,' . $id,
            'nomor_induk_warga' => 'required|string|max:12|unique:data_wargas,nomor_induk_warga,' . $id,
            'nik' => 'required|string|max:16|unique:data_wargas,nik,' . $id,
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:255',
            'tahun_pengesahan' => 'required|string|max:4',
            'ranting' => 'required|string|max:255',
            'cabang' => 'required|string|max:255',
            'alamat_saat_ini' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'ktw' => 'nullable|string|max:20',
            'Alasan_tidak_ada_ktww' => 'nullable|string|max:20',
            'penandatangan_ktw' => 'nullable|string|max:20',
            'ketua_umum' => 'nullable|string|max:20',
            'profile' => 'nullable|file|image|max:2048', // Foto profil
            'image' => 'nullable|file|image|max:2048',   // Foto KTW
            'pekerjaan' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:data_wargas,email,' . $id,
            'password' => 'nullable|string|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // 4. Menyiapkan data untuk diupdate
        $data = $request->except(['_token', '_method', 'password', 'profile', 'image']);

        // ====================================================================
        // MODIFIKASI LOGIKA UPLOAD FILE DENGAN TIMESTAMP
        // ====================================================================

        // ... di dalam method update_data_warga

        // MODIFIKASI LOGIKA UPLOAD FILE DENGAN is_file()
        $namaDasarFile = Str::slug($request->name, '_');
        $waktuUpload = time();

        // Logika untuk file 'profile'
        if ($request->hasFile('profile')) {
            $pathFileLama = public_path($dataWarga->profile);
            // Hapus file lama HANYA JIKA ADA dan merupakan sebuah FILE
            if ($dataWarga->profile && is_file($pathFileLama)) {
                unlink($pathFileLama);
            }

            $file = $request->file('profile');
            $nama_file = $namaDasarFile . '_' . $waktuUpload . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profile'), $nama_file);
            $data['profile'] = 'profile/' . $nama_file;
        }

        // Logika untuk file 'image' (KTW)
        if ($request->hasFile('image')) {
            $pathFileLama = public_path($dataWarga->image);
            // Hapus file lama HANYA JIKA ADA dan merupakan sebuah FILE
            if ($dataWarga->image && is_file($pathFileLama)) {
                unlink($pathFileLama);
            }

            $file = $request->file('image');
            $nama_file = 'kartu_tanda_warga_' . $namaDasarFile . '_' . $waktuUpload . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image'), $nama_file);
            $data['image'] = 'image/' . $nama_file;
        }

        // ... sisa kode update
        // ====================================================================

        // 5. Kondisi untuk update password
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // 6. Proses update ke database
        data_warga::whereId($id)->update($data);

        // 7. Redirect setelah berhasil
        return redirect()->route('admin.data_warga')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function delete_data_warga(Request $request, $id)
    {
        // Cari data berdasarkan ID, jika tidak ditemukan akan error 404
        $data = data_warga::findOrFail($id);

        // Cek jika data ini memiliki nama file gambar
        if ($data->image) {
            // Dapatkan path absolut ke folder public
            $sumber_profile = public_path('profile/' . $data->image);
            $sumber_image = public_path('image/' . $data->image);

            // Definisikan folder dan file tujuan di dalam public
            $folder_tujuan = public_path('gambar_dihapus');
            $file_tujuan = $folder_tujuan . '/' . $data->image;

            // Cek jika folder tujuan belum ada, maka buat folder tersebut
            if (!is_dir($folder_tujuan)) {
                mkdir($folder_tujuan, 0755, true);
            }

            // Cek file di folder 'profile', jika ada pindahkan
            if (file_exists($sumber_profile)) {
                // 'rename' berfungsi untuk memindahkan file
                rename($sumber_profile, $file_tujuan);
            }
            // Jika tidak, cek file di folder 'image', jika ada pindahkan
            elseif (file_exists($sumber_image)) {
                rename($sumber_image, $file_tujuan);
            }
        }

        // Setelah urusan file selesai, hapus data dari database
        $data->delete();

        // Alihkan kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('admin.data_warga')->with('success', 'Data warga berhasil dihapus dan gambar telah diarsipkan.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class AdminController extends Controller
{
    public function dashboard()
    {

        return view('dashboard');
    }

    public function index()
    {

        $data = User::get();
        return view('index', compact('data'));
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

    public function data_warga()
    {
        return view('admin.data_warga');
    }
    public function create_data_warga()
    {

        return view('create');
    }
}

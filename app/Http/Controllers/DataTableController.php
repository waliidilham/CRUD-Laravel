<?php

namespace App\Http\Controllers;

use App\Models\data_warga;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Str;

class DataTableController extends Controller
{
  public function clientside(Request $request)
  {

    $data = new data_warga();
    if ($request->get('search')) {
      $data = $data->where('name', 'LIKE', '%' . $request->get('search') . '%')
        ->orWhere('nomor_induk_warga', 'LIKE', '%' . $request->get('search') . '%')
        ->orWhere('nik', 'LIKE', '%' . $request->get('search') . '%')
        ->orWhere('nomor_induk_PSHT_lampung', 'LIKE', '%' . $request->get('search') . '%')
        ->orWhere('ranting', 'LIKE', '%' . $request->get('search') . '%')
        ->orWhere('email', 'LIKE', '%' . $request->get('search') . '%')
        ->orWhere('cabang', 'LIKE', '%' . $request->get('search') . '%');
    }

    $data = $data->get();


    return view('datatable.clientside', compact('data', 'request'));
  }

  public function serverside(Request $request)
  {
    $data = new data_warga();
    if ($request->ajax()) {
      
return DataTable

    }
    
    // $data = $data->get();


    return view('datatable.serverside', compact( 'request'));
  }
}

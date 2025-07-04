<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });




//login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
  Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');;
  Route::get('/user', [AdminController::class, 'index'])->name('index');
  Route::get('/create', [AdminController::class, 'create'])->name('user.create');

  //table admin account
  Route::post('/store', [AdminController::class, 'store'])->name('user.store');
  Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('user.edit');
  Route::put('/update/{id}', [AdminController::class, 'update'])->name('user.update');
  Route::delete('/delete/{id}', [AdminController::class, 'delete'])->name('user.delete');

  //table data warga account
  Route::get('/Data-Warga', [AdminController::class, 'data_warga'])->name('data_warga');
  Route::get('/Create_Data-Warga', [AdminController::class, 'create_data_warga'])->name('user.create_data_warga');
  Route::post('/Store_Data-Warga', [AdminController::class, 'store_data_warga'])->name('user.store_data_warga');
  Route::get('/Edit_Data-Warga/{id}', [AdminController::class, 'edit_data_warga'])->name('user.edit_data_warga');
  Route::put('/Update_Data-Warga/{id}', [AdminController::class, 'update_data_warga'])->name('user.update_data_warga');
  Route::delete('/Delete_Data-Warga/{id}', [AdminController::class, 'delete_data_warga'])->name('user.delete_data_warga');
});

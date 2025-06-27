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
});

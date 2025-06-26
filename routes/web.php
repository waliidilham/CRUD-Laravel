<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [GuestController::class, 'dashboard']);
Route::get('/user', [GuestController::class, 'index'])->name('index');
Route::get('/create', [GuestController::class, 'create'])->name('user.create');
Route::post('/store', [GuestController::class, 'store'])->name('user.store');

Route::get('/edit/{id}', [GuestController::class, 'edit'])->name('user.edit');
Route::put('/update/{id}', [GuestController::class, 'update'])->name('user.update');

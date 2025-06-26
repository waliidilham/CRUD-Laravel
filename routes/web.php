<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [AdminController::class, 'dashboard']);
Route::get('/user', [AdminController::class, 'index'])->name('index');
Route::get('/create', [AdminController::class, 'create'])->name('user.create');

//table admin account
Route::post('/store', [AdminController::class, 'store'])->name('user.store');
Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('user.edit');
Route::put('/update/{id}', [AdminController::class, 'update'])->name('user.update');
Route::delete('/delete/{id}', [AdminController::class, 'delete'])->name('user.delete');
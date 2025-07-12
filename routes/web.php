<?php

use App\Http\Controllers\mahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//return home page
Route::get('/index', [mahasiswaController::class, 'index'])->name('index');

//return create and store page
Route::get('/registration', [mahasiswaController::class, 'indexRegistration'])->name('indexRegistration');
Route::post('/store', [mahasiswaController::class, 'store'])->name('store');

//return view and edit page
Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('edit');
Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('update');

//delete mahasiswas data
Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('destroy');

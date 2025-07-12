<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\mahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register'); // Rute untuk menampilkan form register
Route::post('/register', [AuthController::class, 'register'])->name('register.post'); // Rute untuk memproses register
Route::get('/api/cities/{provinceId}', [MahasiswaController::class, 'getCities']);
Route::get('/api/districts/{cityId}', [MahasiswaController::class, 'getDistricts']);

// User Route
Route::middleware(['auth'])->group(function () {
    // Rute untuk menampilkan halaman landingPage bagi pengguna biasa
    Route::get('/landingPage', function () {
        return view('landingpage');
    })->name('landingPage');

    Route::get('/registration', [mahasiswaController::class, 'indexRegistration'])->name('indexRegistration');
    Route::post('/store', [mahasiswaController::class, 'store'])->name('store');
    Route::get('/mahasiswa/{mahasiswa}/proof', [MahasiswaController::class, 'showRegistrationProof'])->name('registration.proof');
    Route::get('/mahasiswa/{mahasiswa}/proof/pdf', [MahasiswaController::class, 'exportRegistrationProofPdf'])->name('registration.proof.pdf');

});


// Admin Route
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/index', [mahasiswaController::class, 'index'])->name('index');

    Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('edit');
    Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('update');

    Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('destroy');
});








//return home page
// Route::get('/index', [mahasiswaController::class, 'index'])->name('index');

// //return create and store page
// Route::get('/registration', [mahasiswaController::class, 'indexRegistration'])->name('indexRegistration');
// Route::post('/store', [mahasiswaController::class, 'store'])->name('store');

// //return view and edit page
// Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('edit');
// Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('update');

// //delete mahasiswas data
// Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('destroy');
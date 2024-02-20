<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeanggotaanController;

Route::get('/', function () {
    return view('halaman.qrreader');
});




Route::prefix('daftar')->name('daftar.')->group(function () {
    Route::get('/', [KeanggotaanController::class, 'index'])->name('index');
    Route::get('/create', [KeanggotaanController::class, 'create'])->name('create');
    Route::post('/', [KeanggotaanController::class, 'store'])->name('store');
    Route::delete('/{id}', [KeanggotaanController::class, 'destroy'])->name('destroy');
});

Route::get('/barcode', [KeanggotaanController::class, 'barcode'])->name('barcode.barcode');
Route::post('/barcode', [KeanggotaanController::class, 'generateBarcode'])->name('barcode.generateBarcode');

Route::get('/qr', [KeanggotaanController::class, 'showQRCodeForm']);
Route::post('/qr', [KeanggotaanController::class, 'generateQRCode'])->name('barcode.generateQRCode');

Route::get('/anggota', [KeanggotaanController::class, 'indexAnggota'])->name('anggota.index');

Route::get('/absen', [KeanggotaanController::class, 'showAbsenPage'])->name('absen.index');
Route::post('/absen/search', [KeanggotaanController::class, 'searchByUsername'])->name('absen.search');


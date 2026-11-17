<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CrudController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\PesanController as AdminPesanController;
use App\Http\Controllers\BudayaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\WilayahController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/kuliner', [KulinerController::class, 'index'])->name('kuliner.index');
Route::get('/kuliner/{kuliner}', [KulinerController::class, 'show'])->name('kuliner.show');

Route::get('/wilayah', [WilayahController::class, 'index'])->name('wilayah');

Route::get('/oleh-oleh', [ProdukController::class, 'index'])->name('oleh-oleh');
Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');

Route::get('/budaya', [BudayaController::class, 'index'])->name('budaya.index');
Route::get('/budaya/{budaya}', [BudayaController::class, 'show'])->name('budaya.show');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'kirim'])->name('kontak.kirim');

/* ================= ADMIN ================= */
Route::get('/admin/login', [AuthController::class, 'form'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{pesanan}', [AdminPesananController::class, 'show'])->name('pesanan.show');
    Route::patch('/pesanan/{pesanan}', [AdminPesananController::class, 'update'])->name('pesanan.update');
    Route::delete('/pesanan/{pesanan}', [AdminPesananController::class, 'destroy'])->name('pesanan.destroy');

    Route::get('/pesan', [AdminPesanController::class, 'index'])->name('pesan.index');
    Route::patch('/pesan/{pesan}', [AdminPesanController::class, 'update'])->name('pesan.update');
    Route::delete('/pesan/{pesan}', [AdminPesanController::class, 'destroy'])->name('pesan.destroy');

    Route::prefix('{resource}')->where(['resource' => 'beranda|kuliner|budaya|wilayah|produk'])->group(function () {
        Route::get('/', [CrudController::class, 'index'])->name('crud.index');
        Route::get('/tambah', [CrudController::class, 'create'])->name('crud.create');
        Route::post('/', [CrudController::class, 'store'])->name('crud.store');
        Route::get('/{id}/ubah', [CrudController::class, 'edit'])->whereNumber('id')->name('crud.edit');
        Route::put('/{id}', [CrudController::class, 'update'])->whereNumber('id')->name('crud.update');
        Route::delete('/{id}', [CrudController::class, 'destroy'])->whereNumber('id')->name('crud.destroy');
    });
});

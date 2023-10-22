<?php

use App\Http\Controllers\akunController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\ProfileController;
use App\Models\Akun;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware(['auth'])->group(function () {
    Route::get('/',[dashboardController::class,'index'])->name('dashboard');

    //penjualan
    Route::controller(PenjualanController::class)->group(function(){
        Route::get('/penjualan','index')->name('penjualan.index');
        Route::post('/penjualan/create','createPenjualan')->name('penjualan.create');
        Route::delete('/penjualan/{penjualan}/delete','deletePenjualan')->name('penjualan.delete');
        Route::get('/penjualan/{penjualan}/edit','editPenjualan')->name('penjualan.edit');
        Route::put('/penjualan/{penjualan}/update','updatePenjualan')->name('penjualan.update');
        Route::get('/get/allpenjualan','getAllPenjualan')->name('api-penjualan');
    });
    Route::controller(PiutangController::class)->group(function(){
        Route::get('/piutang','index')->name('piutang.index');
        Route::put('/update/{piutang}','updatePiutang')->name('piutang.update');
        Route::delete('/delete/piutang/{piutang}','deletePiutang')->name('delete.piutang');
        Route::get('/getAll/piutang/{piutang}','getAll')->name('show.piutang');
    });

    Route::controller(PengeluaranController::class)->group(function(){
        Route::get('/pengeluaran','index')->name('pengeluaran.index');
        Route::delete('/delete-pengeluaran/{pengeluaran}','deletePengeluaran')->name('pengeluaran.delete');
        Route::post('/pengeluaran/create','createPengeluaran')->name('pengeluaran.create');
        Route::put('/pengeluaran/{pengeluaran}/update','updatePengeluaran')->name('pengeluaran.update');
        Route::get('/pengeluarang/{pengeluaran}','showPengeluaran')->name('pengeluaran.show');
    });

    Route::controller(HutangController::class)->group(function(){
        Route::get('/hutang','index')->name('hutang.index');
        Route::put('/hutang/update/{hutang}','updateHutang')->name('hutang.update');
        Route::get('/getall/{hutang}','getAllShow')->name('getall.hutang');
        Route::delete('/hutang/{hutang}','deleteHutang')->name('hutang.delete');
    });

    Route::controller(akunController::class)->group(function(){
        Route::get('/akun','index')->name('akun.index');
        Route::post('/create/akun','create')->name('akun.create');
        Route::delete('/aku/delete/{akun}','delete')->name('akun.delete');
        Route::put('/akun/update/{akun}','update')->name('akun.update');
        Route::get('/getall/akun/{akun}','getAllAkun')->name('akun.all');
    });

    Route::controller(JurnalController::class)->group(function(){
        Route::get('/jurnal-umum','index')->name('jurnal.index');
        Route::post('/search-jurnal','search')->name('jurnal.search');
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



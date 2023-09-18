<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\ProfileController;
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
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



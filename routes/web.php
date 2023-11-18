<?php

use App\Http\Controllers\akunController;
use App\Http\Controllers\BukuBesarController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\PdfViewController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Models\Akun;
use Illuminate\Support\Facades\Auth;
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

    Route::get('/', function () {
        if (Auth::check()) {
            if (Auth::user()->role == 'kasir') {
                return redirect()->route('dashboard.kasir');
            }
        }

        return redirect()->route('dashboard.other');
    })->name('dashboard')->middleware('auth');

    Route::get('/dashboard-kasir', [DashboardController::class, 'index'])->name('dashboard.kasir')->middleware('auth');
    Route::get('/dashboard-other', [PdfViewController::class, 'index'])->name('dashboard.other')->middleware('auth');

    Route::get('/chart-data',[dashboardController::class,'getChartData']);
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
        Route::post('/add/jurnal','add')->name('jurnal.add');
        Route::put('/craete/jurnal','saveDelete')->name('jurnal-update.create');
        Route::put('/delete/cancel/jurnal','deleteCancel')->name('jurnal.cancel');
        Route::delete('delete/jurnal/{jurnal}','deleteJurnal')->name('jurnal.delete');
        Route::get("jurnal/data/{jurnal}",'getJurnalEdit')->name('jurnal.edit');
        Route::put("jurnal/update/{jurnal}",'updateJurnal')->name('jurnal.update');
    });

    Route::controller(BukuBesarController::class)->group(function(){
        Route::get('/bukuBesar','index')->name('buku-besar.index');
        Route::post('/bukuBesar/allData','create')->name('buku-besar.create');
        Route::put('/bukutBesar/create','store')->name('buku-besar.store');
        Route::put('/bukuBesar/{buku}/update','createJurnalBuku')->name('buku-besar.update');
        Route::put('/bukuBesar/{buku}/store','storeBukuBesar')->name('buku-besar.store-all');
        Route::put('/delete/buku-besar/{buku}','cancelSave')->name('buku-besar.delete-all');
        Route::get('/get/bukuBesar/{buku}','getEdit')->name('get-buku');
        Route::put('/update/bukuBesar/{buku}','UpdateBuku')->name('buku-update');
        Route::delete('/buku/delete/{buku}','deleteBuku')->name('delete-buku.buku-besar');
    });

    Route::controller(PdfViewController::class)->group(function(){
        Route::get('/laporan','index')->name('laporan');
        Route::post('/view/penjualan','viewListPenjualan')->name('penjualan-between');
        Route::post('/view/pdf','pdf')->name('pdf-penjualan');
        Route::post('/view/pengeluaran','pdfpengeluaran')->name('pdf-view.pengeluaran');
        Route::post('/view/pengeluaran/pdf','pdfStreamPengeluaran')->name('pdf-stream.pengeluaran');



        Route::post('/view/pdf/naraca','naracaView')->name('naraca.view-pdf');
        Route::post('/view/naraca/print','naracaPdf')->name('print-pdf');


        Route::post('/laba-rugi/view','labaRugi')->name('view-laba.rugi');
        Route::post('/laba-rugi/print','labaRugiPdf')->name('laba-RugiPdf');
    });
    Route::controller(UsersController::class)->group(function(){
        Route::get('/user/create','index')->name('user.index');
        Route::post('/user/create','create')->name('user.create-new');
        Route::delete('/delete/User/{user}','deleteUser')->name('userDelete');
        Route::get('/getall/user/{id}','getusers')->name('username-getss');
        Route::put('/update/pass/{id}','updatePassword')->name('update-pass');
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



<?php

use App\Http\Controllers\akunController;
use App\Http\Controllers\BalanceSheetReportController;
use App\Http\Controllers\BigBookController;
use App\Http\Controllers\BukuBesarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\PdfViewController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfitLossReportController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReceivableController;
use App\Http\Controllers\SalesController;
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

    Route::get('/chart-data', [dashboardController::class, 'getChartData']);

    Route::controller(PiutangController::class)->group(function () {
        Route::get('/piutang', 'index')->name('piutang.index');
        Route::put('/update/{piutang}', 'updatePiutang')->name('piutang.update');
        Route::delete('/delete/piutang/{piutang}', 'deletePiutang')->name('delete.piutang');
        Route::get('/getAll/piutang/{piutang}', 'getAll')->name('show.piutang');
    });

    Route::controller(PengeluaranController::class)->group(function () {
        Route::get('/pengeluaran', 'index')->name('pengeluaran.index');
        Route::delete('/delete-pengeluaran/{pengeluaran}', 'deletePengeluaran')->name('pengeluaran.delete');
        Route::post('/pengeluaran/create', 'createPengeluaran')->name('pengeluaran.create');
        Route::put('/pengeluaran/{pengeluaran}/update', 'updatePengeluaran')->name('pengeluaran.update');
        Route::get('/pengeluarang/{pengeluaran}', 'showPengeluaran')->name('pengeluaran.show');
    });

    Route::controller(HutangController::class)->group(function () {
        Route::get('/hutang', 'index')->name('hutang.index');
        Route::put('/hutang/update/{hutang}', 'updateHutang')->name('hutang.update');
        Route::get('/getall/{hutang}', 'getAllShow')->name('getall.hutang');
        Route::delete('/hutang/{hutang}', 'deleteHutang')->name('hutang.delete');
    });

    Route::controller(akunController::class)->name('akun.')->prefix('akun')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/get-data', 'getdata')->name('getdata');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/delete', 'delete')->name('delete');
    });
    Route::controller(BigBookController::class)->name('bigbook.')->prefix('bigbook')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/get-data', 'getdata')->name('getdata');
    });

    Route::controller(ProfitLossReportController::class)->name('profitloss.')->prefix('profitloss')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/get-data', 'getdata')->name('getdata');
    });
    Route::controller(BalanceSheetReportController::class)->name('balancesheet.')->prefix('balance-sheet')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/get-data', 'getdata')->name('getdata');
    });

    Route::controller(JournalController::class)->name('journal.')->prefix('journal')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/get-data', 'getdata')->name('getdata');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/delete', 'delete')->name('delete');
    });

    Route::controller(CustomerController::class)->name('customer.')->prefix('customer')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/get-data', 'getdata')->name('getdata');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/delete', 'delete')->name('delete');
    });

    Route::controller(SalesController::class)->name('sales.')->prefix('sales')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/get-data', 'getdata')->name('getdata');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/delete', 'delete')->name('delete');
    });

    Route::controller(ReceivableController::class)->name('receivable.')->prefix('receivable')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/get-data', 'getdata')->name('getdata');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/delete', 'delete')->name('delete');
    });

    Route::controller(PurchaseController::class)->name('purchase.')->prefix('purchase')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/get-data', 'getdata')->name('getdata');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/delete', 'delete')->name('delete');
    });

    Route::controller(JurnalController::class)->group(function () {
        Route::get('/jurnal-umum', 'index')->name('jurnal.index');
        Route::post('/search-jurnal', 'search')->name('jurnal.search');
        Route::post('/add/jurnal', 'add')->name('jurnal.add');
        Route::put('/craete/jurnal', 'saveDelete')->name('jurnal-update.create');
        Route::put('/delete/cancel/jurnal', 'deleteCancel')->name('jurnal.cancel');
        Route::delete('delete/jurnal/{jurnal}', 'deleteJurnal')->name('jurnal.delete');
        Route::get("jurnal/data/{jurnal}", 'getJurnalEdit')->name('jurnal.edit');
        Route::put("jurnal/update/{jurnal}", 'updateJurnal')->name('jurnal.update');
    });


    Route::controller(PdfViewController::class)->group(function () {
        Route::get('/laporan', 'index')->name('laporan');
        Route::post('/view/penjualan', 'viewListPenjualan')->name('penjualan-between');
        Route::post('/view/pdf', 'pdf')->name('pdf-penjualan');
        Route::post('/view/pengeluaran', 'pdfpengeluaran')->name('pdf-view.pengeluaran');
        Route::post('/view/pengeluaran/pdf', 'pdfStreamPengeluaran')->name('pdf-stream.pengeluaran');



        Route::post('/view/pdf/naraca', 'naracaView')->name('naraca.view-pdf');
        Route::get('/view/naraca/print', 'naracaPdf')->name('neraca.print-pdf');


        Route::post('/laba-rugi/view', 'labaRugi')->name('view-laba.rugi');
        Route::post('/laba-rugi/print', 'labaRugiPdf')->name('laba-RugiPdf');
    });
    Route::controller(UsersController::class)->group(function () {
        Route::get('/user/create', 'index')->name('user.index');
        Route::post('/user/create', 'create')->name('user.create-new');
        Route::delete('/delete/User/{user}', 'deleteUser')->name('userDelete');
        Route::get('/getall/user/{id}', 'getusers')->name('username-getss');
        Route::put('/update/pass/{id}', 'updatePassword')->name('update-pass');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

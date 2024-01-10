<?php

namespace App\Http\Controllers;

use App\Helper\GenerateGL;
use App\Models\Akun;
use App\Models\Customer;
use App\Models\Hutang;
use App\Models\Journal;
use App\Models\JournalItem;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\Piutang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    public function index()
    {
        return view('pages.purchase.index', [
            'page_title' => 'Pengeluaran'
        ]);
    }

    public function getdata()
    {

        $data = Pengeluaran::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = '';
                $action .= '<div class="dropdown">';
                $action .= '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action Menu';
                $action .= '</button>';
                $action .= '<div class="dropdown-menu">';
                $action .= '<h6 class="dropdown-header tx-uppercase tx-12 tx-bold tx-inverse">Action Menu</h6>';
                $action .= '<a class="dropdown-item" href="' . route('purchase.edit', $data->id) . '">Edit</a>';
                $action .= '<a class="dropdown-item text-danger delete-item" href="#" data-url="' . route('purchase.delete', $data->id) . '">Hapus</a>';
                $action .= '</div>';
                $action .= '</div>';

                return $action;
            })
            ->editColumn('total_pengeluaran', function ($data) {
                return $this->currencyIDR($data->total_pengeluaran);
            })
            ->addColumn('nomor_pengeluaran', function ($data) {
                return $data->pengeluaran->nomor_pengeluaran ?? '';
            })

            ->editColumn('tanggal_pengeluran', function ($data) {
                if ($data->tanggal_pengeluran != null) {
                    $date = Carbon::createFromFormat('Y-m-d', $data->tanggal_pengeluran);
                    return $date;
                }
            })
            ->toJson();
    }

    public function create()
    {
        $data = null;
        $coa = Akun::all();
        return view('pages.purchase.form', [
            'page_title' => 'Tambah Pengeluaran',
            'data' => $data,
            'coa' => $coa,
        ]);
    }
    public function edit($id)
    {
        $data = Pengeluaran::with(['debt'])->find($id);
        $coa = Akun::all();
        return view('pages.purchase.form', [
            'page_title' => 'Edit Pengeluaran',
            'data' => $data,
            'coa' => $coa,

        ]);
    }

    public function store(Request $request)
    {
        try {

            // return $request->all();
            $data = Pengeluaran::count();
            $receivebles = Hutang::count();

            $transaction_code = 'RV' . now()->format('Ymd') . str_pad($data + 1, 4, '0', STR_PAD_LEFT);
            $transaction_code_receivebles = 'DB' . now()->format('Ymd') . str_pad($receivebles + 1, 4, '0', STR_PAD_LEFT);



            $formdata = array(
                'user_id' => Auth::user()->id,
                'tanggal_pengeluran' => $request->tanggal_pengeluran,
                'kode_pengeluaran' => $transaction_code,
                'akun_id' => $request->akun_id,
                'jenis_bayar' => $request->jenis_bayar,
                'jenis_pengeluaran' => $request->jenis_pengeluaran,
                'total_pengeluaran' => $request->total_pengeluaran,
                'descriptions' => $request->description,
                'is_debt' => $request->is_debt ?? 0
            );

            Pengeluaran::create($formdata);
            $latest_data = Pengeluaran::orderby('created_at', 'DESC')->first();
            $akun1 = array(
                'uniq_id' => $latest_data->id,
                'description' => 'Transaksi Pengeluaran Dengan Nomor Faktur' . ' ' . $latest_data->faktur_penjualan,
                'nominal' => $request->total_pengeluaran,
                'date' => $request->tanggal_pengeluran,
                'akun' => [$request->akun_id, '1']
            );
            GenerateGL::createGL($akun1);

            if ($request->is_debt == 1) {


                $formdata2 = array(
                    'user_id' => Auth::user()->id,
                    'no_transaksi_hutang' => $transaction_code_receivebles,
                    'pengeluaran_id' => $latest_data->id,
                    'tgl_transaksi_hutang' => $request->tgl_transaksi_hutang,
                    'tgl_jatuh_tempo' => $request->tgl_jatuh_tempo,
                    'total_transaksi_hutang' => $request->total_transaksi_hutang,
                    'total_pembayaran' => $request->total_pembayaran ?? 0,
                    'sisa_pembayaran' => $request->sisa_pembayaran,
                    'status_pembayaran' => $request->status_pembayaran ?? 'PENDING',
                    'description' => $request->description,
                );

                Hutang::create($formdata2);
                $latest_data_hutang = Hutang::orderby('created_at', 'DESC')->first();
                $akun2 = array(
                    'uniq_id' => $latest_data_hutang->id,
                    'description' => 'Hutang Pengeluaran Dengan Nomor Faktur' . ' ' . $transaction_code_receivebles,
                    'nominal' => $request->total_transaksi_hutang,
                    'date' => $request->tanggal_pengeluran,
                    'akun' => [$request->akun_id, '5']
                );

                GenerateGL::createGL($akun2);

                if ($request->total_pembayaran != 0) {
                    $akun3 = array(
                        'uniq_id' => $latest_data_hutang->id,
                        'description' => 'Pembayaran Hutang Pengeluaran Dengan Nomor Faktur' . ' ' . $transaction_code_receivebles,
                        'nominal' => $request->total_pembayaran,
                        'date' => $request->tgl_transaksi_hutang,
                        'akun' => ['5', '1']
                    );

                    GenerateGL::createGL($akun3);

                    $akun4 = array(
                        'uniq_id' => $latest_data_hutang->id,
                        'description' => 'Sisa Tagihan Hutang Pengeluaran Dengan Nomor Faktur' . ' ' . $transaction_code_receivebles,
                        'nominal' => $request->sisa_pembayaran,
                        'date' => $request->tgl_transaksi_hutang,
                        'akun' => ['5', $request->akun_id]
                    );

                    GenerateGL::createGL($akun4);
                }
            }




            return redirect()->back()->with('message', 'Data Akun Berhasil Di Simpan !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        } catch (\Exception $th) {
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        }
    }
    public function update(Request $request, $id)
    {
        try {

            $data = Pengeluaran::count();
            $receivebles = Hutang::count();

            $transaction_code_receivebles = 'DB' . now()->format('Ymd') . str_pad($receivebles + 1, 4, '0', STR_PAD_LEFT);



            $formdata = array(
                'tanggal_pengeluran' => $request->tanggal_pengeluran,
                'akun_id' => $request->akun_id,
                'jenis_bayar' => $request->jenis_bayar,
                'jenis_pengeluaran' => $request->jenis_pengeluaran,
                'total_pengeluaran' => $request->total_pengeluaran,
                'descriptions' => $request->description,
                'is_debt' => $request->is_debt ?? 0
            );

            Pengeluaran::whereId($id)->update($formdata);

            $latest_data = Pengeluaran::find($id);

            Journal::where('uniq_id', $id)->delete();
            JournalItem::where('uniq_id', $id)->delete();

            $akun1 = array(
                'uniq_id' => $id,
                'description' => 'Transaksi Pengeluaran Dengan Nomor Faktur' . ' ' . $latest_data->faktur_penjualan,
                'nominal' => $request->total_pengeluaran,
                'date' => $request->tanggal_pengeluran,
                'akun' => [$request->akun_id, '1']
            );
            GenerateGL::createGL($akun1);
            Hutang::where('pengeluaran_id', $id)->delete();
            if ($request->is_debt == 1) {


                $formdata2 = array(
                    'user_id' => Auth::user()->id,
                    'no_transaksi_hutang' => $transaction_code_receivebles,
                    'pengeluaran_id' => $latest_data->id,
                    'tgl_transaksi_hutang' => $request->tgl_transaksi_hutang,
                    'tgl_jatuh_tempo' => $request->tgl_jatuh_tempo,
                    'total_transaksi_hutang' => $request->total_transaksi_hutang,
                    'total_pembayaran' => $request->total_pembayaran ?? 0,
                    'sisa_pembayaran' => $request->sisa_pembayaran,
                    'status_pembayaran' => $request->status_pembayaran ?? 'PENDING',
                    'description' => $request->description,
                );

                Hutang::create($formdata2);
                $latest_data_hutang = Hutang::orderby('created_at', 'DESC')->first();
                $akun2 = array(
                    'uniq_id' => $latest_data_hutang->id,
                    'description' => 'Hutang Pengeluaran Dengan Nomor Faktur' . ' ' . $transaction_code_receivebles,
                    'nominal' => $request->total_transaksi_hutang,
                    'date' => $request->tgl_transaksi_hutang,
                    'akun' => ['5', $request->akun_id]
                );

                GenerateGL::createGL($akun2);

                if ($request->total_pembayaran != 0) {
                    $akun3 = array(
                        'uniq_id' => $latest_data_hutang->id,
                        'description' => 'Pembayaran Hutang Pengeluaran Dengan Nomor Faktur' . ' ' . $transaction_code_receivebles,
                        'nominal' => $request->total_pembayaran,
                        'date' => $request->tgl_transaksi_hutang,
                        'akun' => ['1', '5']
                    );

                    GenerateGL::createGL($akun3);

                    $akun4 = array(
                        'uniq_id' => $latest_data_hutang->id,
                        'description' => 'Sisa Tagihan Hutang Pengeluaran Dengan Nomor Faktur' . ' ' . $transaction_code_receivebles,
                        'nominal' => $request->sisa_pembayaran,
                        'date' => $request->tgl_transaksi_hutang,
                        'akun' => ['5', $request->akun_id]
                    );

                    GenerateGL::createGL($akun4);
                }
            }




            return redirect()->back()->with('message', 'Data Akun Berhasil Di Simpan !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        } catch (\Exception $th) {
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        }
    }


    public function delete($id)
    {
        Hutang::where('pengeluaran_id', $id)->delete();
        Pengeluaran::whereId($id)->delete();
        return response()->json([
            'message' => 'Data success deleted !'
        ]);
    }
}

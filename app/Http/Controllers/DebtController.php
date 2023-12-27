<?php

namespace App\Http\Controllers;

use App\Helper\GenerateGL;
use App\Models\Customer;
use App\Models\Hutang;
use App\Models\Journal;
use App\Models\JournalItem;
use App\Models\Piutang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DebtController extends Controller
{
    public function index()
    {
        return view('pages.purchase.hutang.index', [
            'page_title' => 'Hutang'
        ]);
    }

    public function getdata()
    {

        $data = Hutang::with(['pengeluaran'])->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = '';
                $action .= '<div class="dropdown">';
                $action .= '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action Menu';
                $action .= '</button>';
                $action .= '<div class="dropdown-menu">';
                $action .= '<h6 class="dropdown-header tx-uppercase tx-12 tx-bold tx-inverse">Action Menu</h6>';
                $action .= '<a class="dropdown-item" href="' . route('debt.edit', $data->id) . '">Bayar Hutang</a>';
                $action .= '</div>';
                $action .= '</div>';


                if (intval($data->sisa_pembayaran) != 0) {
                    return $action;
                } else {
                    return '-';
                }
            })
            ->addColumn('nomor_pengeluaran', function ($data) {
                return $data->pengeluaran->nomor_pengeluaran ?? '';
            })
            ->editColumn('total_transaksi_hutang', function ($data) {
                return $this->currencyIDR($data->total_transaksi_hutang);
            })
            ->editColumn('total_pembayaran', function ($data) {
                return $this->currencyIDR($data->total_pembayaran);
            })
            ->editColumn('sisa_pembayaran', function ($data) {
                return $this->currencyIDR($data->sisa_pembayaran);
            })
            ->editColumn('created_at', function ($data) {
                if ($data->created_at != null) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at);
                    return $date->setTimezone('+8');
                }
            })
            ->toJson();
    }

    public function create($id)
    {
        $data = null;
        return view('pages.purchase.hutang.form', [
            'page_title' => 'Pembayaran Hutang',
            'data' => $data,
        ]);
    }

    public function edit($id)
    {
        $data = Hutang::find($id);
        return view('pages.purchase.hutang.form', [
            'page_title' => 'Pembayaran Hutang',
            'data' => $data,
        ]);
    }


    public function store(Request $request)
    {
        //  Aaa
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $data = Hutang::with(['pengeluaran'])->whereId($id)->first();

            $formdata = array(
                'total_pembayaran' => $request->total_pembayaran + $data->total_pembayaran,
                'sisa_pembayaran' => $request->sisa_pembayaran,
                'status_pembayaran' => $request->sisa_pembayaran == 0 ? 'PAID' : 'PENDING'
            );

            Hutang::whereId($id)->update($formdata);

            $akun2 = array(
                'uniq_id' => $data->id,
                'description' => 'Pembayaran Hutang Dengan Nomor Faktur' . ' ' . $data->no_transaksi,
                'nominal' => $request->total_pembayaran,
                'date' => Carbon::now()->format('Y-m-d'),
                'akun' => ['1', '5']
            );

            GenerateGL::createGL($akun2);

            if ($request->sisa_tagihan != 0) {
                $akun1 = array(
                    'uniq_id' => $data->id,
                    'description' => 'Sisa Tagihan Hutang Dengan Nomor Faktur' . ' ' . $data->no_transaksi,
                    'nominal' => $request->sisa_tagihan,
                    'date' => Carbon::now()->format('Y-m-d'),
                    'akun' => ['1', '5']
                );

                GenerateGL::createGL($akun1);
            }



            DB::commit();

            return redirect()->route('debt.index')->with('message', 'Data Akun Berhasil Di Simpan !');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        }
    }
}

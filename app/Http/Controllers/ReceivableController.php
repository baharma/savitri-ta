<?php

namespace App\Http\Controllers;

use App\Helper\GenerateGL;
use App\Models\Customer;
use App\Models\Journal;
use App\Models\JournalItem;
use App\Models\Piutang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReceivableController extends Controller
{
    public function index()
    {
        return view('pages.penjualan.piutang.index', [
            'page_title' => 'Piutang'
        ]);
    }

    public function getdata()
    {

        $data = Piutang::with(['penjualans'])->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = '';
                $action .= '<div class="dropdown">';
                $action .= '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action Menu';
                $action .= '</button>';
                $action .= '<div class="dropdown-menu">';
                $action .= '<h6 class="dropdown-header tx-uppercase tx-12 tx-bold tx-inverse">Action Menu</h6>';
                $action .= '<a class="dropdown-item" href="' . route('receivable.edit', $data->id) . '">Bayar Piutang</a>';
                $action .= '</div>';
                $action .= '</div>';


                if (intval($data->sisa_tagihan) != 0) {
                    return $action;
                } else {
                    return '-';
                }
            })
            ->addColumn('no_faktur_penjualan', function ($data) {
                return $data->penjualans->faktur_penjualan ?? '';
            })
            ->editColumn('total_tagihan', function ($data) {
                return $this->currencyIDR($data->total_tagihan);
            })
            ->editColumn('total_pembayaran', function ($data) {
                return $this->currencyIDR($data->total_pembayaran);
            })
            ->editColumn('sisa_tagihan', function ($data) {
                return $this->currencyIDR($data->sisa_tagihan);
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
        $customer = Customer::where('is_allow_debt', 1)->get();
        return view('pages.penjualan.piutang.form', [
            'page_title' => 'Pembayaran Piutang',
            'data' => $data,
            'customer' => $customer,
        ]);
    }

    public function edit($id)
    {
        $data = Piutang::find($id);
        $customer = Customer::where('is_allow_debt', 1)->get();
        return view('pages.penjualan.piutang.form', [
            'page_title' => 'Pembayaran Piutang',
            'data' => $data,
            'customer' => $customer,
        ]);
    }


    public function store(Request $request)
    {
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $data = Piutang::with(['penjualans'])->whereId($id)->first();

            $formdata = array(
                'total_pembayaran' => $request->total_pembayaran + $data->total_pembayaran,
                'sisa_tagihan' => $request->sisa_tagihan,
                'status_pembayaran' => $request->sisa_tagihan == 0 ? 'PAID' : 'PENDING'
            );

            Piutang::whereId($id)->update($formdata);

            $akun2 = array(
                'uniq_id' => $data->id,
                'description' => 'Pembayaran Piutang Penjualan Dengan Nomor Faktur' . ' ' . $data->no_transaksi,
                'nominal' => $request->total_pembayaran,
                'date' => Carbon::now()->format('Y-m-d'),
                'akun' => ['1', '2']
            );

            GenerateGL::createGL($akun2);

            if ($request->sisa_tagihan != 0) {
                $akun1 = array(
                    'uniq_id' => $data->id,
                    'description' => 'Sisa Tagihan Piutang Penjualan Dengan Nomor Faktur' . ' ' . $data->no_transaksi,
                    'nominal' => $request->sisa_tagihan,
                    'date' => Carbon::now()->format('Y-m-d'),
                    'akun' => ['2', '7']
                );

                GenerateGL::createGL($akun1);
            }



            DB::commit();

            return redirect()->route('receivable.index')->with('message', 'Data Akun Berhasil Di Simpan !');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        }
    }
}

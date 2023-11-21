<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Penjualan;
use App\Models\Piutang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SalesController extends Controller
{
    public function index()
    {
        return view('pages.penjualan.index', [
            'page_title' => 'Penjualan'
        ]);
    }

    public function getdata()
    {

        $data = Penjualan::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = '';
                $action .= '<div class="dropdown">';
                $action .= '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action Menu';
                $action .= '</button>';
                $action .= '<div class="dropdown-menu">';
                $action .= '<h6 class="dropdown-header tx-uppercase tx-12 tx-bold tx-inverse">Action Menu</h6>';
                $action .= '<a class="dropdown-item" href="' . route('sales.edit', $data->id) . '">Edit</a>';
                $action .= '<a class="dropdown-item text-danger delete-item" href="#" data-url="' . route('sales.delete', $data->id) . '">Hapus</a>';
                $action .= '</div>';
                $action .= '</div>';

                return $action;
            })

            ->editColumn('tanggal_penjualan', function ($data) {
                if ($data->created_at != null) {
                    $date = Carbon::createFromFormat('Y-m-d', $data->tanggal_penjualan);
                    return $date;
                }
            })
            ->toJson();
    }

    public function create()
    {
        $data = null;
        $customer = Customer::where('is_allow_debt', 1)->get();
        return view('pages.penjualan.form', [
            'page_title' => 'Tambah Penjualan',
            'data' => $data,
            'customer' => $customer,
        ]);
    }
    public function edit($id)
    {
        $data = Penjualan::with(['receivables'])->find($id);
        $customer = Customer::where('is_allow_debt', 1)->get();
        return view('pages.penjualan.form', [
            'page_title' => 'Tambah Penjualan',
            'data' => $data,
            'customer' => $customer,
        ]);
    }

    public function store(Request $request)
    {
        try {

            $data = Penjualan::count();
            $receivebles = Piutang::count();

            $transaction_code = 'TRX' . now()->format('Ymd') . str_pad($data + 1, 4, '0', STR_PAD_LEFT);
            $transaction_code_receivebles = 'RV' . now()->format('Ymd') . str_pad($receivebles + 1, 4, '0', STR_PAD_LEFT);

            $formdata = array(
                'user_id' => Auth::user()->id,
                'tanggal_penjualan' => $request->tanggal_penjualan,
                'faktur_penjualan' => $transaction_code,
                'harga_barang' => $request->harga_barang,
                'nama_barang' => $request->nama_barang,
                'jenis_barang' => $request->jenis_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'jenis_pembayarang' => $request->jenis_pembayarang,
                'total_penjualan' => $request->total_penjualan,
                'description' => $request->description,
                'is_receivables' => $request->is_receivables
            );

            Penjualan::create($formdata);

            if ($request->is_receivables == 1) {
                $latest_data = Penjualan::orderby('created_at', 'DESC')->first();

                $formdata2 = array(
                    'user_id' => Auth::user()->id,
                    'no_transaksi' => $transaction_code_receivebles,
                    'penjualan_id' => $latest_data->id,
                    'customer_id' => $request->customer_id,
                    'tgl_transaksi_piutang' => $request->tgl_transaksi_piutang,
                    'tgl_jatuh_tempo_piutang' => $request->tgl_jatuh_tempo_piutang,
                    'total_tagihan' => $request->total_tagihan,
                    'total_pembayaran' => $request->total_pembayaran,
                    'status_pembayaran' => $request->status_pembayaran ?? 'PENDING',
                    'description' => $request->description,
                    'sisa_tagihan' => $request->total_tagihan - $request->total_pembayaran,
                );

                Piutang::create($formdata2);
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

            $data = Penjualan::find($id);
            $receivebles = Piutang::count();

            $transaction_code_receivebles = 'RV' . now()->format('Ymd') . str_pad($receivebles + 1, 4, '0', STR_PAD_LEFT);

            $formdata = array(
                'user_id' => Auth::user()->id,
                'tanggal_penjualan' => $request->tanggal_penjualan,
                'faktur_penjualan' => $data->faktur_penjualan,
                'harga_barang' => $request->harga_barang,
                'nama_barang' => $request->nama_barang,
                'jenis_barang' => $request->jenis_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'jenis_pembayarang' => $request->jenis_pembayarang,
                'total_penjualan' => $request->total_penjualan,
                'description' => $request->description,
                'is_receivables' => $request->is_receivables
            );

            Penjualan::whereid($id)->update($formdata);

            if ($request->is_receivables == 1) {

                $piutang = Piutang::where('penjualan_id', $id)->first();

                
                $formdata2 = array(
                    'user_id' => Auth::user()->id,
                    'no_transaksi' => $transaction_code_receivebles,
                    'penjualan_id' => $id,
                    'customer_id' => $request->customer_id,
                    'tgl_transaksi_piutang' => $request->tgl_transaksi_piutang,
                    'tgl_jatuh_tempo_piutang' => $request->tgl_jatuh_tempo_piutang,
                    'total_tagihan' => $request->total_tagihan,
                    'total_pembayaran' => $request->total_pembayaran,
                    'status_pembayaran' => $request->status_pembayaran ?? 'PENDING',
                    'description' => $request->description,
                    'sisa_tagihan' => $request->total_tagihan - $request->total_pembayaran,
                );

                if ($piutang == null) {
                    Piutang::create($formdata2);
                }else{
                    Piutang::whereId($piutang->id)->update($formdata2);
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
        Akun::whereId($id)->delete();
        return response()->json([
            'message' => 'Data success deleted !'
        ]);
    }
}

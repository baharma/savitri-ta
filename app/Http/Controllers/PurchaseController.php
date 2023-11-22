<?php

namespace App\Http\Controllers;

use App\Helper\GenerateGL;
use App\Models\Akun;
use App\Models\Customer;
use App\Models\Journal;
use App\Models\JournalItem;
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
        $coa = Akun::all();
        return view('pages.purchase.form', [
            'page_title' => 'Tambah Pengeluaran',
            'data' => $data,
            'coa' => $coa,
        ]);
    }
    public function edit($id)
    {
        $data = Penjualan::with(['receivables'])->find($id);
        $customer = Customer::where('is_allow_debt', 1)->get();
        return view('pages.penjualan.form', [
            'page_title' => 'Edit Penjualan',
            'data' => $data,
            'customer' => $customer,
        ]);
    }

    public function store(Request $request)
    {
        // try {

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
            'is_receivables' => $request->is_receivables ?? 0
        );

        Penjualan::create($formdata);
        $latest_data = Penjualan::orderby('created_at', 'DESC')->first();
        $this->createGLTransaction($latest_data);

        if ($request->is_receivables == 1) {

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

            $latest_data_piutang = Piutang::orderby('created_at', 'DESC')->first();
            $this->createGLPiutang($latest_data_piutang);
        }




        return redirect()->back()->with('message', 'Data Akun Berhasil Di Simpan !');
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        // } catch (\Exception $th) {
        //     return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        // }
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
            $piutang = Piutang::where('penjualan_id', $id)->first();

            Journal::where('uniq_id', $id)->delete();
            JournalItem::where('uniq_id', $id)->delete();
            Journal::where('uniq_id', $piutang->id)->delete();
            JournalItem::where('uniq_id', $piutang->id)->delete();

            $this->createGLTransaction($data);


            if ($request->is_receivables == 1) {




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
                } else {
                    Piutang::whereId($piutang->id)->update($formdata2);
                }



                $this->createGLPiutang($piutang);
            }




            return redirect()->back()->with('message', 'Data Akun Berhasil Di Simpan !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        } catch (\Exception $th) {
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        }
    }

    // Create Jurnal
    function createGLPiutang($data)
    {
        $dataJournal2 = [
            "description" => "Transaksi Dari Invoice" . " " . $data->no_transaksi,
            "akun_id" => [
                "2",
                "5",
            ],
            "debit" => [$data->sisa_tagihan, "0"],
            "kredit" => ["0", $data->sisa_tagihan],
            "nominal" => $data->sisa_tagihan,
        ];

        $glpiutang = new Journal;


        $glpiutang->date = Carbon::now();
        $glpiutang->description = $dataJournal2['description'];
        $glpiutang->kode_jurnal = GenerateGL::journal();
        $glpiutang->nominal = $dataJournal2['nominal'];
        $glpiutang->uniq_id = $data->id;

        $glpiutang->save();

        $items = $dataJournal2['akun_id'];

        foreach ($items as $key => $value) {
            JournalItem::insert([
                'journal_id' => $glpiutang->id,
                'user_id' => Auth::user()->id,
                'debit' => floatval($dataJournal2['debit'][$key]),
                'kredit' => floatval($dataJournal2['kredit'][$key]),
                'akun_id' => $dataJournal2['akun_id'][$key],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'uniq_id' => $data->id
            ]);
        }
    }

    function createGLTransaction($data)
    {
        $dataJournal1 = [
            "description" => "Transaksi Dari Invoice" . " " . $data->faktur_penjualan,
            "akun_id" => [
                "1",
                "5",
            ],
            "debit" => [$data->total_penjualan, "0"],
            "kredit" => ["0", $data->total_penjualan],
            "nominal" => $data->total_penjualan,
        ];

        $gltransaksi = new Journal;
        $gltransaksi->date = Carbon::now();
        $gltransaksi->description = $dataJournal1['description'];
        $gltransaksi->kode_jurnal = GenerateGL::journal();
        $gltransaksi->nominal = $dataJournal1['nominal'];
        $gltransaksi->uniq_id = $data->id;

        $gltransaksi->save();

        $items = $dataJournal1['akun_id'];

        foreach ($items as $key => $value) {
            JournalItem::insert([
                'journal_id' => $gltransaksi->id,
                'user_id' => Auth::user()->id,
                'debit' => floatval($dataJournal1['debit'][$key]),
                'kredit' => floatval($dataJournal1['kredit'][$key]),
                'akun_id' => $dataJournal1['akun_id'][$key],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'uniq_id' => $data->id

            ]);
        }
    }



    public function delete($id)
    {
        Piutang::where('penjualan_id', $id)->delete();
        Penjualan::whereId($id)->delete();
        return response()->json([
            'message' => 'Data success deleted !'
        ]);
    }
}

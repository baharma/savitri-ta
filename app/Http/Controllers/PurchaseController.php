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
        // try {

        // return $request->all();
        $data = Pengeluaran::count();
        $receivebles = Hutang::count();

        $transaction_code = 'PO' . now()->format('Ymd') . str_pad($data + 1, 4, '0', STR_PAD_LEFT);
        $transaction_code_receivebles = 'DB' . now()->format('Ymd') . str_pad($receivebles + 1, 4, '0', STR_PAD_LEFT);



        $formdata = array(
            'user_id' => Auth::user()->id,
            'tanggal_pengeluran' => $request->tanggal_pengeluran,
            'nomor_pengeluaran' => $transaction_code,
            'akun_id' => $request->akun_id,
            'jenis_bayar' => $request->jenis_bayar,
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'total_pengeluaran' => $request->total_pengeluaran,
            'descriptions' => $request->description,
            'is_debt' => $request->is_debt ?? 0
        );

        Pengeluaran::create($formdata);
        $latest_data = Pengeluaran::orderby('created_at', 'DESC')->first();
        // $this->createGLTransaction($latest_data, $akun_id);

        if ($request->is_receivables == 1) {


            $formdata2 = array(
                'user_id' => Auth::user()->id,
                'no_transaksi_hutang' => $transaction_code_receivebles,
                'pengeluaran_id' => $latest_data->id,
                'tgl_transaksi_hutang' => $request->tgl_transaksi_hutang,
                'tgl_jatuh_tempo' => $request->tgl_jatuh_tempo,
                'total_transaksi_hutang' => $request->total_transaksi_hutang,
                'status_pembayaran' => $request->status_pembayaran ?? 'PENDING',
                'description' => $request->description,
            );

            Hutang::create($formdata2);

            $latest_data_piutang = Hutang::orderby('created_at', 'DESC')->first();
            // $this->createGLPiutang($latest_data_piutang);
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
        // try {

            $data = Pengeluaran::find($id);
            $receivebles = Hutang::count();

            $transaction_code_receivebles = 'RV' . now()->format('Ymd') . str_pad($receivebles + 1, 4, '0', STR_PAD_LEFT);

            $formdata = array(
                'user_id' => Auth::user()->id,
                'tanggal_pengeluran' => $request->tanggal_pengeluran,
                'akun_id' => $request->akun_id,
                'jenis_bayar' => $request->jenis_bayar,
                'jenis_pengeluaran' => $request->jenis_pengeluaran,
                'total_pengeluaran' => $request->total_pengeluaran,
                'descriptions' => $request->description,
                'is_debt' => $request->is_debt ?? 0
            );

            Pengeluaran::whereid($id)->update($formdata);
            $piutang = Hutang::where('pengeluaran_id', $id)->first();


            if ($request->is_debt == 1) {

                $formdata2 = array(
                    'user_id' => Auth::user()->id,
                    'pengeluaran_id' => $id,
                    'tgl_transaksi_hutang' => $request->tgl_transaksi_hutang,
                    'tgl_jatuh_tempo' => $request->tgl_jatuh_tempo,
                    'total_transaksi_hutang' => $request->total_transaksi_hutang,
                    'status_pembayaran' => $request->status_pembayaran ?? 'PENDING',
                    'description' => $request->description,
                );

                if ($piutang == null) {
                    Hutang::create($formdata2);
                } else {
                    Hutang::whereId($piutang->id)->update($formdata2);
                }

            }




            return redirect()->back()->with('message', 'Data Akun Berhasil Di Simpan !');
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        // } catch (\Exception $th) {
        //     return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        // }
    }

    // Create Jurnal
    function createGLPiutang($data, $akun_id)
    {
        $dataJournal2 = [
            "description" => "Transaksi Dari Invoice" . " " . $data->no_transaksi,
            "akun_id" => [
                $akun_id,
                "3",
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
        Hutang::where('pengeluaran_id', $id)->delete();
        Pengeluaran::whereId($id)->delete();
        return response()->json([
            'message' => 'Data success deleted !'
        ]);
    }
}

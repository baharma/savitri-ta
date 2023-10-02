<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{

    public $modal;

    public function __construct(Pengeluaran $modal)
    {
        $this->modal = $modal;
    }

    public function index(){

        $data = $this->modal->orderBy('created_at', 'asc')->paginate(10)->onEachSide(1);

        return view('pages.pengeluaran.pengeluran-index',compact('data'));
    }

    public function createPengeluaran(Request $request){
        $data = $request->all();
        $randomNumber = rand();
        $dataNoTransation = "CT" . $randomNumber ;
        $item = [
            'user_id'=>Auth::user()->id,
            'jenis_bayar'=>$data['jenis_bayar'],
            'tanggal_pengeluran'=>$data['tanggal_pengeluran'],
            'jenis_pengeluaran'=>$data['jenis_pengeluaran'],
            'total_pengeluaran'=>$data['total_pengeluaran'],
            'descriptions'=>$data['description_penjualan']
        ];

        $pengeluaran =  $this->modal->create($item);
        if($request->tgl_transaksi_hutang || $request->tgl_jatuh_tempo){
            $itemsHutang = [
                'user_id'=>Auth::user()->id,
                'no_transaksi_hutang'=>$dataNoTransation,
                'tgl_transaksi_hutang'=>$data['tgl_transaksi_hutang'],
                'tgl_jatuh_tempo'=>$data['tgl_jatuh_tempo'],
                'total_transaksi_hutang'=>$data['total_transaksi_hutang'],
                'description'=>$data['description_hutang'],
                'pengeluaran_id'=>$pengeluaran->id
            ];
            Hutang::create($itemsHutang);
        }

        return redirect()->back()->with('message', 'Data Pengeluaran Berhasil Di Buat!');
    }

    public function updatePengeluaran(Pengeluaran $pengeluaran,Request $request){
        dd($pengeluaran);
    }


    public function deletePengeluaran(Pengeluaran $pengeluaran){
        $pengeluaran->delete();
        return response()->json([
            'message' => 'Data success deleted !'
        ]);
    }

    public function showPengeluaran(Pengeluaran $pengeluaran){
        return response()->json($pengeluaran);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Piutang;
use Illuminate\Http\Request;

class PiutangController extends Controller
{
    private $piutang;
    public function __construct(Piutang $piutang)
    {
        $this->piutang = $piutang;
    }


    public function index(){
        $data = $this->piutang->orderBy('created_at', 'asc')->paginate(10);
        return view('pages.piutang.index-piutang',compact('data'));
    }


    public function deletePiutang(Piutang $piutang){
        $piutang->delete();
        return response()->json(['delete succes']);
    }

    public function updatePiutang(Piutang $piutang,Request $request){
        $data = $request->all();

        $item = [
            'nama_Pelanggan'=>$data['nama_Pelanggan'],
            'alamat'=>$data['alamat_piutang'],
            'tgl_transaksi_piutang'=>$data['tgl_transaksi_piutang'],
            'tgl_jatuh_tempo_piutang'=>$data['tgl_jatuh_tempo_piutang'],
            'total_pembayaran'=>$data['total_pembayaran'],
            'total_tagihan'=>$data['total_tagihan'],
            'status_pembayaran'=>$data['status_pembayaran'],
            'sisa_tagihan'=>$data['sisa_tagihan'],
            'description'=>$data['description_piutang']
        ];
        $piutang->update($item);
        return redirect()->back()->with('message', 'Data Piutang Berhasil Di Edit!');
    }
    public function getAll(Piutang $piutang){
        return response()->json($piutang);
    }
}

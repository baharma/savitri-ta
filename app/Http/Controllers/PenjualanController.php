<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Piutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PenjualanController extends Controller
{
    protected $penjualan,$piutang;

    public function __construct(Penjualan $penjualan,Piutang $piutang)
    {
        $this->penjualan = $penjualan;
        $this->piutang = $piutang;
    }

    public function index(){

        $data = $this->penjualan->paginate(15)->fragment('users');
        return view('pages.penjualan.index-penjualan',compact('data'));
    }
    public function indexPiutang(){
        $data = $this->piutang->paginate(15)->fragment('users');
        return view('pages.piutang.index-piutang',compact('data'));
    }

    public function createPenjualan(Request $request){
        $data = $request->all();
        $randomNumber = rand();
        $fakturPenjualan = "FP" . $randomNumber;
        $dataPenjualan = [
            'user_id'=>Auth::user()->id,
            'tanggal_penjualan'=>$data['tanggal_penjualan'],
            'nama_barang'=>$data['nama_barang'],
            'jenis_barang'=>$data['jenis_barang'],
            'jumlah_barang'=>$data['jumlah_barang'],
            'jenis_pembayarang'=>$data['jenis_pembayarang'],
            'total_penjualan'=>$data['total_penjualan'],
            'description'=>$data['description_penjualan'],
            'faktur_penjualan'=>$fakturPenjualan,
            'harga_barang'=>$data['harga_barang']
        ];

        $dataCreatepenjualan = $this->penjualan->create($dataPenjualan);
        if($data['nama_Pelanggan']){
            $dataNoTransation = "NT" . $randomNumber ;
            $datapiutang = [
                'user_id'=>Auth::user()->id,
                'no_transaksi'=>$dataNoTransation,
                'piutang_id'=>$dataCreatepenjualan->id,
                'nama_Pelanggan'=>$data['nama_Pelanggan'],
                'alamat'=>$data['alamat_piutang'],
                'tgl_jatuh_tempo_piutang'=>$data['tgl_jatuh_tempo_piutang'],
                'total_tagihan'=>$data['total_tagihan'],
                'total_pembayaran'=>$data['total_pembayaran'],
                'status_pembayaran'=>$data['status_pembayaran'],
                'description'=>$data['description_piutang'],
                'sisa_tagihan'=>$data['sisa_tagihan']
            ];
            $this->piutang->create($datapiutang);
        }

        return redirect()->back()->with('message', 'Data Penjualan Berhasil Di Buat!');

    }

    public function deletePenjualan(Penjualan $penjualan){
        $penjualan->delete();
        return response()->json([
            'message' => 'Data success deleted !'
        ]);
    }

    public function editPenjualan(Penjualan $penjualan){
        try {
            return response()->json($penjualan);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }

}

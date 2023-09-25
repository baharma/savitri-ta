<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Piutang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        $data =  $this->penjualan->orderBy('created_at', 'asc')->paginate(10)->onEachSide(1);
        return view('pages.penjualan.index-penjualan',compact('data'));
    }


    public function createPenjualan(Request $request){

        try{

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

            if($request->nama_Pelanggan){
                $dataNoTransation = "NT" . $randomNumber ;
                $datapiutang = [
                    'user_id'=>Auth::user()->id,
                    'no_transaksi'=>$dataNoTransation,
                    'penjualan_id'=>$dataCreatepenjualan->id,
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
        }catch(Exception $e){
            Log::error('Error creating records: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating data.');
        }


    }

    public function deletePenjualan(Penjualan $penjualan){
        $penjualan->delete();
        return response()->json([
            'message' => 'Data success deleted !'
        ]);
    }

    public function editPenjualan(Penjualan $penjualan){
        try {
            $piutangs = $penjualan->piutangs->first();

            $dataJson = [
                'description' => $penjualan->description,
                'faktur_penjualan' => $penjualan->faktur_penjualan,
                'harga_barang' => $penjualan->harga_barang,
                'jenis_barang' => $penjualan->jenis_barang,
                'jenis_pembayarang' => $penjualan->jenis_pembayarang,
                'jumlah_barang' => $penjualan->jumlah_barang,
                'nama_barang' => $penjualan->nama_barang,
                'tanggal_penjualan' => $penjualan->tanggal_penjualan,
                'total_penjualan' => $penjualan->total_penjualan,
            ];

            if ($piutangs) {
                $dataJson += [
                    'no_transaksi' => $piutangs->no_transaksi,
                    'nama_Pelanggan' => $piutangs->nama_Pelanggan,
                    'alamat' => $piutangs->alamat,
                    'tgl_transaksi_piutang' => $piutangs->tgl_transaksi_piutang,
                    'tgl_jatuh_tempo_piutang' => $piutangs->tgl_jatuh_tempo_piutang,
                    'total_tagihan' => $piutangs->total_tagihan,
                    'total_pembayaran' => $piutangs->total_pembayaran,
                    'status_pembayaran' => $piutangs->status_pembayaran,
                    'description' => $piutangs->description,
                    'sisa_tagihan' => $piutangs->sisa_tagihan,
                ];
            }

            return response()->json($dataJson);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }


    public function updatePenjualan(Penjualan $penjualan,Request $request){
        try{
            $data = $request->all();
            $dataPenjualan = [
                'user_id'=>Auth::user()->id,
                'tanggal_penjualan'=>$data['tanggal_penjualan'],
                'nama_barang'=>$data['nama_barang'],
                'jenis_barang'=>$data['jenis_barang'],
                'jumlah_barang'=>$data['jumlah_barang'],
                'jenis_pembayarang'=>$data['jenis_pembayarang'],
                'total_penjualan'=>$data['total_penjualan'],
                'description'=>$data['description_penjualan'],
                'harga_barang'=>$data['harga_barang']
            ];
            $penjualan->update($dataPenjualan);
            if($data['nama_Pelanggan']){
                $datapiutang = [
                    'nama_Pelanggan'=>$data['nama_Pelanggan'],
                    'alamat'=>$data['alamat_piutang'],
                    'tgl_jatuh_tempo_piutang'=>$data['tgl_jatuh_tempo_piutang'],
                    'total_tagihan'=>$data['total_tagihan'],
                    'total_pembayaran'=>$data['total_pembayaran'],
                    'status_pembayaran'=>$data['status_pembayaran'],
                    'description'=>$data['description_piutang'],
                    'sisa_tagihan'=>$data['sisa_tagihan']
                ];
                $penjualan->piutangs->update($datapiutang);
            }
        }catch (\Exception $e) {
             dd($e);
        }
        return redirect()->back()->with('message', 'Data Update');
    }

    public function getAllPenjualan(){
        $data = $this->penjualan->paginate(5);
        return response()->json($data);
    }
}

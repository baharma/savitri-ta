<?php

namespace App\Http\Controllers;

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

        $item = [
            'user_id'=>Auth::user()->id,
            'jenis_bayar'=>$data['jenis_bayar'],
            'tanggal_pengeluran'=>$data['tanggal_pengeluran'],
            'jenis_pengeluaran'=>$data['jenis_pengeluaran'],
            'total_pengeluaran'=>$data['total_pengeluaran'],
            'descriptions'=>$data['description_penjualan']
        ];


        $this->modal->create($item);
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

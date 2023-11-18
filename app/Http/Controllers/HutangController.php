<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use Illuminate\Http\Request;

class HutangController extends Controller
{
    public $modal;

    public function __construct(Hutang $modal)
    {
        $this->modal = $modal;
    }

    public function index(Request $request){
        $query = $this->modal->orderBy('created_at', 'asc');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

            // Assuming the column storing the date is named 'date_column'
            $query->whereBetween('tgl_transaksi_hutang', [$start_date, $end_date]);
        }

        $data = $query->paginate(10)->onEachSide(1);

        return view('pages.hutang.hutang-index', compact('data'));
    }

    public function getAllShow(Hutang $hutang){
        return response()->json($hutang);
    }

    public function updateHutang(Hutang $hutang,Request $request){
        $data = $request->all();
        $item = [
            'tgl_transaksi_hutang'=>$data['tgl_transaksi_hutang'],
            'tgl_jatuh_tempo'=>$data['tgl_jatuh_tempo'],
            'total_transaksi_hutang'=>$data['total_transaksi_hutang'],
            'description_hutang'=>$data['description_hutang']
        ];
        $hutang->update($item);
        return redirect()->back()->with('message', 'Data Pengeluaran Berhasil Di Buat!');
    }

    public function deleteHutang(Hutang $hutang){
        $hutang->delete();
        return response()->json([ 'message' => 'Data success deleted !']);
    }


}

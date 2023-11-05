<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\BukuBesar;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;

class BukuBesarController extends Controller
{
    public $buku,$jurnal;

    public function __construct(BukuBesar $bukuBesar,JurnalUmum $jurnal)
    {
        $this->buku = $bukuBesar;
        $this->jurnal = $jurnal;
    }

    public function index(){
        $akun = Akun::all();
        $data = $this->buku->orderBy('created_at', 'asc')->paginate(10)->onEachSide(1);
        return view('pages.buku-besar.buku-besar-index',compact('data','akun'));
    }

    public function create(Request $request){

        $jurnalDate = $this->jurnal
        ->whereBetween('date', [$request->stard_date, $request->end_date])
        ->where('akun_id', $request->name_akun)
        ->orderBy('date')
        ->get();
        return view('pages.buku-besar.create-buku-besar',compact('jurnalDate'));
    }
}

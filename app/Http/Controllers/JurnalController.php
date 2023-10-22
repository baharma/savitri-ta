<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public $jurnal;

    public function __construct(JurnalUmum $jurnal)
    {
        $this->jurnal = $jurnal;
    }

    public function index(){
        $data = $this->jurnal->orderBy('created_at', 'asc')->paginate(10)->onEachSide(1);
        return view('pages.jurnal-umum.index-jurnal-umum',compact('data'));
    }
    public function search(Request $request){

    }
    public function add(Request $request){
        $count = $request->number;
        $jurnal = $this->jurnal;
        $data = range(1,$count);
        $akun = Akun::orderBy('created_at', 'asc')->get();
        $datajurnal = collect($data)->each(function($item){
            $this->jurnal->create(['kode_jurnal'=>'code']);
        });
        return view('pages.jurnal-umum.create-jurnal-umum',compact('datajurnal','akun'));
    }

    public function saveDelete(Request $request){

    }
}

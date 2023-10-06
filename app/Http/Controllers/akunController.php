<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class akunController extends Controller
{
    public $model;

    public function __construct(Akun $akun)
    {
        $this->model = $akun;
    }

    public function index(){
        $data = $this->model->orderBy('created_at', 'asc')->paginate(10)->onEachSide(1);
        return view('pages.akun.akun-index',compact('data'));
    }

    public function create(Request $request){
       $data = $request->all();
        $item = [
            'id_user'=>Auth::user()->id,
            'name_akun'=>$data['name_akun'],
            'kode_buku'=>$data['kode_buku'],
            'klasifikasi_akun'=>$data['klasifikasi_akun']
        ];

        $this->model->create($item);

        return redirect()->back()->with('message', 'Data Akun Berhasil Di Create!');
    }

    public function delete(Akun $akun){
        $akun->delete();
        return response()->json([
            'message' => 'Data success deleted !'
        ]);
    }

    public function update(Akun $akun,Request $request){
        $data = $request->all();

        $item = [
            'name_akun'=>$data['name_akun'],
            'kode_buku'=>$data['kode_buku'],
            'klasifikasi_akun'=>$data['klasifikasi_akun']
        ];
        $akun->update($item);

        return redirect()->back()->with('message', 'Data Akun Berhasil Di Edit!');
    }

    public function getAllAkun(Akun $akun){
        return response()->json($akun);
    }
}

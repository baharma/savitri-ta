<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\BukuBesar;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $dataBox = collect($jurnalDate)->map(function($item, $index) use ($jurnalDate) {
            $saldo = 0;
            if ($index === 0) {
                $saldo = 0;
            } else {
                $saldo = $jurnalDate->get($index - 1)['saldo'];
            }
            if ($item['kredit']) {
                $saldo -= $item['kredit'];
            } else {
                $saldo += $item['debit'];
            }
            $item['saldo'] = $saldo;
            return $item;
        });
        $akunShowName = $dataBox->first()->akunJurnal->name_akun;
        $saldoAkhir = $dataBox->last()->saldo;
        $bukuBesar = $this->buku->create([
            'id_user'=>Auth::user()->id,
            'akun_id'=>$request->name_akun
        ]);
        return view('pages.buku-besar.create-buku-besar',compact('dataBox','bukuBesar','akunShowName','saldoAkhir'));
    }

    public function createJurnalBuku(Request $request,BukuBesar $buku){

        $data = $request->all();
        $saveJurnal = collect($data)->map(function ($item) use ($buku) {
            $jurnal = $this->jurnal->find($item['id']);
            $buku->jurnal()->sync($jurnal, false);
        });
        return response()->json([ 'message' => 'Data success Add !']);
    }
    public function cancelSave(Request $request,BukuBesar $buku){
        $data = $request->all();
        $saveJurnal = collect($data)->map(function ($item) use ($buku) {
            $jurnal = $this->jurnal->find($item['id']);
            $buku->jurnal()->detach($jurnal);
        });
        return response()->json([ 'message' => 'Data success Add !']);
    }

    public function storeBukuBesar(Request $request,BukuBesar $buku){
        $data = $request->all();
        $buku->update($data);
        return to_route('buku-besar.index')->with('message', 'Data Buku Berhasil Di Create!');
    }

    public function getEdit(BukuBesar $buku){
        return response()->json($buku);
    }
    public function UpdateBuku(Request $request, BukuBesar $buku){
        $data = $request->all();
        $buku->update($data);
        return redirect()->back()->with('message', 'Data Buku Berhasil Di Update!');
    }
    public function deleteBuku(BukuBesar $buku) {
        $buku->jurnal()->detach();
        $buku->delete();
        return response()->json(['message' => 'Data successfully deleted!']);
    }
}

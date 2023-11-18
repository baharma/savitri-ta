<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalController extends Controller
{
    public $jurnal;

    public function __construct(JurnalUmum $jurnal)
    {
        $this->jurnal = $jurnal;
    }

    public function index(){
        $akun = Akun::all();
        $data = $this->jurnal->orderBy('created_at', 'asc')->paginate(10)->onEachSide(1);
        return view('pages.jurnal-umum.index-jurnal-umum',compact('data','akun'));
    }
    public function search(Request $request){

    }
    public function add(Request $request) {
        $count = $request->number;
        $jurnal = $this->jurnal;
        $data = range(1, $count);
        $akun = Akun::orderBy('created_at', 'asc')->get();
        $datajurnal = collect($data)->map(function ($item) use ($jurnal) {
            $createdJurnal = $jurnal->create([
                'kode_jurnal' => 'code',
                'user_id'=>Auth::user()->id,
            ]);
            return $this->jurnal->find($createdJurnal->id);
        });
        return view('pages.jurnal-umum.create-jurnal-umum', compact('datajurnal', 'akun'));
    }

    public function saveDelete(Request $request){
        $data = $request->all();
        dd($data);
        $saveMap = collect($data)->map(function ($item) {
            $model = $this->jurnal->find($item['id']);
            if ($item['kode_jurnal'] === null && $item['debit'] === null && $item['kredit'] === null) {
                $model->delete();
            } else {
                $model->update([
                    'date' => $item['date'],
                    'kode_jurnal' => $item['kode_jurnal'],
                    'akun_id' => $item['id_akuns'],
                    'debit' => $item['debit'],
                    'kredit' => $item['kredit'],
                    'description' => $item['description'],
                ]);
            }
        });

        return response()->json([
            'message' => 'Data successfully deleted!'
        ]);
    }

    public function deleteCancel(Request $request){
        $data = $request->all();
        $deleteAll = collect($data)->map(function($item){
            $model = $this->jurnal->find($item['id']);
            $model->delete();
        });
        return response()->json([
            'message' => 'Data successfully deleted!'
        ]);
    }

    public function deleteJurnal(JurnalUmum $jurnal){
        $jurnal->delete();
        return response()->json([
            'message' => 'Data successfully deleted!'
        ]);
    }

    public function getJurnalEdit(JurnalUmum $jurnal){
        return response()->json($jurnal);
    }

    public function updateJurnal(JurnalUmum $jurnal,Request $request){
        $jurnal->update($request->all());
        return redirect()->back()->with('message', 'Data Pengeluaran Berhasil Di Update!');
    }
}

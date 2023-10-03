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

    public function index(){

        $data = $this->modal->orderBy('created_at', 'asc')->paginate(10)->onEachSide(1);
        return view('pages.hutang.hutang-index',compact('data'));

    }

    public function getAllShow(Hutang $hutang){
        return response()->json($hutang);
    }

    public function updateHutang(Hutang $hutang,Request $request){

    }

    public function deleteHutang(Hutang $hutang){
        $hutang->delete();
        return response()->json([ 'message' => 'Data success deleted !']);
    }

}

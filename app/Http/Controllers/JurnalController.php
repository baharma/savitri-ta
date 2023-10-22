<?php

namespace App\Http\Controllers;

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
        $data = $this->jurnal;

        return view('pages.jurnal-umum.index-jurnal-umum',compact('data'));
    }
    public function search(Request $request){

    }
}

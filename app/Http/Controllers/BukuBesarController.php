<?php

namespace App\Http\Controllers;

use App\Models\BukuBesar;
use Illuminate\Http\Request;

class BukuBesarController extends Controller
{
    public $buku;

    public function __construct(BukuBesar $bukuBesar)
    {
        $this->buku = $bukuBesar;
    }

    public function index(){
        $data = $this->buku->orderBy('created_at', 'asc')->paginate(10)->onEachSide(1);
        return view('pages.buku-besar.buku-besar-index',compact('data'));
    }

    public function create(Request $request){

    }
}

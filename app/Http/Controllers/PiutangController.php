<?php

namespace App\Http\Controllers;

use App\Models\Piutang;
use Illuminate\Http\Request;

class PiutangController extends Controller
{
    private $piutang;
    public function __construct(Piutang $piutang)
    {
        $this->piutang = $piutang;
    }


    public function index(){
        $data = $this->piutang->orderBy('created_at', 'asc')->paginate(15);
        return view('pages.piutang.index-piutang',compact('data'));
    }
}

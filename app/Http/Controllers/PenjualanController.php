<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(){

        $data = Penjualan::paginate(15)->fragment('users');

        return view('pages.penjualan.index-penjualan',compact('data'));
    }
}

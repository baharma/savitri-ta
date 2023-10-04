<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class akunController extends Controller
{
    public $model;

    public function __construct(Akun $akun)
    {
        $this->model = $akun;
    }

    public function index(){
        $data = $this->model;
        return view('pages.akun.akun-index',compact('data'));
    }
}

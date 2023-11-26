<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class akunController extends Controller
{

    public function index()
    {
        return view('pages.akun.index', [
            'page_title' => 'Akun'
        ]);
    }

    public function getdata()
    {

        $data = Akun::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = '';
                $action .= '<div class="dropdown">';
                $action .= '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action Menu';
                $action .= '</button>';
                $action .= '<div class="dropdown-menu">';
                $action .= '<h6 class="dropdown-header tx-uppercase tx-12 tx-bold tx-inverse">Action Menu</h6>';
                $action .= '<a class="dropdown-item" href="' . route('akun.edit', $data->id) . '">Edit</a>';
                $action .= '<a class="dropdown-item text-danger delete-item" href="#" data-url="' . route('akun.delete', $data->id) . '">Hapus</a>';
                $action .= '</div>';
                $action .= '</div>';

                return $action;
            })
            ->editColumn('created_at', function ($data) {
                if ($data->created_at != null) {
                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at);
                    return $date->setTimezone('+8');
                }
            })
            ->toJson();
    }

    public function create()
    {
        $jenis = [
            ['kode' => 'AKTIVA_LANCAR', 'nama' => 'Aktiva Lancar'],
            ['kode' => 'AKTIVA_TETAP', 'nama' => 'Aktiva Tetap'],
            ['kode' => 'PASSIVA', 'nama' => 'Passiva'],
            ['kode' => 'MODAL_EKUITAS', 'nama' => 'Modal Ekuitas'],
        ];
        $data = null;
        return view('pages.akun.form', [
            'page_title' => 'Tambah Akun',
            'data' => $data,
            'jenis' => $jenis,
        ]);
    }
    public function edit($id)
    {
        $jenis = [
            ['kode' => 'AKTIVA_LANCAR', 'nama' => 'Aktiva Lancar'],
            ['kode' => 'AKTIVA_TETAP', 'nama' => 'Aktiva Tetap'],
            ['kode' => 'PASSIVA', 'nama' => 'Passiva'],
            ['kode' => 'MODAL_EKUITAS', 'nama' => 'Modal Ekuitas'],
        ];
        $data = Akun::find($id);
        return view('pages.akun.form', [
            'page_title' => 'Edit Akun',
            'jenis' => $jenis,
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $formdata = array(
                "id_user" => Auth::user()->id,
                "kode_buku" => $request->kode_buku,
                "name_akun" => $request->name_akun,
                "klasifikasi_akun" => $request->klasifikasi_akun,
                "jenis_akun" => $request->jenis_akun ?? null,
            );

            Akun::create($formdata);
            return redirect()->back()->with('message', 'Data Akun Berhasil Di Simpan !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        } catch (\Exception $th) {
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $formdata = array(
                "id_user" => Auth::user()->id,
                "kode_buku" => $request->kode_buku,
                "name_akun" => $request->name_akun,
                "klasifikasi_akun" => $request->klasifikasi_akun,
                "jenis_akun" => $request->jenis_akun ?? null,
            );

            Akun::whereId($id)->update($formdata);

            return redirect()->back()->with('message', 'Data Akun Berhasil Di Simpan !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        } catch (\Exception $th) {
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        }
    }



    public function delete($id)
    {
        Akun::whereId($id)->delete();
        return response()->json([
            'message' => 'Data success deleted !'
        ]);
    }
}

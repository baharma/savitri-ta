<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{

    public function index()
    {
        return view('pages.customer.index', [
            'page_title' => 'Pelanggan'
        ]);
    }

    public function getdata()
    {

        $data = Customer::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = '';
                $action .= '<div class="dropdown">';
                $action .= '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action Menu';
                $action .= '</button>';
                $action .= '<div class="dropdown-menu">';
                $action .= '<h6 class="dropdown-header tx-uppercase tx-12 tx-bold tx-inverse">Action Menu</h6>';
                $action .= '<a class="dropdown-item" href="' . route('customer.edit', $data->id) . '">Edit</a>';
                $action .= '<a class="dropdown-item text-danger delete-item" href="#" data-url="' . route('customer.delete', $data->id) . '">Hapus</a>';
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
        $data = null;
        return view('pages.customer.form', [
            'page_title' => 'Tambah Pelanggan',
            'data' => $data
        ]);
    }
    public function edit($id)
    {
        $data = Customer::find($id);
        return view('pages.customer.form', [
            'page_title' => 'Edit Pelanggan',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        try {
            $formdata = array(
                "name" => $request->name,
                "address" => $request->address,
                "is_allow_debt" => $request->is_allow_debt,
            );

            Customer::create($formdata);
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
                "name" => $request->name,
                "address" => $request->address,
                "is_allow_debt" => $request->is_allow_debt,
            );

            Customer::whereId($id)->update($formdata);

            return redirect()->back()->with('message', 'Data Akun Berhasil Di Simpan !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        } catch (\Exception $th) {
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        }
    }



    public function delete($id)
    {
        Customer::whereId($id)->delete();
        return response()->json([
            'message' => 'Data success deleted !'
        ]);
    }
}

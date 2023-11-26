<?php

namespace App\Http\Controllers;

use App\Helper\GenerateGL;
use App\Models\Akun;
use App\Models\Journal;
use App\Models\JournalItem;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JournalController extends Controller
{

    public function index()
    {
        return view('pages.journal.index', [
            'page_title' => 'Jurnal Umum'
        ]);
    }

    public function getdata()
    {

        $data = Journal::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $action = '';
                $action .= '<div class="dropdown">';
                $action .= '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action Menu';
                $action .= '</button>';
                $action .= '<div class="dropdown-menu">';
                $action .= '<h6 class="dropdown-header tx-uppercase tx-12 tx-bold tx-inverse">Action Menu</h6>';
                $action .= '<a class="dropdown-item" href="' . route('journal.edit', $data->id) . '">Edit</a>';
                $action .= '<a class="dropdown-item text-danger delete-item" href="#" data-url="' . route('journal.delete', $data->id) . '">Hapus</a>';
                $action .= '</div>';
                $action .= '</div>';

                return $action;
            })
            ->editColumn('nominal', function ($data) {
                return $this->currencyIDR($data->nominal);
            })
            ->editColumn('date', function ($data) {
                if ($data->date != null) {
                    $date = Carbon::parse($data->date)->format('Y-m-d');
                    return $date;
                }
            })
            ->toJson();
    }

    public function create()
    {
        $data = null;
        $code = GenerateGL::journal();
        $coa = Akun::all();
        return view('pages.journal.form', [
            'page_title' => 'Tambah Jurnal',
            'data' => $data,
            'code' => $code,
            'coa' => $coa,
        ]);
    }
    public function edit($id)
    {
        $data = Journal::whereId($id)->with('journalDetails')->first();
        $code = GenerateGL::journal();
        $coa = Akun::all();
        return view('pages.journal.edit', [
            'page_title' => 'Edit Jurnal',
            'data' => $data,
            'journal_details' => $data->journalDetails,
            'code' => $code,
            'coa' => $coa,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {


            $journal = array(
                'date' => $request->date,
                'description' => $request->description,
                'kode_jurnal' => GenerateGL::journal(),
                'nominal' => $request->nominal,
            );

            Journal::create($journal);
            $latest_journal = Journal::orderBy('created_at', 'DESC')->first();

            $items = $request->akun_id;

            foreach ($items as $key => $value) {
                JournalItem::insert([
                    'journal_id' => $latest_journal->id,
                    'user_id' => Auth::user()->id,
                    'debit' => floatval($request->debit[$key]),
                    'kredit' => floatval($request->kredit[$key]),
                    'akun_id' => $request->akun_id[$key],
                    'created_at' => $request->date,
                    'updated_at' => Carbon::now(),

                ]);
            }

            DB::commit();
            return redirect()->route('journal.index')->with('message', 'Data Akun Berhasil Di Simpan !');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        }
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $journal = array(
                'date' => $request->date,
                'description' => $request->description,
                'kode_jurnal' => $request->kode_jurnal ?? GenerateGL::journal(),
                'nominal' => $request->nominal,
            );

            Journal::whereId($id)->update($journal);

            $items = $request->akun_id;

            JournalItem::where('journal_id', $id)->delete();

            foreach ($items as $key => $value) {
                JournalItem::insert([
                    'journal_id' => $id,
                    'user_id' => Auth::user()->id,
                    'debit' => floatval($request->debit[$key]),
                    'kredit' => floatval($request->kredit[$key]),
                    'akun_id' => $request->akun_id[$key],
                    'updated_at' => Carbon::now(),
                ]);
            }

            DB::commit();

            return redirect()->route('journal.index')->with('message', 'Data Akun Berhasil Di Simpan !');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('message', 'Terjadi Kesalahan pada line' . ' ' . $th->getLine());
        }
    }



    public function delete($id)
    {
        Journal::whereId($id)->delete();
        JournalItem::where('journal_id', $id)->delete();
        return response()->json([
            'message' => 'Data success deleted !'
        ]);
    }
}

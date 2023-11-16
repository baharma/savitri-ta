@extends('layouts.apps')
@section('content')
<div class="card p-4">
    <h2>Laporan Pengeluaran</h2>

    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Periode Start</label>
                <input readonly type="date" class="form-control" value="{{$star}}" name="penjualan_start" id="exampleInputEmail1">

            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Periode End</label>
                <input readonly type="date" name="penjualan_end" value="{{$end}}" class="form-control" id="exampleInputEmail1"
                    >
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal Pengeluaran</th>
                <th scope="col">Jenis Pengeluaran</th>
                <th scope="col">Total Pengeluaran</th>
                <th scope="col">Jenis Bayar</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $datapengeluaran as $index=>$item)
            <tr>
                <th>{{$loop->iteration }}</th>
                <td>{{$item->tanggal_pengeluran}}</td>
                <td>{{$item->jenis_pengeluaran}}</td>
                <td>{{$item->total_pengeluaran}}</td>
                <td>{{$item->jenis_bayar}}</td>
                <td>{{$item->descriptions}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No Data Penjualan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex flex-row-reverse bd-highlight">
        <div class="p-2 bd-highlight">
            <form action="{{route('pdf-stream.pengeluaran')}}" method="POST">
                @csrf
                <input type="hidden" name="penjualan_end" value="{{$end}}" class="form-control" >
                <input type="hidden" class="form-control" value="{{$star}}" name="penjualan_start" >
                <button type="submit" class="btn btn-info">Pdf Print
                    <i class="bi bi-file-earmark-pdf-fill"></i>
                </button>
            </form>
        </div>
    </div>
@endsection

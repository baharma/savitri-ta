@extends('layouts.apps')
@section('content')
<div class="card p-4">
    <h2>Laporan Penjualan</h2>

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
                <th scope="col" style="font-size: 12px">No</th>
                <th scope="col" style="font-size: 12px">Faktur Penjualan</th>
                <th scope="col" style="font-size: 12px">Tanggal</th>
                <th scope="col" style="font-size: 12px">Nama Barang</th>
                <th scope="col" style="font-size: 12px">Jenis Barang</th>
                <th scope="col" style="font-size: 12px">Harga Barang</th>
                <th scope="col" style="font-size: 12px">Qty</th>
                <th scope="col" style="font-size: 12px">Total</th>
                <th scope="col" style="font-size: 12px">Jenis Pembayaran</th>
                <th scope="col" style="font-size: 12px">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataPenjualan as $index=>$item)
            <tr>
                <th>{{$loop->iteration }}</th>
                <td>{{$item->faktur_penjualan}}</td>
                <td>{{$item->tanggal_penjualan}}</td>
                <td>{{$item->nama_barang}}</td>
                <td>{{$item->jenis_barang}}</td>
                <td>Rp.{{number_format($item->harga_barang)}}</td>
                <td>{{$item->jumlah_barang}}</td>
                <td>Rp.{{number_format($item->total_penjualan)}}</td>
                <td>{{$item->jenis_pembayarang}}</td>
                <td>{{$item->description}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">No Data Penjualan</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex flex-row-reverse bd-highlight">
        <div class="p-2 bd-highlight">
            <form action="{{route('pdf-penjualan')}}" method="POST">
                @csrf
                <input type="hidden" name="penjualan_end" value="{{$end}}" class="form-control" >
                <input type="hidden" class="form-control" value="{{$star}}" name="penjualan_start" >
                <button type="submit" class="btn btn-info">Pdf Print
                    <i class="bi bi-file-earmark-pdf-fill"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

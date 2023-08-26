@extends('layouts.apps')

@section('content')

    <div class="container-fluid">
        <x-layout.add-modal-button >
            @slot('inputs')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticModalPenjualan">
                Tambah
              </button>
            @endslot
            @slot('input')
              <x-layout.input-groub />
            @endslot
        </x-layout.add-modal-button>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Faktur Penjualan</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jenis Barang</th>
                <th scope="col">Harga Barang</th>
                <th scope="col">Qty</th>
                <th scope="col">Total</th>
                <th scope="col">Jenis Pembayaran</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @forelse ( $data as $index=>$item)
                <tr>
                    <th>{{$loop->iteration }}</th>
                    <td>{{$item->faktur_penjualan}}</td>
                    <td>{{$item->tanggal_penjualan}}</td>
                    <td>{{$item->nama_barang}}</td>
                    <td>{{$item->jenis_barang}}</td>
                    <td>{{$item->harga_barang}}</td>
                    <td>{{$item->jumlah_barang}}</td>
                    <td>{{$item->total_penjualan}}</td>
                    <td>{{$item->description}}</td>
                    <td>

                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">No Data Penjualan</td>
                    </tr>
                @endforelse
            </tbody>
            {{ $data->links() }}
          </table>
    </div>
@endsection

@include('pages.component-boostrap.modal-penjualan')


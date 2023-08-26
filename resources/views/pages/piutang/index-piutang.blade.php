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
                <th scope="col">No Transaksi</th>
                <th scope="col">Nama Pelanggan</th>
                <th scope="col">Alamat</th>
                <th scope="col">Tanggal Transaksi Piutang</th>
                <th scope="col">Tanggal Jatuh Tempo Piutang</th>
                <th scope="col">Total Tagihan</th>
                <th scope="col">Total Pembayaran</th>
                <th scope="col">Status Pembayaran</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Sisa Tagihan</th>
                <th scope="col">Sisa Tagihan</th>
                <th scope="col">aksi</th>
              </tr>
            </thead>
            <tbody>
                @forelse ( $data as $index=>$item)
                <tr>
                    <th>{{$loop->iteration }}</th>
                    <td>{{$item->no_transaksi}}</td>
                    <td>{{$item->nama_Pelanggan}}</td>
                    <td>{{$item->alamat}}</td>
                    <td>{{$item->tgl_transaksi_piutang}}</td>
                    <td>{{$item->tgl_jatuh_tempo_piutang}}</td>
                    <td>{{$item->total_tagihan}}</td>
                    <td>{{$item->total_pembayaran}}</td>
                    <td>{{$item->status_pembayaran}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->sisa_tagihan}}</td>
                    <td></td>
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


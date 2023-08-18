@extends('layouts.apps')

@section('content')

    <div class="container-fluid">
        <x-layout.add-modal-button >
            @slot('inputs')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                @forelse ( $data as $item)
                <tr>
                    <th>{{$loop}}</th>
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

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
        <form action="" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col"> <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                          </div></div>
                          <div class="col"> <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                          </div></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </form>
    </div>
</div>

@extends('layouts.apps')

@section('content')
<h1>Tambah Transaksi Jurna Umum</h1>
<div class="d-flex justify-content-between">
    <form action="{{route('jurnal.search')}}" method="post">
        @csrf
        <div class="d-flex flex-row bd-highlight mb-3">
            <div class="p-2 bd-highlight">
                <label for="exampleInputEmail1" class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control" name="start-date" />
            </div>
            <div class="p-2 bd-highlight">
                <label for="exampleInputEmail1" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" name="end-date" />
            </div>
            <div class="p-2 bd-highlight pt-3">
                <button type="submit" class="btn btn-secondary mt-4">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddJurnal">
                <i class="bi bi-plus-square"></i> Create Jurnal Umum
            </button>
        </div>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Kode Jurnal </th>
            <th scope="col">Tanggal</th>
            <th scope="col">Kode Akun</th>
            <th scope="col">Nama Akun</th>
            <th scope="col">Debit</th>
            <th scope="col">Kredit</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
        <tr>
            <td>{{$loop->iteration }}</td>
            <td>{{$item->kode_jurnal ?? ''}}</td>
            <td>{{$item->date ?? ''}}</td>
            <td>{{$item->akunJurnal->kode_buku ?? ''}}</td>
            <td>{{$item->akunJurnal->name_akun ?? ''}}</td>
            <td>{{$item->debit ?? ''}}</td>
            <td>{{$item->kredit ?? ''}}</td>
            <td>{{$item->description ?? ''}}</td>
            <td>
                <a data-url="{{route('jurnal.delete',$item->id)}}" data-id="{{$item->id}}" class="btn btn-danger delete-item">
                    <i class="bi bi-trash"></i>
                </a>
                <a class="btn btn-info hutang" data-bs-toggle="modal" data-edit="" data-url="" data-id="{{$item->id}}"
                    data-bs-target="">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" class="text-center">No Data Penjualan</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="modal fade" id="modalAddJurnal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddJurnalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('jurnal.add')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Input Jumlah Jurnal</label>
                        <input type="number" class="form-control" id="exampleInputPassword1" name="number">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

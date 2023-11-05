@extends('layouts.apps')
@section('content')

<div class="d-flex flex-row-reverse bd-highlight">
    <div class="p-2 bd-highlight">
        <div class="">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddBukuBesar">
                <i class="bi bi-plus-square"></i> Create Buku Besar
            </button>
        </div>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Date </th>
            <th scope="col">Saldo</th>
            <th scope="col">Nama Akun</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
        <tr>
            <td>{{$loop->iteration }}</td>
            <td>{{$item->date ?? ''}}</td>
            <td>{{$item->description ?? ''}}</td>
            <td>{{$item->saldo ?? ''}}</td>
            <td>{{$item->akun->name_akun ?? ''}}</td>
            <td>
                <a data-url="{{route('jurnal.delete',$item->id)}}" data-id="{{$item->id}}" class="btn btn-danger delete-item">
                    <i class="bi bi-trash"></i>
                </a>
                <a class="btn btn-info edit-jurnal" data-bs-toggle="modal" data-edit="{{route('jurnal.update',$item->id)}}" data-url="{{route('jurnal.edit',$item->id)}}" data-id="{{$item->id}}"
                    data-bs-target="#modal-jurnal-edit">
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

@include('pages.component-boostrap.modal-buku-besar')

@endsection

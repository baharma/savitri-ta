@extends('layouts.apps')
@section('header-dasboard')
Buku Besar
@endsection
@section('content')
<div class="row">
    <form action="{{route('buku-besar.index')}}" class="col">
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
    <div class="d-flex flex-row-reverse bd-highlight col">
        <div class="p-2 bd-highlight">
            <div class="">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalAddBukuBesar">
                    <i class="bi bi-plus-square"></i> Create Buku Besar
                </button>
            </div>
        </div>
    </div>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Date </th>

            <th scope="col">Nama Akun</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Saldo</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
        <tr>
            <td>{{$loop->iteration }}</td>
            <td>{{$item->date ?? ''}}</td>
            <td>{{$item->akun->name_akun ?? ''}}</td>
            <td>{{$item->description ?? ''}}</td>
            <td>Rp.{{number_format($item->saldo) ?? ''}}</td>
            <td>
                <a data-url="{{route('delete-buku.buku-besar',$item->id)}}" data-id="{{$item->id}}"
                    class="btn btn-danger delete-item">
                    <i class="bi bi-trash"></i>
                </a>
                <a class="btn btn-info edit-buku" data-bs-toggle="modal" data-edit="{{route('get-buku',$item->id)}}"
                    data-url="{{route('buku-update',$item->id)}}" data-id="{{$item->id}}" data-bs-target="#modal-buku">
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
<nav aria-label="Page navigation example">
    <ul class="pagination">
        @if ($data->onFirstPage())
        <li class="page-item disabled"><span class="page-link">Previous</span></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $data->previousPageUrl() }}">Previous</a></li>
        @endif

        @for ($page = 1; $page <= $data->lastPage(); $page++)
            <li class="page-item {{ ($page == $data->currentPage()) ? 'active' : '' }}">
                <a class="page-link" href="{{ $data->url($page) }}">{{ $page }}</a>
            </li>
            @endfor
            @if ($data->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $data->nextPageUrl() }}">Next</a></li>
            @else
            <li class="page-item disabled"><span class="page-link">Next</span></li>
            @endif
    </ul>
</nav>
@include('pages.component-boostrap.modal-buku-besar')

@endsection

@push('script')
<script src="{{asset('js/main/buku-besar.js/buku-edit.js')}}"></script>
@endpush

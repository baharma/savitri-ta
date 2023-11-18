@extends('layouts.apps')
@section('header-dasboard')
Akun
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form action="{{route('akun.index')}}" class="col">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nama Akun"
                        aria-label="Recipient's username" aria-describedby="button-addon2" name="search">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                        <i class="bi bi-search"></i>
                        Search
                    </button>
                </div>
            </form>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <x-layout.add-modal-button>
                    @slot('inputs')
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#staticModalaAkun">
                        Tambah
                    </button>
                    @endslot
                    @slot('input')
                    @endslot
                </x-layout.add-modal-button>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Akun</th>
                <th scope="col">Nama Akun</th>
                <th scope="col">Klasifikasi Akun</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $data as $index=>$item)
            <tr>
                <th>{{$loop->iteration }}</th>
                <td>{{$item->kode_buku}}</td>
                <td>{{$item->name_akun}}</td>
                <td>{{$item->klasifikasi_akun}}</td>
                <td>
                    <a data-url="{{route('akun.delete',$item->id)}}" data-id="{{$item->id}}"
                        class="btn btn-danger delete-item">
                        <i class="bi bi-trash"></i>
                    </a>
                    <a class="btn btn-info edit-this-akun-modal" data-bs-toggle="modal"
                        data-edit="{{route('akun.all',$item->id)}}" data-url="{{route('akun.update',$item->id)}}"
                        data-id="{{$item->id}}" data-bs-target="#staticModalaAkunEdit">
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
</div>
@include('pages.component-boostrap.modal-akun')
@endsection

@push('script')
<script src="{{asset('js/main/akun/akun.js')}}"></script>
@endpush

@extends('layouts.apps')

@section('content')

<div class="container-fluid">
    <x-layout.add-modal-button>
        @slot('inputs')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticModalPengeluaran">
            Tambah
        </button>
        @endslot
        @slot('input')
        @endslot
    </x-layout.add-modal-button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">No Transaksi Hutang</th>
                <th scope="col">Tanggal Transaksi Hutang</th>
                <th scope="col">Tanggal Jatuh Tempo</th>
                <th scope="col">Total Transaksi Hutang</th>
                <th scope="col">Description</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $data as $index=>$item)
            <tr>
                <th>{{$loop->iteration }}</th>
                <td>{{$item->no_transaksi_hutang}}</td>
                <td>{{$item->tgl_transaksi_hutang}}</td>
                <td>{{$item->tgl_jatuh_tempo}}</td>
                <td>{{$item->total_transaksi_hutang}}</td>
                <td>{{$item->description}}</td>
                <td>
                    <a data-url="{{route('hutang.delete',$item->id)}}" data-id="{{$item->id}}"
                        class="btn btn-danger delete-item">
                        <i class="bi bi-trash"></i>
                    </a>
                    <a class="btn btn-info edit-this-modal" data-bs-toggle="modal" data-edit="{{route('getall.hutang',$item->id)}}" data-url="{{route('hutang.update',$item->id)}}" data-id="{{$item->id}}" data-bs-target="#staticModalPengeluaranedit" >
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
@endsection

@include('pages.component-boostrap.modal-pengeluaran')

@push('script')

@endpush

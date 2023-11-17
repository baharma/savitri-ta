@extends('layouts.apps')
@section('header-dasboard')
  Penjualan
@endsection
@section('content')

<div class="container-fluid">
    <x-layout.add-modal-button>
        @slot('inputs')
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticModalPenjualan">
            Tambah
        </button>
        @endslot
        @slot('input')
        @endslot
    </x-layout.add-modal-button>
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
                <td>Rp.{{number_format($item->harga_barang)}}</td>
                <td>{{$item->jumlah_barang}}</td>
                <td>Rp.{{number_format($item->total_penjualan)}}</td>
                <td>{{$item->jenis_pembayarang}}</td>
                <td>{{$item->description}}</td>
                <td>
                    <a data-url="{{route('penjualan.delete',$item->id)}}" data-id="{{$item->id}}"
                        class="btn btn-danger delete-item">
                        <i class="bi bi-trash"></i>
                    </a>
                    <a class="btn btn-info edit-this-modal" data-bs-toggle="modal" data-edit="{{route('penjualan.update',$item->id)}}" data-url="{{route('penjualan.edit',$item->id)}}" data-id="{{$item->id}}" data-bs-target="#staticModalPenjualanEdit" >
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">No Data Penjualan</td>
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

@include('pages.component-boostrap.modal-penjualan')

@push('script')
<script src="{{asset('js/main/transaksi/penjualan-interaktif.js')}}"></script>
<script src="{{asset('js/main/transaksi/penjualan-edit.js')}}"></script>
<script src="{{asset('js/main/transaksi/penjualan-view-all.js')}}"></script>
@endpush

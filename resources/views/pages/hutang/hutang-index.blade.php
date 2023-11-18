@extends('layouts.apps')
@section('header-dasboard')
  Hutang
@endsection
@section('content')

<div class="container-fluid">
    <form action="{{route('hutang.index')}}">
        <div class="d-flex flex-row bd-highlight mb-3">
            <div class="p-2 bd-highlight">
                <label for="exampleInputEmail1" class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control" name="start_date" />
            </div>
            <div class="p-2 bd-highlight">
                <label for="exampleInputEmail1" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" name="end_date" />
            </div>
            <div class="p-2 bd-highlight pt-3">
                <button type="submit" class="btn btn-secondary mt-4">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </form>
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
                <td>Rp.{{number_format($item->total_transaksi_hutang)}}</td>
                <td>{{$item->description}}</td>
                <td>
                    <a data-url="{{route('hutang.delete',$item->id)}}" data-id="{{$item->id}}"
                        class="btn btn-danger delete-item">
                        <i class="bi bi-trash"></i>
                    </a>
                    <a class="btn btn-info hutang" data-bs-toggle="modal" data-edit="{{route('getall.hutang',$item->id)}}" data-url="{{route('hutang.update',$item->id)}}" data-id="{{$item->id}}" data-bs-target="#staticModalHutangedit" >
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
    <script src="{{asset('js/main/pengeluaran/pengeluaran-interaksi.js')}}"></script>
@endpush

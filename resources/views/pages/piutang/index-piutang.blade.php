@extends('layouts.apps')
@section('header-dasboard')
  Piutang
@endsection
@section('content')

    <div class="container-fluid">
        <form action="{{route('piutang.index')}}" class="col">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Jenis Piutang"
                    aria-label="Recipient's username" aria-describedby="button-addon2" name="search">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                    <i class="bi bi-search"></i>
                    Search
                </button>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col" style="font-size: 12px">No</th>
                <th scope="col" style="font-size: 12px">No Transaksi</th>
                <th scope="col" style="font-size: 12px">Nama Pelanggan</th>
                <th scope="col" style="font-size: 12px">Alamat</th>
                <th scope="col" style="font-size: 10px">Tanggal Transaksi Piutang</th>
                <th scope="col" style="font-size: 10px">Tanggal Jatuh Tempo Piutang</th>
                <th scope="col" style="font-size: 12px">Total Tagihan</th>
                <th scope="col" style="font-size: 12px">Total Pembayaran</th>
                <th scope="col" style="font-size: 12px">Status Pembayaran</th>
                <th scope="col" style="font-size: 12px">Keterangan</th>
                <th scope="col" style="font-size: 12px">Sisa Tagihan</th>
                <th scope="col" style="font-size: 12px">aksi</th>
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
                    <td>Rp.{{number_format($item->total_tagihan)}}</td>
                    <td>Rp.{{number_format($item->total_pembayaran)}}</td>
                    <td>{{$item->status_pembayaran}}</td>
                    <td>{{$item->description}}</td>
                    <td>Rp.{{number_format($item->sisa_tagihan)}}</td>
                    <td>
                        <a data-url="{{route('delete.piutang',$item->id)}}" data-id="{{$item->id}}"
                            class="btn btn-danger delete-item">
                            <i class="bi bi-trash"></i>
                        </a>
                        <a class="btn btn-info edit-this-modal-piutang" data-bs-toggle="modal" data-edit="{{route('show.piutang',$item->id)}}" data-url="{{route('piutang.update',$item->id)}}" data-id="{{$item->id}}" data-bs-target="#staticModalPiutangEdit" >
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
            {{ $data->links() }}
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
@endpush


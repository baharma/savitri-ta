@extends('layouts.apps')
@section('header-dasboard')
  Buku Besar
@endsection
@section('content')

<div class="card p-4">

    <h3 class="p-4">Akun {{$akunShowName }}</h3>
    @foreach ($dataBox as $item )
    <form action="{{route('buku-besar.store')}}" class="save-all-jurnal" method="POST" id="update-form-buku-besar">
        @method("put")
        @csrf

        <div class="row">
            <div class="p-1 col">
                <input type="hidden" class="form-control" id="exampleInputEmail1" name="id" aria-describedby="emailHelp"
                    value="{{$item->id}}">
                <div class="">
                    @if ($loop->first)
                    <label for="exampleInputEmail1" class="form-label">Date</label>
                    @endif

                    <input type="date" class="form-control" id="exampleInputEmail1" name="date"
                        aria-describedby="emailHelp" value="{{$item->date}}" readonly>
                </div>
            </div>
            <div class="p-1 col">
                <div class="">
                    @if ($loop->first)
                    <label for="exampleInputEmail1" class="form-label">Debit</label>
                    @endif

                    <input type="number" class="form-control" id="exampleInputEmail1" name="debit"
                        aria-describedby="emailHelp" value="{{$item->debit}}" readonly>
                </div>
            </div>
            <div class="p-1 col">
                <div class="">
                    @if ($loop->first)
                    <label for="exampleInputEmail1" class="form-label">Kredit</label>
                    @endif

                    <input type="number" class="form-control" id="exampleInputEmail1" name="kredit"
                        aria-describedby="emailHelp" value="{{$item->kredit}}" readonly>
                </div>
            </div>
            <div class="p-1 col ">
                <div class="">
                    @if ($loop->first)
                    <label for="exampleInputEmail1" class="form-label">keterangan</label>
                    @endif

                    <input type="text" class="form-control" id="exampleInputEmail1" name="description"
                        aria-describedby="emailHelp" value="{{$item->description}}" readonly>
                </div>
            </div>
            <div class="p-1 col">
                <div class="">
                    @if ($loop->first)
                    <label for="exampleInputEmail1" class="form-label">Saldo</label>
                    @endif
                    <input type="number" class="form-control saldo-get" id="exampleInputEmail1" name="kredit"
                        aria-describedby="emailHelp" value="{{$item->saldo}}" >
                </div>
            </div>
        </div>
    </form>
    @endforeach
    <div class="d-flex justify-content-end">
        <div class="p-2 bd-highlight">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Saldo Akhir</label>
                <input type="number" class="form-control" id="saldo-akhir" name="kredit" value="{{$saldoAkhir}}" aria-describedby="emailHelp">
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">

        <button type="button" class="btn btn-primary" id="save-buku"
        data-push="{{route('buku-besar.update',$bukuBesar->id)}}"
        data-url="{{route('buku-besar.store-all',$bukuBesar->id)}}"
        data-bs-toggle="modal" data-bs-target="#exampleModal">
            Save Buku Besar
        </button>
    </div>
</div>


      <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close delete-all-syns-saldo" data-delete="{{route('buku-besar.delete-all',$bukuBesar->id)}}" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('buku-besar.store-all',$bukuBesar->id)}}" method="post">
                    @method('PUT')
                    @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Date</label>
                        <input type="date" class="form-control tanggalInput" name="date" aria-describedby="emailHelp" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Akun Name</label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp"  value="{{$bukuBesar->akun->name_akun}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp" name="description"  value="{{$bukuBesar->description}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Saldo</label>
                        <input type="text" class="form-control"  aria-describedby="emailHelp" name="saldo"  value="{{$saldoAkhir}}" id="saldo-modal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary delete-all-syns-saldo" data-bs-dismiss="modal" data-delete="{{route('buku-besar.delete-all',$bukuBesar->id)}}">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
<script src="{{asset('js/main/buku-besar.js/buku-besar.js')}}"></script>
@endpush

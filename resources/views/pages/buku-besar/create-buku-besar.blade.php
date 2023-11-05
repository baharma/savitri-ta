@extends('layouts.apps')
@section('content')


@foreach ($jurnalDate as  $item )
    <form action="{{route('buku-besar.store')}}" method="POST" id="update-form-buku-besar">
        @method("put")
        @csrf
        <h3>Akun : {{$item->akunJurnal->name_akun }}</h3>
        <div class="d-flex flex-row bd-highlight mb-3 p-2">
            <div class="p-2 bd-highlight">
                <input type="hidden" class="form-control" id="exampleInputEmail1" name="id"
                    aria-describedby="emailHelp" value="{{$item->id}}">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Date</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" name="date"
                        aria-describedby="emailHelp">
                </div>
            </div>

            <div class="p-2 bd-highlight">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Debit</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" name="debit"
                        aria-describedby="emailHelp">
                </div>
            </div>
            <div class="p-2 bd-highlight">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kredit</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" name="kredit"
                        aria-describedby="emailHelp">
                </div>
            </div>
            <div class="p-2 bd-highlight">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">keterangan</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="description"
                        aria-describedby="emailHelp">
                </div>
            </div>
            <div class="p-2 bd-highlight">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Saldo</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" name="kredit"
                        aria-describedby="emailHelp">
                </div>
            </div>
        </div>
    </form>
    @endforeach
@endsection

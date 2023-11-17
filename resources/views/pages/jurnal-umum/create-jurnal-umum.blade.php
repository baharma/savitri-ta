@extends('layouts.apps')
@section('content')
<div class="card p-2">
    <h2>Tambahkan Transaksi Jurnal Umum</h2>
    <div class="d-flex flex-column-reverse bd-highlight ">
        @foreach ($datajurnal as $item)
        <form  method="POST" enctype="multipart/form-data" class="form-jurnal">
            @csrf
            @method('put')
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
                        <label for="exampleInputEmail1" class="form-label">Kode Jurnal</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="kode_jurnal"
                            aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="p-2 bd-highlight">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kode Akun</label>
                        <select class="form-select" aria-label="Default select example" name="id_akuns">
                            @foreach ($akun as $item)
                            <option value="{{$item->id}}">{{$item->name_akun}}</option>
                            @endforeach
                        </select>
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
            </div>
        </form>
        @endforeach
    </div>
    <div class="">
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Total Debit</label>
                    <input type="number" class="form-control"  name="debit-hasil"
                        aria-describedby="emailHelp" id="hasil-debit"  readonly>
                </div>
            </div>
            <div class="p-2 bd-highlight">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Total Kredit</label>
                    <input type="number" class="form-control"  name="kredit" id="hasil-kredit"
                        aria-describedby="emailHelp" readonly>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <button type="submit" class="btn btn-primary save-get" id="save-get" data-url="{{route('jurnal-update.create')}}">Save</button>
            </div>
            <div class="p-2 bd-highlight">
                <button type="button" class="btn btn-danger" id="delete-jurnal-umum" >cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{asset('js/main/jurnal/intraksi-save.js')}}"></script>
@endpush

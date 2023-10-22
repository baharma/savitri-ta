@extends('layouts.apps')
@section('content')

<form action="" method="POST">
    @csrf
    <div class="card p-2">
        <h1>Tambahkan Transaksi Jurnal Umum</h1>
        <div class="d-flex flex-column-reverse bd-highlight ">
            @foreach ($datajurnal as $item)
            <div class="d-flex flex-row bd-highlight mb-3 p-2">
                <div class="p-2 bd-highlight">
                    <input type="hidden" class="form-control" id="exampleInputEmail1" name="id"
                    aria-describedby="emailHelp">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Date</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" name="date"
                            aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="p-2 bd-highlight">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kode Jurnal</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="kode_jurnal"
                            aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="p-2 bd-highlight">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kode Akun</label>
                        <select class="form-select" aria-label="Default select example">
                            @foreach ($akun as $item)
                            <option value="{{$item->id}}">{{$item->name_akun}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="p-2 bd-highlight">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Debit</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="debit"
                            aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="p-2 bd-highlight">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kredit</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="kredit"
                            aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="p-2 bd-highlight">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">keterangan</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="description"
                            aria-describedby="emailHelp">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Total Debit</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" name="description"
                        aria-describedby="emailHelp" disabled>
                </div>
            </div>
            <div class="p-2 bd-highlight">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Total Kredit</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" name="description"
                        aria-describedby="emailHelp" disabled>
                </div>
            </div>
        </div>

        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <div class="p-2 bd-highlight">
                <button type="button" class="btn btn-danger" id="delete-jurnal-umum">cancel</button>
            </div>
        </div>
    </div>

</form>

@endsection

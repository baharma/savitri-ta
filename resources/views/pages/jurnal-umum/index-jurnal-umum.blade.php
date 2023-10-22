@extends('layouts.apps')

@section('content')

<h1>Tambah Transaksi Jurna Umum</h1>

<div class="d-flex justify-content-between">
    <form action="{{route('jurnal.search')}}" method="post">
        @csrf
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
                <button type="submit" class="btn btn-secondary mt-4" >
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col">Flex item 1</div>
        <div class="col">Flex item 2</div>
        <div class="col">Flex item 3</div>
      </div>
</div>


<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Kode Jurnal </th>
        <th scope="col">Tanggal</th>
        <th scope="col">Kode Akun</th>
        <th scope="col">Nama Akun</th>
        <th scope="col">Debit</th>
        <th scope="col">Kredit</th>
        <th scope="col">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      {{-- <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr> --}}

    </tbody>
  </table>


@endsection

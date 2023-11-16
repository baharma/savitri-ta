@extends('layouts.apps')
@section('content')

<div class="card p-4">
    <h4 class="mb-4">Laporan Naraca</h4>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Periode Start</label>
                <input readonly type="date" class="form-control" value="{{$star}}" name="penjualan_start"
                    id="exampleInputEmail1">

            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Periode End</label>
                <input readonly type="date" name="penjualan_end" value="{{$end}}" class="form-control"
                    id="exampleInputEmail1">
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Akun</th>
                <th scope="col">Saldo</th>
                <th scope="col">Check</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th colspan="4">Activa</th>
            </tr>
            <form action="{{route('laba-RugiPdf')}}" id="activa-id" method="post">
                @csrf
                <input type="hidden" name="penjualan_end" value="{{$end}}" class="form-control" >
                <input type="hidden" class="form-control" value="{{$star}}" name="penjualan_start" >
                @foreach ($databukuBesar as $item)
                <tr>
                    <th scope="row">{{$loop->iteration }}</th>
                    <td>{{$item->akun->name_akun}}</td>
                    <td>{{$item->saldo}}</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="activa[]"
                                value="{{$item->id}}">
                        </div>
                    </td>
                </tr>
                @endforeach

            <tr>
                <th colspan="4">Passiva</th>
            </tr>

                @foreach ($databukuBesar as $item)
                <tr>
                    <th scope="row">{{$loop->iteration }}</th>
                    <td>{{$item->akun->name_akun}}</td>
                    <td>{{$item->saldo}}</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"  id="flexCheckChecked" name="passiva[]"
                                value="{{$item->id}}">
                        </div>
                    </td>
                </tr>
                @endforeach

        </tbody>
    </table>

    <div class="d-flex flex-row-reverse bd-highlight">
        <div class="p-2 bd-highlight">
                <button type="submit" class="btn btn-info" >Pdf Print
                    <i class="bi bi-file-earmark-pdf-fill"></i>
                </button>
        </div>
    </div>
</form>
</div>

@endsection

@push('script')
    <script src="{{asset('js/main/buku-besar.js/print-pdf-naraca.js')}}"></script>
@endpush

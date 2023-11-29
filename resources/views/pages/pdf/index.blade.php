@extends('layouts.apps')
@section('content')

<div class="card p-4">
    <h1 style="text-align: center">
        Laporan  Keuangan Toko Suci Lestari
    </h1>
    <div class="row">
        <div class="card col m-1">
            <i class="bi bi-file-earmark-fill text-center" style="font-size: 100px;"></i>
            <div class="card-body text-center">
              <h6>Laporan Penjualan</h6>
              <a href="{{route('sales.report.index')}}" class="btn btn-primary" >Cetak Laporan</a>
            </div>
          </div>

          <div class="card col m-1">
            <i class="bi bi-file-earmark-fill text-center" style="font-size: 100px;"></i>
            <div class="card-body text-center">
              <h6>Laporan Pengeluaran</h6>
              <a href="{{route('expense.report.index')}}" class="btn btn-primary">Cetak Laporan</a>
            </div>
          </div>

          <div class="card col m-1">
            <i class="bi bi-file-earmark-fill text-center" style="font-size: 100px;"></i>
            <div class="card-body text-center">
              <h6>Laporan Neraca</h6>
              <a href="{{route('balancesheet.index')}}" class="btn btn-primary">Cetak Laporan</a>
            </div>
          </div>
          <div class="card col m-1">
            <i class="bi bi-file-earmark-fill text-center" style="font-size: 100px;"></i>
            <div class="card-body text-center">
              <h6>Laporan Laba Rugi</h6>
              <a href="{{route('profitloss.index')}}" class="btn btn-primary">Cetak Laporan</a>
            </div>
          </div>
    </div>
</div>

@endsection

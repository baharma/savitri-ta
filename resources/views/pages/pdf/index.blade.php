@extends('layouts.apps')
@section('content')

<div class="card p-4">
    <h1 style="text-align: center">
        Laporan  Keuangan Toko Suci Lestari
    </h1>
    <div class="row">
        <div class="card col m-2" style="width: 18rem;">
            <i class="bi bi-file-earmark-fill" style="font-size: 150px;"></i>
            <div class="card-body">
              <h5 class="card-title">Laporan Penjualan</h5>
              <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPenjualan">Buat Laporan</a>
            </div>
          </div>

          <div class="card col m-2" style="width: 18rem;">
            <i class="bi bi-file-earmark-fill" style="font-size: 150px;"></i>
            <div class="card-body">
              <h5 class="card-title">Laporan Pengeluaran</h5>
              <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalpengeluaran">Buat Laporan</a>
            </div>
          </div>

          <div class="card col m-2" style="width: 18rem;">
            <i class="bi bi-file-earmark-fill" style="font-size: 150px;"></i>
            <div class="card-body">
              <h5 class="card-title">Laporan Neraca</h5>
              <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalnaraca">Buat Laporan</a>
            </div>
          </div>
          <div class="card col m-2" style="width: 18rem;">
            <i class="bi bi-file-earmark-fill" style="font-size: 150px;"></i>
            <div class="card-body">
              <h5 class="card-title">Laporan Laba Rugi</h5>
              <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modallabarugi">Buat Laporan</a>
            </div>
          </div>
    </div>
</div>

@include('pages.component-boostrap.modal-laporan')
@endsection

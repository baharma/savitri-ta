@extends('layouts.apps')
@section('content')

<div class="card p-4">
    <h1 style="text-align: center">
        Laporan  Keuangan Toko Suci Lestari
    </h1>
    <div class="row">
        <div class="col d-flex flex-column bd-highlight mb-3">
            <div class="p-4 bd-highlight" style="font-size: 20px; text-align: center">
                <i class="bi bi-file-earmark-pdf-fill" style="font-size: 150px;"></i>
                <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalPenjualan">
                    <h4>Laporan Penjualan</h4>
                </a>
            </div>
        </div>
        <div class="col d-flex flex-column bd-highlight mb-3">
            <div class="p-4 bd-highlight" style=" text-align: center">
                <i class="bi bi-file-earmark-pdf-fill" style="font-size: 150px;"></i>
                <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalpengeluaran">
                    <h4>Laporan Pengeluaran</h4>
                </a>
            </div>
        </div>
        <div class="col d-flex flex-column bd-highlight mb-3">
            <div class="p-4 bd-highlight" style="font-size: 20px; text-align: center">
                <i class="bi bi-file-earmark-pdf-fill" style="font-size: 150px;"></i>
                <a href="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalnaraca">
                    <h4>Laporan Neraca</h4>
                </a>
            </div>
        </div>
        <div class="col d-flex flex-column bd-highlight mb-3">
            <div class="p-4 bd-highlight" style="font-size: 20px; text-align: center">
                <i class="bi bi-file-earmark-pdf-fill" style="font-size: 150px;"></i>
                <a href="" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modallabarugi">
                    <h4>Laporan Laba Rugi</h4>
                </a>
            </div>
        </div>
    </div>
</div>

@include('pages.component-boostrap.modal-laporan')
@endsection

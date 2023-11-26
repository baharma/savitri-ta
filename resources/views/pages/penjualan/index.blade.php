@extends('layouts.apps')
@section('header-dasboard')
{{$page_title}}
@endsection
@section('content')

<div class="container-fluid">
    <div class="row row-xs">
        <div class="col-lg-12 col-xl-12 mg-t-5 mb-2">
            <a href="{{route('sales.create')}}" class="btn btn-primary float-right">Add Data {{$page_title}}</a>
        </div>
        <div class="col-lg-12 col-xl-12 mg-t-10">
            <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">List {{$page_title}}</h6>
                </div><!-- card-header -->
                <div class="card-body">
                    <table class="table datatable_category">
                        <thead>
                            <th>No Faktur</th>
                            <th>Nama Barang</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Pembayaran</th>
                            <th width="10%">Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div><!-- row -->
</div>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        var table = $('.datatable_category').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('sales.getdata') }}",
            columns: [{
                    data: 'faktur_penjualan',
                    name: 'faktur_penjualan' 
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'tanggal_penjualan',
                    name: 'tanggal_penjualan'
                },
                {
                    data: 'total_penjualan',
                    name: 'total_penjualan'
                },
                {
                    data: 'jenis_pembayarang',
                    name: 'jenis_pembayarang'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });

</script>
@endpush

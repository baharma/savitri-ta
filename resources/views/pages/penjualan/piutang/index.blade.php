@extends('layouts.apps')
@section('header-dasboard')
{{$page_title}}
@endsection
@section('breadcrumbs')
    @include('components.breadcrumbs', [
        'breadcrumbs' => [
            ['name' => $page_title, 'status'=> 1]
        ]
    ])
@endsection
@section('content')

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
                    <div class="table-responsive">
                        <table class="table datatable_category">
                        <thead>
                            <th>No Faktur</th>
                            <th>No Faktur Penjualan</th>
                            <th>Jatuh Tempo Pembayaran</th>
                            <th>Total Piutang</th>
                            <th>Total Pembayaran</th>
                            <th>Sisa Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th width="10%">Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    </div>
                    
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div><!-- row -->
@endsection

@push('script')
<script>
    $(document).ready(function () {
        var table = $('.datatable_category').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('receivable.getdata') }}",
            columns: [{
                    data: 'no_transaksi',
                    name: 'no_transaksi' 
                },
                {
                    data: 'no_faktur_penjualan',
                    name: 'no_faktur_penjualan' 
                },
                {
                    data: 'tgl_jatuh_tempo_piutang',
                    name: 'tgl_jatuh_tempo_piutang'
                },
                {
                    data: 'total_tagihan',
                    name: 'total_tagihan'
                },
                {
                    data: 'total_pembayaran',
                    name: 'total_pembayaran'
                },
                {
                    data: 'sisa_tagihan',
                    name: 'sisa_tagihan'
                },
                {
                    data: 'status_pembayaran',
                    name: 'status_pembayaran'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            createdRow: function (row, data, dataIndex) {
                // Tambahkan class 'overdue' jika melewati jatuh tempo atau hari ini jatuh tempo
                if (moment(data.tgl_jatuh_tempo_piutang).isSameOrBefore(moment(), 'day') && data.status_pembayaran == 'PENDING') {
                    $(row.childNodes[0]).addClass('bg-danger text-light');
                    console.log(row.childNodes);
                }
            }
        });

    });

</script>
@endpush

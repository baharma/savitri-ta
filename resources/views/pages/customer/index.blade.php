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
            <a href="{{route('customer.create')}}" class="btn btn-primary float-right">Add Data {{$page_title}}</a>
        </div>
        <div class="col-lg-12 col-xl-12 mg-t-10">
            <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">List {{$page_title}}</h6>
                </div><!-- card-header -->
                <div class="card-body">
                    <table class="table datatable_category">
                        <thead>
                            <th>Nama</th>
                            <th>Phone</th>
                            <th>Alamat</th>
                            <th>Izin Berhutang ?</th>
                            <th width="10%">Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
            ajax: "{{ route('customer.getdata') }}",
            columns: [{
                    data: 'name',
                    name: 'name' 
                },
                {
                    data: 'phone_number',
                    name: 'phone_number' 
                },
                {
                    data: 'address',
                    name: 'address' 
                },
                {
                    data: 'izin_berhutang',
                    name: 'izin_berhutang' 
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

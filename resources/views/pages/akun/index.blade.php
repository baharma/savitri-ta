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
            <a href="{{route('akun.create')}}" class="btn btn-primary float-right">Add Data {{$page_title}}</a>
        </div>
        <div class="col-lg-12 col-xl-12 mg-t-10">
            <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">List {{$page_title}}</h6>
                </div><!-- card-header -->
                <div class="card-body">
                    <table class="table datatable_category">
                        <thead>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jenis Akun</th>
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
            ajax: "{{ route('akun.getdata') }}",
            columns: [{
                    data: 'kode_buku',
                    name: 'kode_buku' 
                },
                {
                    data: 'name_akun',
                    name: 'name_akun'
                },
                {
                    data: 'klasifikasi_akun',
                    name: 'klasifikasi_akun'
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

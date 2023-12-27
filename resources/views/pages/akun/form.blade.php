@extends('layouts.apps')
@section('header-dasboard')
{{$page_title}}
@endsection

@section('breadcrumbs')
    @include('components.breadcrumbs', [
        'breadcrumbs' => [
            ['name' => 'COA', 'status'=> 0],
            ['name' => $page_title, 'status'=> 1]
        ]
    ])
@endsection

@section('content')
    <div class="row row-xs">
        <div class="col-lg-12 col-xl-6 mg-t-10">
            <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">Form {{$page_title}}</h6>
                </div><!-- card-header -->
                <div class="card-body">
                    <form data-parsley-validate
                        action="{{$data == null ? route('akun.store'):route('akun.update', $data->id)}}"
                        enctype="multipart/form-data" method="post">
                        @csrf
                        @if ($data != null)
                        @method('PUT')
                        @endif
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Kode : <span class="tx-danger">*</span></label>
                                <input type="text" name="kode_buku" value="{{$data->kode_buku ?? ''}}"
                                    class="form-control" placeholder="Enter Kode" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nama : <span class="tx-danger">*</span></label>
                                <input type="text" name="name_akun" value="{{$data->name_akun ?? ''}}"
                                    class="form-control" placeholder="Enter Nama" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Klasifikasi : <span class="tx-danger">*</span></label>
                                <input type="text" name="klasifikasi_akun" value="{{$data->klasifikasi_akun ?? ''}}"
                                    class="form-control" placeholder="Enter Klasifikasi" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Jenis Akun</label>
                                <select name="jenis_akun" id="" class="form-control">
                                    <option value="">--- Pilih Satu ---</option>
                                    @foreach ($jenis as $key => $value)
                                        <option value="{{$value['kode']}}" {{$data != null && $data->jenis_akun == $value['kode'] ? 'selected':''}}>{{$value['nama']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                </div><!-- card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>
            </div><!-- card -->
        </div>
    </div><!-- row -->
@endsection

@push('script')
<script src="{{asset('assets/lib/parsleyjs/parsley.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.dropify').dropify();
    });

</script>
@endpush

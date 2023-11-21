@extends('layouts.apps')
@section('header-dasboard')
{{$page_title}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row row-xs">
        <div class="col-lg-12 col-xl-6 mg-t-10">
            <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">Form {{$page_title}}</h6>
                </div><!-- card-header -->
                <div class="card-body">
                    <form data-parsley-validate
                        action="{{$data == null ? route('customer.store'):route('customer.update', $data->id)}}"
                        enctype="multipart/form-data" method="post">
                        @csrf
                        @if ($data != null)
                        @method('PUT')
                        @endif
                        <div class="row">
                            
                            <div class="form-group col-md-12">
                                <label>Nama : <span class="tx-danger">*</span></label>
                                <input type="text" name="name" value="{{$data->name ?? ''}}"
                                    class="form-control" placeholder="Enter Nama" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Alamat : <span class="tx-danger">*</span></label>
                                <input type="text" name="address" value="{{$data->address ?? ''}}"
                                    class="form-control" placeholder="Enter Alamat" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Izinkan Berhutang ?</label>
                                <select name="is_allow_debt" id="" class="form-control">
                                    <option value="1" {{isset($data) && $data->is_allow_debt == 1 ? 'selected':''}}>Iya</option>
                                    <option value="0" {{isset($data) && $data->is_allow_debt == 0 ? 'selected':''}}>Tidak</option>
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
</div>
@endsection

@push('script')
<script src="{{asset('assets/lib/parsleyjs/parsley.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.dropify').dropify();
    });

</script>
@endpush

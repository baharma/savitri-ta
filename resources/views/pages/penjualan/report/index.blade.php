@extends('layouts.apps')
@section('header-dasboard')
{{$page_title}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row row-xs">
        <div class="col-lg-12 col-xl-12 mg-t-10">
            <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">Pilih Rentang Waktu</h6>
                </div><!-- card-header -->
                <div class="card-body">
                    <form data-parsley-validate
                        action="{{route('sales.report.getdata')}}"
                        enctype="multipart/form-data" method="get">
                        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Tanggal Mulai : <span class="tx-danger">*</span></label>
                                <input type="date" name="start_date" value=""
                                    class="form-control" placeholder="Enter Tanggal Mulai" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Akhir : <span class="tx-danger">*</span></label>
                                <input type="date" name="end_date" value=""
                                    class="form-control" placeholder="Enter Tanggal Akhir" required>
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

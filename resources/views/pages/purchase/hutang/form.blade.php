@extends('layouts.apps')
@section('header-dasboard')
{{$page_title}}
@endsection
@section('breadcrumbs')
    @include('components.breadcrumbs', [
        'breadcrumbs' => [
            ['name' => 'Hutang', 'status'=> 0],
            ['name' => $page_title, 'status'=> 1]
        ]
    ])
@endsection

@section('content')


    <div class="row row-xs">
        <div class="col-lg-12 col-xl-12 mg-t-10">
            <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">Form {{$page_title}}</h6>
                </div><!-- card-header -->
                <div class="card-body">
                    <form data-parsley-validate
                        action="{{$data == null ? route('debt.store'):route('debt.update', $data->id)}}"
                        enctype="multipart/form-data" method="post">
                        @csrf
                        @if ($data != null)
                        @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-12" id="form_piutang">
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>Tanggal Hutang</label>
                                        <input type="date" name="tgl_transaksi_hutang"
                                            value="{{$data->tgl_transaksi_hutang ?? ''}}"
                                            class="form-control myDate">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Tanggal Jatuh Tempo</label>
                                        <input type="date" name="tgl_jatuh_tempo"
                                            value="{{$data->tgl_jatuh_tempo ?? ''}}" class="form-control myDate">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Total Tagihan</label>
                                        <input type="number" readonly id="total_tagihan" name="total_transaksi_hutang"
                                            value="{{$data->sisa_pembayaran ?? ''}}" class="form-control"
                                            placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Total Pembayaran</label>
                                        <input type="number" name="total_pembayaran"
                                            value="0"
                                            class="form-control total_pembayaran" id="total_bayar" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Sisa Pembayaran</label>
                                        <input type="number" readonly name="sisa_pembayaran"
                                            value="{{$data->sisa_pembayaran ?? ''}}"
                                            class="form-control sisa_tagihan" id="sisa_bayar" placeholder="">
                                    </div>

                                </div>
                            </div>
                        </div>




                </div><!-- card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary simpanData">Simpan Data</button>
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
        const currentDate = new Date().toISOString().split('T')[0];
        $('.myDate').val(currentDate);

        function hitungTotal() {
            // Ambil nilai qty dan price
            var total_bayar = $('#total_bayar').val();
            var total_price = $('#total_tagihan').val();


            // Hitung total
            var totalsemua = total_price - total_bayar

            // Tampilkan total di input dengan id "total"

            if(totalsemua < 0){
                alert('Pembayaran Tidak Boleh Lebih !')
                $('.simpanData').hide();
                $('#sisa_bayar').val(0);

            }else{
                $('.simpanData').show();
                $('#sisa_bayar').val(totalsemua);

            }

        }

        // Panggil fungsi hitungTotal saat nilai qty atau price berubah
        $('#qty, #price, #is_receivables, #total_bayar').on('input', function () {
            hitungTotal();
        });


        $('#is_receivables').change(function (e) {
            e.preventDefault();
            if ($(this).val() == 1) {
                $('#form_piutang').removeClass('d-none');
            } else {
                $('#form_piutang').addClass('d-none');
            }

        });

    });

</script>
@endpush

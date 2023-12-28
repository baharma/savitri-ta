@extends('layouts.apps')
@section('header-dasboard')
{{$page_title}}
@endsection
@section('breadcrumbs')
    @include('components.breadcrumbs', [
        'breadcrumbs' => [
            ['name' => 'Piutang', 'status'=> 0],
            ['name' => $page_title, 'status'=> 1],
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
                        action="{{$data == null ? route('receivable.store'):route('receivable.update', $data->id)}}"
                        enctype="multipart/form-data" method="post">
                        @csrf
                        @if ($data != null)
                        @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-12" id="form_piutang" >
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Nama Pelanggan</label>
                                        <select name="customer_id" disabled id="" class="form-control">
                                            @foreach ($customer as $item)
                                                @if ($data == null)
                                                   <option value="{{$item->id}}">{{$item->name}}</option> 
                                                @else
                                                @if ($data->receivables !=null)
                                                    <option value="{{$item->id}}" {{$data->customer_id == $item->id ? 'selected':''}}>{{$item->name}}</option> 
                                                @else
                                                    <option value="{{$item->id}}">{{$item->name}}</option> 
                                                @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                <label>Tanggal Piutang</label>
                                <input type="date" disabled name="tgl_transaksi_piutang" value="{{$data->tanggal_penjualan ?? \Carbon\Carbon::now()->format('Y-m-d')}}"
                                    class="form-control myDate">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Jatuh Tempo</label>
                                <input type="date" disabled name="tgl_jatuh_tempo_piutang" value="{{$data->tanggal_penjualan ?? \Carbon\Carbon::now()->format('Y-m-d')}}"
                                    class="form-control myDate">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Total Tagihan</label>
                                <input type="number" readonly name="total_tagihan" value="{{$data->sisa_tagihan ?? ''}}"
                                    class="form-control total_price" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Total Pembayaran</label>
                                <input type="number" name="total_pembayaran" value="{{$data->total_pembayaran ?? ''}}"
                                    class="form-control total_pembayaran" id="total_bayar" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Sisa Pembayaran</label>
                                <input type="number" readonly name="sisa_tagihan" value="{{$data->sisa_tagihan ?? ''}}"
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
            var total_price = $('.total_price').val();


            // Hitung total

            var totalsemua = total_price -  total_bayar

            // Tampilkan total di input dengan id "total"

             if(totalsemua < 0){
                $('#sisa_bayar').val(0);
                alert('Pembayaran tidak boleh minus !')
                $('.simpanData').hide();
            }else{
                $('.simpanData').show();
                $('#sisa_bayar').val(totalsemua);
            }

        }

        // Panggil fungsi hitungTotal saat nilai qty atau price berubah
        $('#qty, #price, #is_receivables, #total_bayar').on('input', function() {
            hitungTotal();
        });


        $('#is_receivables').change(function (e) { 
            e.preventDefault();
            if($(this).val() == 1){
                $('#form_piutang').removeClass('d-none');
            }else{
                $('#form_piutang').addClass('d-none');
            }
            
        });

    });

</script>
@endpush

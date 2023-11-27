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
                    <h6 class="mg-b-0">Form {{$page_title}}</h6>
                </div><!-- card-header -->
                <div class="card-body">
                    <form data-parsley-validate
                        action="{{$data == null ? route('purchase.store'):route('purchase.update', $data->id)}}"
                        enctype="multipart/form-data" method="post">
                        @csrf
                        @if ($data != null)
                        @method('PUT')
                        @endif
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Tanggal Pengeluaran</label>
                                <input type="date" name="tanggal_pengeluran" value="{{$data->tanggal_pengeluran ?? ''}}"
                                    class="form-control myDate" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Jenis Pengeluaran</label>
                                <input type="text" name="jenis_pengeluaran" value="{{$data->jenis_pengeluaran ?? ''}}"
                                    class="form-control" placeholder="Enter Jenis Pengeluaran" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Metode Pembayaran</label>
                                <select name="jenis_bayar" id="" class="form-control">
                                    <option value="CASH">Tunai</option>
                                    <option value="TRANSFER">Transfer</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>Total Pengeluaran</label>
                                <input type="number" name="total_pengeluaran" value="{{$data->total_pengeluaran ?? ''}}"
                                    class="form-control total_price" placeholder="" required>
                            </div>
                            <div class="form-group col-md-6">
                                        <label>COA</label>
                                        <select name="akun_id" id="" required class="form-control">
                                            @foreach ($coa as $item)
                                                @if ($data == null)
                                                   <option value="{{$item->id}}">{{$item->kode_buku}} - {{$item->name_akun}}</option> 
                                                @else
                                                    <option value="{{$item->id}}" {{$data->akun_id == $item->id ? 'selected':''}}>{{$item->kode_buku}} - {{$item->name_akun}}</option> 
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                            <div class="form-group col-md-12">
                                <label>Deskripsi</label>
                                <textarea name="description" id="" cols="10" rows="2" class="form-control">{{$data->description ?? ''}}</textarea>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ada Hutang ?</label>
                                <select name="is_debt" id="is_debt" class="form-control">
                                     @if ($data == null)
                                    <option value="0">Tidak</option>
                                    <option value="1">Iya</option>
                                    @else
                                    <option value="0" {{$data->is_debt == 0 ? 'selected':''}}>Tidak</option>
                                    <option value="1" {{$data->is_debt == 1 ? 'selected':''}}>Iya</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-12 {{isset($data) && $data->is_debt == 1 ? '':'d-none'}}" id="form_piutang" >
                                <div class="row">
                                    
                                    <div class="form-group col-md-6">
                                <label>Tanggal Hutang</label>
                                <input type="date" name="tgl_transaksi_hutang" value="{{$data->debt->tgl_transaksi_hutang ?? ''}}"
                                    class="form-control myDate">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Jatuh Tempo</label>
                                <input type="date" name="tgl_jatuh_tempo" value="{{$data->debt->tgl_jatuh_tempo ?? ''}}"
                                    class="form-control myDate">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Total Tagihan</label>
                                <input type="number" readonly id="total_tagihan" name="total_transaksi_hutang" value="{{$data->debt->total_transaksi_hutang ?? ''}}"
                                    class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Total Pembayaran</label>
                                <input type="number" name="total_pembayaran" value="{{$data->debt->total_pembayaran ?? ''}}"
                                    class="form-control total_pembayaran" id="total_bayar" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Sisa Pembayaran</label>
                                <input type="number" readonly name="sisa_pembayaran" value="{{$data->debt->sisa_pembayaran ?? ''}}"
                                    class="form-control sisa_tagihan" id="sisa_bayar" placeholder="">
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
        const currentDate = new Date().toISOString().split('T')[0];
        $('.myDate').val(currentDate);

        function hitungTotal() {
            var total_bayar = $('#total_bayar').val();
            var total_tagihan = $('.total_price').val();
            var totalsemua = total_tagihan -  total_bayar
            $('#sisa_bayar').val(totalsemua);
            $('#total_tagihan').val(total_tagihan);
        }

        // Panggil fungsi hitungTotal saat nilai qty atau price berubah
        $('#is_debt, #total_bayar, .total_price').on('input', function() {
            hitungTotal();
        });


        $('#is_debt').change(function (e) { 
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

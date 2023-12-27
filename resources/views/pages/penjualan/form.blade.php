@extends('layouts.apps')
@section('header-dasboard')
{{$page_title}}
@endsection
@section('breadcrumbs')
    @include('components.breadcrumbs', [
        'breadcrumbs' => [
            ['name' => 'Penjualan', 'status'=> 0],
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
                        action="{{$data == null ? route('sales.store'):route('sales.update', $data->id)}}"
                        enctype="multipart/form-data" method="post">
                        @csrf
                        @if ($data != null)
                        @method('PUT')
                        @endif
                        <div class="row">
                            @php
                                $date = Carbon\Carbon::now()->format('Y-m-d');
                            @endphp
                            <div class="form-group col-md-12">
                                <label>Tanggal Penjualan Barang</label>
                                <input type="date" name="tanggal_penjualan" value="{{$data->tanggal_penjualan ?? $date}}"
                                    class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_barang" value="{{$data->nama_barang ?? ''}}"
                                    class="form-control" placeholder="Enter Nama Barang" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Jenis Barang</label>
                                <input type="text" name="jenis_barang" value="{{$data->jenis_barang ?? ''}}"
                                    class="form-control" placeholder="Enter Jenis Barang" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Metode Pembayaran</label>
                                <select name="jenis_pembayarang" id="" class="form-control">
                                    <option value="CASH">Tunai</option>
                                    <option value="TRANSFER">Transfer</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Quantity</label>
                                <input type="number" id="qty" name="jumlah_barang" value="{{$data->jumlah_barang ?? ''}}"
                                    class="form-control" placeholder="Enter Qty" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Harga Barang</label>
                                <input type="number" id="price" name="harga_barang" value="{{$data->harga_barang ?? ''}}"
                                    class="form-control" placeholder="Enter Harga Barang" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Total Penjualan</label>
                                <input type="number" name="total_penjualan" value="{{$data->total_penjualan ?? ''}}"
                                    class="form-control total_price" placeholder="" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Deskripsi</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control">{{$data->description ?? ''}}</textarea>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ada Piutang ?</label>
                                <select name="is_receivables" id="is_receivables" class="form-control">
                                     @if ($data == null)
                                    <option value="0">Tidak</option>
                                    <option value="1">Iya</option>
                                    @else
                                    <option value="0" {{$data->is_receivables == 0 ? 'selected':''}}>Tidak</option>
                                    <option value="1" {{$data->is_receivables == 1 ? 'selected':''}}>Iya</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-12 {{isset($data) && $data->is_receivables == 1 ? '':'d-none'}}" id="form_piutang" >
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Nama Pelanggan</label>
                                        <select name="customer_id" id="" class="form-control">
                                            @foreach ($customer as $item)
                                                @if ($data == null)
                                                   <option value="{{$item->id}}">{{$item->name}}</option> 
                                                @else
                                                @if ($data->receivables !=null)
                                                    <option value="{{$item->id}}" {{$data->receivables->customer_id == $item->id ? 'selected':''}}>{{$item->name}}</option> 
                                                @else
                                                    <option value="{{$item->id}}">{{$item->name}}</option> 
                                                @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                <label>Tanggal Piutang</label>
                                <input type="date" name="tgl_transaksi_piutang" value="{{$data->receivables->tanggal_penjualan ?? \Carbon\Carbon::now()->format('Y-m-d')}}"
                                    class="form-control myDate">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Jatuh Tempo</label>
                                <input type="date" name="tgl_jatuh_tempo_piutang" value="{{$data->receivables->tanggal_penjualan ?? \Carbon\Carbon::now()->format('Y-m-d')}}"
                                    class="form-control myDate">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Total Tagihan</label>
                                <input type="number" readonly name="total_tagihan" value="{{$data->receivables->total_tagihan ?? ''}}"
                                    class="form-control total_price" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Uang Muka Tagihan</label>
                                <input type="number" name="total_pembayaran" value="{{$data->receivables->total_pembayaran ?? ''}}"
                                    class="form-control total_pembayaran" id="total_bayar" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Sisa Pembayaran</label>
                                <input type="number" name="sisa_tagihan" value="{{$data->receivables->sisa_tagihan ?? ''}}"
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

        function hitungTotal() {
            // Ambil nilai qty dan price
            var qty = $('#qty').val();
            var price = $('#price').val();
            var total_bayar = $('#total_bayar').val();

            // Hitung total
            var total = qty * price;
            var totalsemua = total -  total_bayar

            if(total < total_bayar){
                alert('Pembayaran tidak boleh minus !')
                $('.simpanData').hide();
            }else{
                $('.simpanData').show();
            }

            // Tampilkan total di input dengan id "total"
            $('.total_price').val(total);
            $('#sisa_bayar').val(totalsemua);

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

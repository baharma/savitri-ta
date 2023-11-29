<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{$page_title}}
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex">
        <div class="p-2 w-100  m-auto">
            <img src="https://cdn.discordapp.com/attachments/805750119655407616/1141965212312940564/WhatsApp_Image_2023-08-06_at_16.27.31.jpg"
                alt="" width="150px">
        </div>
        <div class="p-2 flex-shrink-1 m-auto">
            <h6>Toko Suci Lestari</h6>
            <p>Jl. Raya Batur, Kintamani Bangli, Bali</p>
        </div>
    </div>
    <div class="text-center">
        <h1>Laporan Penjualan</h1>
        <h6 class="mt-2 mb-5">Periode {{request()->input('start_date').' '.'s/d'.' '.request()->input('end_date')}}</h6>
    </div>
    <table class="table table-bordered border-dark align-middle table-striped">
        <thead>
            <th>No</th>
            <th>Faktur Penjualan</th>
            <th>Tanggal</th>
            <th>Nama Barang</th>
            <th>Jenis Barang</th>
            <th>Jenis Pembayaran</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Total</th>
        </thead>
        <tbody>
            @php
                $totals = 0;
            @endphp
            @foreach ($data as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->faktur_penjualan}}</td>
                    <td>{{$item->tanggal_penjualan}}</td>
                    <td>{{$item->nama_barang}}</td>
                    <td>{{$item->jenis_barang}}</td>
                    <td>{{$item->jenis_pembayarang}}</td>
                    <td>{{$item->jumlah_barang}}</td>
                    <td>{{'Rp.' . ' ' . number_format($item->harga_barang, 0, ',', '.')}}</td>
                    @php
                        $totals += $item->total_penjualan;
                    @endphp
                    <td>{{'Rp.' . ' ' . number_format($item->total_penjualan, 0, ',', '.')}}</td>
                   
                </tr>
            @endforeach
            <tr>
                <td colspan="8">Total Penjualan</td>
                <td>{{'Rp.' . ' ' . number_format($totals, 0, ',', '.')}} </td>
            </tr>
        </tbody>
       
    </table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>

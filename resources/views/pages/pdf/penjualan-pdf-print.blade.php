<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background-color: rgb(124, 124, 124);
            color: white;
            font-size: 12px;
            padding: 8px;
            text-align: left;
        }

        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div>
        <img src="https://cdn.discordapp.com/attachments/805750119655407616/1141965212312940564/WhatsApp_Image_2023-08-06_at_16.27.31.jpg" alt="" style="float: left;" width="150px">

        <div style="float: right;">
            <h2>Toko Suci Lestari</h2>
            <h3>Jl. Raya Batur, Kintamani Bangli, Bali</h3>
            <h2 >Laporan Penjualan</h2>
        </div>

        <div style="clear: both;"></div>
    </div>
    <hr style=" border: 1px solid black;">

    <h3>
        Periode : {{$star}} - {{$end}}
    </h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" style="border: 1px solid black; ">No</th>
                <th scope="col" style="border: 1px solid black; ">Faktur Penjualan</th>
                <th scope="col" style="border: 1px solid black; ">Tanggal</th>
                <th scope="col" style="border: 1px solid black; ">Nama Barang</th>
                <th scope="col" style="border: 1px solid black; ">Jenis Barang</th>
                <th scope="col" style="border: 1px solid black; ">Harga Barang</th>
                <th scope="col" style="border: 1px solid black; ">Qty</th>
                <th scope="col" style="border: 1px solid black; ">Total</th>
                <th scope="col" style="border: 1px solid black; ">Jenis Pembayaran</th>
                <th scope="col" style="border: 1px solid black; ">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataPenjualan as $index=>$item)
            <tr>
                <td style="border: 1px solid black; ">{{$loop->iteration }}</td>
                <td style="border: 1px solid black; ">{{$item->faktur_penjualan}}</td>
                <td style="border: 1px solid black; ">{{$item->tanggal_penjualan}}</td>
                <td style="border: 1px solid black; ">{{$item->nama_barang}}</td>
                <td style="border: 1px solid black; ">{{$item->jenis_barang}}</td>
                <td style="border: 1px solid black; ">{{$item->harga_barang}}</td>
                <td style="border: 1px solid black; ">{{$item->jumlah_barang}}</td>
                <td style="border: 1px solid black; "> {{$item->total_penjualan}}</td>
                <td style="border: 1px solid black; ">{{$item->jenis_pembayarang}}</td>
                <td style="border: 1px solid black; ">{{$item->description}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">No Data Penjualan</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>

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
        </div>

        <div style="clear: both;"></div>
    </div>
    <hr style=" border: 1px solid black;">
    <h2 style="text-align: center">Laporan Naraca</h2>
    <h3>
        Periode : {{$star}} - {{$end}}
    </h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" style="border: 1px solid black;font-size: 20px " >Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="" >Nama Akun</td>
                <td >Saldo</td>
            </tr>
            @forelse ($datapendapatan as $index=>$item)
            <tr>
                <td >{{$item->akun->name_akun}}</td>
                <td style="text-align: right;">Rp.{{number_format($item->saldo)}}</td>
            </tr>
            @empty

            @endforelse


            <tr>
                <th scope="col" style="" colspan="">Biaya</th>
            </tr>
            @forelse ($databiaya as $index=>$item)
            <tr>
                <td >{{$item->akun->name_akun}}</td>
                <td >Rp.{{number_format($item->saldo)}}</td>
            </tr>
            @empty

            @endforelse
            <tr>
                <td >Total Passiva</td>
                <td style="text-align: right;">Rp{{number_format($lababersih)}}</td>
            </tr>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
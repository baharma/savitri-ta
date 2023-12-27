<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Laba Rugi Periode {{request()->input('start_date').' '.'s/d'.' '.request()->input('end_date')}}
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
        <h1>Laporan Laba Rugi</h1>
        <h6 class="mt-2 mb-5">Periode {{request()->input('start_date').' '.'s/d'.' '.request()->input('end_date')}}</h6>
    </div>
    <table class="table table-bordered border-dark align-middle table-striped">
        <thead>
            <th colspan="2">Nama Akun</th>
            <th>Saldo</th>
            <th></th>
        </thead>
        <tbody>
            @php

            $pendapatan = $coa->where('klasifikasi_akun', 'Pendapatan')->first();
            $beban = $coa->where('klasifikasi_akun', 'Beban')->values();

            $totalPen = $data->where('coa.klasifikasi_akun', 'Pendapatan')->sum('kredit');
            $totalBeban = 0;
            @endphp
            <tr>
                <td colspan="4">{{$pendapatan->klasifikasi_akun}}</td>
            </tr>
            <tr>
                <td width="20%"></td>
                <td>{{$pendapatan->name_akun}}</td>
                <td>{{'Rp.' . ' ' . number_format($totalPen, 0, ',', '.')}}</td>
            </tr>
            <tr>
                <td colspan="3">Total Pendapatan</td>
                <td>{{'Rp.' . ' ' . number_format($totalPen, 0, ',', '.')}}</td>
            </tr>
            <tr>
                <td colspan="4">{{$beban->isNotEmpty() ? $beban[0]->klasifikasi_akun : ''}}</td>
            </tr>
            @foreach ($beban as $item)

            <tr>
                <td></td>
                <td>{{$item->name_akun}}</td>
                <td>
                    @php
                    $total = $data->where('akun_id', $item->id)->sum('debit');
                    $totalBeban += $total;
                    @endphp
                    {{'Rp.' . ' ' . number_format($total, 0, ',', '.')}}
                </td>
                <td></td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3">Total Beban</td>
                <td>{{'Rp.' . ' ' . number_format($totalBeban, 0, ',', '.')}}</td>
            </tr>
            <tr>
                <td colspan="3">Total Laba Bersih</td>
                <td>{{'Rp.' . ' ' . number_format($totalPen - $totalBeban, 0, ',', '.')}}</td>
            </tr>
        </tbody>
    </table>

    <table class="table w-100">
        <tbody>
            <tr>
                <td width="40%">
                    <table class="table table-bordered text-center">
                        <tbody>
                            <tr>
                                <td class="bg-dark text-light">Mengetahui</td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{asset('savitri.jpeg')}}" alt="" width="70%" height="150px">
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-dark text-light">Pemilik</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="10%"></td>
                <td width="10%"></td>
                <td width="40%">
                    <table class="table table-bordered text-center">
                        <tbody>
                            <tr>
                                <td class="bg-dark text-light">Mengetahui</td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{asset('pemilik.jpeg')}}" alt="" width="70%" height="150px">
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-dark text-light">Kasir</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
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

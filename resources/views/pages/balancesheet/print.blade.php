<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Neraca Saldo Periode {{request()->input('start_date').' '.'s/d'.' '.request()->input('end_date')}}
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        @media print {
            @page {
                size: landscape;
            }
        }

    </style>
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
        <h1>Laporan Neraca Saldo</h1>
        <h6 class="mt-2 mb-5">Periode {{request()->input('start_date').' '.'s/d'.' '.request()->input('end_date')}}</h6>
    </div>
    <table class="table table-borderless">
        <tbody>
            @php
                $totalAktiva = 0;
                $totalPassiva = 0;
            @endphp
            <tr>
                <td>
                   
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Aktiva Lancar</td>
                                <td></td>
                            </tr>
                            @foreach ($aktiva_lancar as $key => $val)
                            <tr>
                                <td>{{$val['nama_akun']}}</td>
                                @php
                                    $totalAktiva += $val['total'];
                                @endphp
                                <td>{{$val['total']}}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </td>
                <td>

                </td>
                <td>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Passiva</td>
                                <td></td>
                            </tr>
                            @foreach ($passiva as $key => $val)
                            <tr>
                                <td>{{$val['nama_akun']}}</td>
                                @php
                                    $totalPassiva += $val['total'];
                                @endphp
                                <td>{{$val['total']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            {{-- Row Ke dua --}}
            <tr>
                <td>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Aktiva Tetap</td>
                                <td></td>
                            </tr>
                            @foreach ($aktiva_tetap_val as $key => $val)
                            <tr>
                                <td>{{$val['nama_akun']}}</td>
                                @php
                                    $totalAktiva += $val['total'];
                                @endphp
                                <td>{{$val['total']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
                <td>

                </td>
                <td>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Modal Ekuitas</td>
                                <td></td>
                            </tr>
                            @foreach ($modal_ekuitas_val as $key => $val)
                            <tr>
                                <td>{{$val['nama_akun']}}</td>
                                @php
                                    $totalPassiva += $val['total']*-1;
                                @endphp
                                <td>{{$val['total'] * -1}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Total Aktiva</td>
                                <td>{{$totalAktiva}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td></td>
                <td>
                    <table class="table table-bordered">
                        <tbody>
                            
                            <tr>
                                <td>Total Passiva</td>
                                <td>{{$totalPassiva}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                
            </tr>
        </tbody>

    </table>

    <table class="table w-100">
        <tbody>
            <tr>
                <td>
                    <table class="table table-bordered text-center">
                        <tbody>
                            <tr>
                                <td class="bg-dark text-light">Mengetahui</td>
                            </tr>
                            <tr height="100px">
                                <td></td>
                            </tr>
                            <tr>
                                <td>Pemilik</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td></td>
                <td></td>
                <td>
                    <table class="table table-bordered text-center">
                        <tbody>
                            <tr>
                                <td class="bg-dark text-light">Mengetahui</td>
                            </tr>
                            <tr height="100px">
                                <td></td>
                            </tr>
                            <tr>
                                <td>Kasir</td>
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

    {{-- <script>
        window.onload = function () {
            window.print();
        };

    </script> --}}
</body>

</html>

@extends('layouts.apps')

@section('content')
<div class="container-fluid">

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class=" col mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Penjualan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$sales}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Piutang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$receivable ?? 0}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class=" col mb-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Pengeluaran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                {{$expense}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sign-out-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class=" col mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Laba Bersih</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{$profitloss ?? 0}}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-balance-scale-right fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-2">
            <div class="card shadow h-100">
                <div class="card-header">
                    Perhitungan Chart Per Bulan November
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card shadow h-70 py-2">
                <div class="card-header">
                    Penjualan Terakhir
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <th>#</th>
                            <th>Nomor Faktur</th>
                            <th>Nama Produk</th>
                            <th>Total Penjualan</th>
                            <th>Payment Method</th>
                        </thead>
                        <tbody>
                            @foreach ($datasales as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$item->faktur_penjualan}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->total_penjualan}}</td>
                                <td>{{$item->jenis_pembayarang}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
    </div>

</div>
<br>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk chart
    var data = {
        labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9',
            '10', '11', '12', '13', '14', '15', '16', '17', '18',
            '19', '20', '21', '22', '23', '24', '25', '26', '27',
            '28', '29', '30'
        ],
        datasets: [{
                label: 'Hutang',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255,99,132,1)',
                borderWidth: 1,
                data: [1000, 1200, 800, 1500, 900, 1100, 1300, 1000, 1200, 800, 1500, 900, 1100, 1300, 1000,
                    1200, 800, 1500, 900, 1100, 1300, 1000, 1200, 800, 1500, 900, 1100, 1300, 1000, 1200,
                    800
                ]
            },
            {
                label: 'Penjualan',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: [3000, 32000, 28000, 35000, 29000, 31000, 33000, 3000, 32000, 28000, 35000, 29000,
                    31000, 33000, 3000, 32000, 28000, 35000, 29000, 31000, 33000, 3000, 32000, 28000,
                    35000, 29000, 31000, 33000, 3000, 32000, 28000
                ]
            },
            {
                label: 'Piutang',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1,
                data: [40000, 42000, 38000, 45000, 39000, 41000, 43000, 40000, 42000, 38000, 45000,
                    39000, 41000, 43000, 40000, 42000, 38000, 45000, 39000, 41000, 43000, 40000,
                    42000, 38000, 45000, 39000, 41000, 43000, 40000, 42000, 38000
                ]
            }
        ]
    };


    // Pengaturan chart
    var options = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    // Membuat chart dengan menggunakan Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });

    // Contoh data, Anda perlu menggantinya dengan data yang sesuai
    var hutangData = [10000, 12000, 8000, 15000, 9000, 11000, 13000, 10000, 12000, 8000, 15000, 9000];
    var penjualanData = [20000, 22000, 18000, 25000, 19000, 21000, 23000, 20000, 22000, 18000, 25000, 19000];
    var piutangData = [15000, 17000, 12000, 18000, 14000, 16000, 18000, 15000, 17000, 12000, 18000, 14000];


    // Menetapkan data ke dalam chart
    // myChart.data.datasets[0].data = hutangData;
    // myChart.data.datasets[1].data = penjualanData;
    // myChart.data.datasets[2].data = piutangData;

    // Mengupdate chart
    myChart.update();

</script>
@endpush

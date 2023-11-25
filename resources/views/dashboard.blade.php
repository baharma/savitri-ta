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
        labels: [@foreach ($days as  $key => $item)'{{$item['day']}}', @endforeach],
        datasets: [{
                label: 'Hutang',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255,99,132,1)',
                borderWidth: 1,
                data: [ ]
            },
            {
                label: 'Penjualan',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: []
            },
            {
                label: 'Piutang',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1,
                data: [ ]
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
    var hutangData = [@foreach ($days as  $key => $item)'{{$item['hutang']}}', @endforeach];
    var penjualanData = [@foreach ($days as  $key => $item)'{{$item['penjualan']}}', @endforeach];
    var piutangData = [@foreach ($days as  $key => $item)'{{$item['piutang']}}', @endforeach];


    // Menetapkan data ke dalam chart
    myChart.data.datasets[0].data = hutangData;
    myChart.data.datasets[1].data = penjualanData;
    myChart.data.datasets[2].data = piutangData;

    // Mengupdate chart
    myChart.update();

</script>
@endpush

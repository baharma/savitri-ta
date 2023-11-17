@extends('layouts.apps')

@section('content')


<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class=" col mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Penjualan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp.{{number_format($penjualan->total_penjualan ?? 0)}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class=" col mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pengeluaran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                            {{number_format($pengeluaran->total_pengeluaran ?? 0)}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class=" col mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Laba Bersih</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp.{{number_format($laba->saldo ?? 0)}}</div>
                            </div>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card">
        <h4 class="p-3">Jumlah Penjualan 7 Hari Terakhir</h4>
        <canvas id="myBarChart" width="400" height="100"></canvas>
    </div>
</div>
@push('script')
<script>

let ctxs = document.getElementById('myBarChart').getContext('2d');

async function getChart() {
    try {

        const response = await axios.get('/chart-data');
        const responseData = response.data;


        const data = {
            labels: responseData.map(entry => entry.tanggal),
            datasets: [{
                label: 'Weekly Data',
                data: responseData.map(entry => entry.total_penjualan),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };


        const options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };


        const myBarChart = new Chart(ctxs, {
            type: 'bar',
            data: data,
            options: options
        });
    } catch (error) {
        console.error('Error fetching chart data:', error);
    }
}

// Panggil fungsi untuk membuat chart
getChart();
</script>
@endpush

@endsection

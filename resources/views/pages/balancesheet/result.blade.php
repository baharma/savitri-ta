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
                    <h6 class="mg-b-0">Periode <strong>{{request()->input('start_date')}}</strong> s/d <strong>{{request()->input('end_date')}}</strong></h6>
                </div><!-- card-header -->
                <div class="card-body">
                    
                    <table class="table table-bordered">
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
                                <td  width="20%"></td>
                                <td>{{$pendapatan->name_akun}}</td>
                                <td>{{$totalPen}}</td>
                            </tr>
                            <tr>
                                <td colspan="3">Total Pendapatan</td>
                                <td>{{$totalPen}}</td>
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
                                        {{$total ?? 0}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">Total Beban</td>
                                <td>{{$totalBeban}}</td>
                            </tr>
                            <tr>
                                <td colspan="3">Total Laba Bersih</td>
                                <td>{{$totalPen - $totalBeban}}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div><!-- card -->
        </div>
    </div><!-- row -->
</div>
@endsection

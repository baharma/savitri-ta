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
                    @foreach ($coa as $parent)
                        <p>Akun : {{$parent->name_akun}}</p>
                        <table class="table table-bordered">
                        <thead>
                            <th width="15%">Tanggal</th>
                            <th width="30%">Keterangan</th>
                            <th width="15%">Debet</th>
                            <th width="15%">Kredit</th>
                            <th width="20%">Saldo</th>
                        </thead>
                        <tbody>
                            @php
                                $totalsaldo = 0;

                                @endphp
                            @foreach ($data as $item)
                            @if ($parent->id == $item->akun_id)
                                
                                <tr>
                                    <td>{{Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</td>
                                    <td>{{$item->journal->description}}</td>
                                    <td>{{'Rp.' . ' ' . number_format($item->debit, 0, ',', '.')}}</td>
                                    <td>{{'Rp.' . ' ' . number_format($item->kredit, 0, ',', '.')}}</td>
                                    @php
                                    if($item->akun_id == 4 || $item->akun_id == 6 || $item->akun_id == 5 || $item->akun_id == 7 ){
                                        if($item->debit != 0){
                                            $totalsaldo += (-1 * $item->debit) + $item->kredit;
                                        }else{
                                            $totalsaldo += $item->kredit;
                                        }
                                        
                                    }else{
                                        $totalsaldo += $item->debit - $item->kredit;
                                    }
                                    
                                    @endphp
                                    <td>{{'Rp.' . ' ' . number_format($totalsaldo, 0, ',', '.')}}</td>
                                </tr>
                                
                            @endif
                            @endforeach

                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">Saldo Akhir</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{'Rp.' . ' ' . number_format($totalsaldo, 0, ',', '.')}}</td>
                            </tr>
                        </tfoot>
                    </table>
                    @endforeach
                    
                </div>
            </div><!-- card -->
        </div>
    </div><!-- row -->
</div>
@endsection

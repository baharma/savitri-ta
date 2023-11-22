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
                    <h6 class="mg-b-0">Form {{$page_title}}</h6>
                </div><!-- card-header -->
                <div class="card-body">
                    <form data-parsley-validate
                        action="{{$data == null ? route('journal.store'):route('journal.update', $data->id)}}"
                        enctype="multipart/form-data" method="post">
                        @csrf
                        @if ($data != null)
                        @method('PUT')
                        @endif
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Kode Jurnal</label>
                                <input type="text" name="kode_jurnal" readonly value="{{$data->kode_jurnal ?? $code}}"
                                    class="form-control" placeholder="Enter Kode" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Transaksi</label>
                                <input type="date" name="date" value="{{$data->date ?? Carbon\Carbon::now()->format('Y-m-d')}}"
                                    class="form-control" placeholder="Enter Kode" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Deskripsi</label>
                                <input type="text" name="description" value="{{$data->description ?? ''}}"
                                    class="form-control" value="" required>
                            </div>

                            <div class="col-md-12" id="apps">
                                 <button type="button" class="btn btn-dark float-right mb-3" @click="addItem">Tambah Transksi</button>
                                <table class="table table-bordered">
                                    <thead>
                                        <th>No</th>
                                        <th width="40%">Akun</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                        <th>#</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in items" :key="index">
                                        <td>
                                            @{{index+1}}
                                        </td>
                                        <td>
                                            <select name="akun_id[]" v-model="item.coa_id" class="form-control">
                                                <option v-for="option in options" :key="option.id" :value="option.id"> @{{option.kode_buku}} - @{{option.name_akun}}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="debit[]" id="" v-model="item.debit" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="kredit[]" id="" v-model="item.credit" class="form-control">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger"
                                        @click="removeItem(index)">Hapus</button>
                                        </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Total</td>
                                            <input type="hidden" name="nominal" v-model="totalDebit" id="">
                                            <td>@{{ formatCurrency(totalDebit) }}</td>
                                            <td>@{{ formatCurrency(totalCredit) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                        



                </div><!-- card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>
            </div><!-- card -->
        </div>
    </div><!-- row -->
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script>

        new Vue({
        el: '#apps',
        data: {
            index: 0,
            options:{!! $coa !!},
            items: [],
            newItem: {
            coa_id: null,
            debit: 0,
            credit: 0,
        },
            totalPrice: 0,
        },
        methods: {
            addItem() {
                this.items.push({
                id: this.index,
                coa_id: this.newItem.coa_id,
                debit: parseFloat(this.newItem.debit) || 0,
                credit: parseFloat(this.newItem.credit) || 0,
            });
                this.index++;
                // Reset newItem for the next entry
                this.newItem = {
                    coa_id: null,
                    debit: 0,
                    credit: 0,
                };
            },

            removeItem(index) {
                this.items.splice(index, 1);
            },

            formatCurrency(value) {
            // Check if value is a number
            if (typeof value !== 'number') {
                return value; // Return as is if not a number
            }

            // Format as currency with IDR symbol
            return value.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        },
            
            

        },
        computed:{
            totalDebit() {
                return this.items.reduce((sum, item) => sum + (parseFloat(item.debit) || 0), 0);
            },
            totalCredit() {
                return this.items.reduce((sum, item) => sum + (parseFloat(item.credit) || 0), 0);
            },

            
        },
        watch:{
            
        },
        mounted() {
            this.totalPrice = totalDebit(); 
             
        },
        beforeDestroy() {
        
        }
    });

</script>
@endpush

<form action="{{route('pengeluaran.create')}}" method="POST" enctype='multipart/form-data' >
    @csrf
<div class="modal fade" id="staticModalPengeluaran" data-bs-backdrop="static" style="z-index: 1050;" data-bs-keyboard="false" tabindex="-12"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Jenis Barang'" :idname="'jenis-bayar-id'" :type="'text'" :placeholder="'jenis_bayar'" :name="'jenis_bayar'"  />
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col">
                            <x-layout.input  :label="'Tanggal Pengeluaran'" :idname="'tanggal-pengeluran-id'" :type="'date'" :placeholder="'tanggal_pengeluaran'" :name="'tanggal_pengeluran'" />
                        </div>
                        <div class="col">
                            <x-layout.input  :label="'Jenis Pengeluaran'" :type="'text'" :idname="'jenis-pengeluaran-id'" :placeholder="'jenis_pengeluaran'" :name="'jenis_pengeluaran'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Total Pengeluaran'" :type="'number'" :placeholder="'Total Pengeluaran'" :idname="'total-pengeluaran-id'" :name="'total_pengeluaran'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input-large-groub label="Description" name="description_penjualan" :idname="'description-pengeluaran-id'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Tambah Hutang</p>
                            <x-layout.input-groub-button getId="pengeluaran-canvas" canvas="#offcanvashutang" />
                            <small>isi ini bagian trakhir!!</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Save</button>
                </div>
            </div>
    </div>
</div>
@include('pages.component-boostrap.canva-hutang')
</form>



<form action="" method="POST" enctype='multipart/form-data' id="modal-pengeluaran-edit" >
    @csrf
    @method('PUT')
<div class="modal fade" id="staticModalPengeluaranedit" data-bs-backdrop="static" style="z-index: 1050;" data-bs-keyboard="false" tabindex="-12"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Jenis Barang'" :idname="'jenis-bayar-id-edit'" :type="'text'" :placeholder="'jenis_bayar'" :name="'jenis_bayar'"  />
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col">
                            <x-layout.input  :label="'Tanggal Pengeluaran'" :idname="'tanggal-pengeluran-id-edit'" :type="'date'" :placeholder="'tanggal_pengeluaran'" :name="'tanggal_pengeluran'" />
                        </div>
                        <div class="col">
                            <x-layout.input  :label="'Jenis Pengeluaran'" :type="'text'" :idname="'jenis-pengeluaran-id-edit'" :placeholder="'jenis_pengeluaran'" :name="'jenis_pengeluaran'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Total Pengeluaran'" :type="'number'" :placeholder="'Total Pengeluaran'" :idname="'total-pengeluaran-id-edit'" :name="'total_pengeluaran'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input-large-groub label="Description" name="description_penjualan" :idname="'description-pengeluaran-id-edit'" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Save</button>
                </div>
            </div>
    </div>
</div>

</form>

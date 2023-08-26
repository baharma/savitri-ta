<form action="" method="POST">
    @csrf
<div class="modal fade" id="staticModalPenjualan" data-bs-backdrop="static" style="z-index: 1050;" data-bs-keyboard="false" tabindex="-12"
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
                            <x-layout.input  :label="'Nama Barang'" :type="'text'" :placeholder="'nama_barang'" :name="'nama_barang'" />
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col">
                            <x-layout.input  :label="'tanggal_penjualan'" :type="'date'" :placeholder="'Input Type Barang'" :name="'tanggal_penjualan'" />
                        </div>
                        <div class="col">
                            <x-layout.input  :label="'Jenis Barang'" :type="'text'" :placeholder="'Input Date'" :name="'jenis_barang'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Jumlah Barang'" :type="'text'" :placeholder="'Input Qty Barang'" :name="'jumlah_barang'" />
                        </div>
                        <div class="col">
                            <x-layout.input  :label="'Jenis Pembayaran'" :type="'text'" :placeholder="'Input type Pembayaran'" :name="'jenis_pembayarang'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Total Pembayaran'" :type="'text'" :placeholder="'Total bayaran'" :name="'total_penjualan'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input-large-groub label="Description" name="description" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Harga Pembayaran'" :type="'text'" :placeholder="'Harga Barang'" :name="'harga_barang'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input-groub-button getId="penjualan" canvas="#offcanvasPiutang" />
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
@include('pages.component-boostrap.canva-piutang')
</form>

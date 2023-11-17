<form action="{{route('penjualan.create')}}" method="POST" enctype='multipart/form-data' >
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
                            <x-layout.input  :label="'Nama Barang'" :idname="'name-barang-id'" :type="'text'" :placeholder="'nama_barang'" :name="'nama_barang'"  />
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col">
                            <x-layout.input  :label="'Tanggal Penjualan'" :idname="'tanggal-penjualan-id'" :type="'date'" :placeholder="'Input Type Barang'" :name="'tanggal_penjualan'" />
                        </div>
                        <div class="col">
                            <x-layout.input  :label="'Jenis Barang'" :type="'text'" :idname="'jenis-barang-id'" :placeholder="'Input Date'" :name="'jenis_barang'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Jumlah Barang'" :type="'number'" :idname="'jumlah-barang-id'" :placeholder="'Input Qty Barang'" :name="'jumlah_barang'" />
                        </div>
                        <div class="col">
                            <x-layout.input  :label="'Jenis Pembayaran'" :type="'text'" :idname="'jenis-pembayarang-id'" :placeholder="'Input type Pembayaran'" :name="'jenis_pembayarang'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Harga Pembayaran'" :type="'number'" :placeholder="'Harga Barang'" :idname="'harga-barang-id'" :name="'harga_barang'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input-large-groub label="Description" name="description_penjualan" :idname="'description-penjualan-id'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Total Pembayaran'" :type="'text'" :idname="'total-penjualan-id'" :placeholder="'Total bayaran'" :name="'total_penjualan'" />

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Tambah Piutang</label>
                            <x-layout.input-groub-button getId="penjualan" canvas="#offcanvasPiutang" />
                            <small>isi ini bagian trakhir</small>
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




<form action="" id="edit-update-penjualan" method="POST" enctype='multipart/form-data' data-url="" >
    @csrf
    @method('PUT')
<div class="modal fade" id="staticModalPenjualanEdit" data-bs-backdrop="static" style="z-index: 1050;" data-bs-keyboard="false" tabindex="-12"
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
                            <x-layout.input  :label="'Nama Barang'" :idname="'nama-barang-edit'" :type="'text'" :placeholder="'nama_barang'" :name="'nama_barang'" />
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col">
                            <x-layout.input  :label="'Tanggal Penjualan'" :idname="'tanggal-penjualan-edit'" :type="'date'" :placeholder="'Input Type Barang'" :name="'tanggal_penjualan'" />
                        </div>
                        <div class="col">
                            <x-layout.input  :label="'Jenis Barang'" :type="'text'" :idname="'jenis-barang-edit'" :placeholder="'Input Date'" :name="'jenis_barang'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Jumlah Barang'" :type="'text'" :placeholder="'Input Qty Barang'" :name="'jumlah_barang'" :idname="'jumlah-barang-edit'" />
                        </div>
                        <div class="col">
                            <x-layout.input  :label="'Jenis Pembayaran'" :type="'text'" :placeholder="'Input type Pembayaran'" :name="'jenis_pembayarang'" :idname="'jenis-pembayarang-edit'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Harga Pembayaran'" :type="'text'" :placeholder="'Harga Barang'" :name="'harga_barang'" :idname="'harga-barang-edit'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input-large-groub label="Description" name="description_penjualan" :idname="'description-penjualan-edit'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Total Pembayaran'" :type="'text'" :placeholder="'Total bayaran'" :name="'total_penjualan'" :idname="'total-penjualan-edit'" />
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


<form action="" method="POST" enctype='multipart/form-data' id="piutang-get">
    @csrf
    @method('PUT')
    <div class="modal fade" id="staticModalPiutangEdit" data-bs-backdrop="static" style="z-index: 1050;" data-bs-keyboard="false" tabindex="-12"
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
                            <x-layout.input  :label="'Nama Pelanggan'" :type="'text'" :idname="'nama-Pelanggan-id-edit'" :placeholder="'Nama Pelanggan'" :name="'nama_Pelanggan'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input-large-groub label="Alamat" name="alamat_piutang" :idname="'alamat-piutang-id-edit'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Tanggal Transaksi Piutang'" :type="'date'" :idname="'tgl-transaksi-piutang-id-edit'" :placeholder="'tgl_transaksi_piutang'" :name="'tgl_transaksi_piutang'" />
                        </div>
                        <div class="col">
                            <x-layout.input  :label="'Tanggal Jatuh Tempo Piutang'" :type="'date'" :idname="'tgl-jatuh-tempo-piutang-id-edit'" :placeholder="'tgl_jatuh_tempo_piutang'" :name="'tgl_jatuh_tempo_piutang'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Total Pembayaran'" :type="'text'" :placeholder="'total_pembayaran'" :idname="'total-pembayaran-id-edit'" :name="'total_pembayaran'" />
                        </div>
                        <div class="col">
                            <x-layout.input  :label="'Total Tagihan'" :type="'text'" :placeholder="'total_tagihan'" :name="'total_tagihan'" :idname="'total-tagihan-id-edit'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input  :label="'Status Pembayaran'" :type="'text'" :placeholder="'status_pembayaran'" :name="'status_pembayaran'" :idname="'status-pembayaran-id-edit'" />
                        </div>
                        <div class="col">
                            <x-layout.input  :label="'Sisa Tagihan'" :type="'text'" :placeholder="'sisa_tagihan'" :name="'sisa_tagihan'" :idname="'sisa-tagihan-id-edit'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input-large-groub label="Description" name="description_piutang" :idname="'description-piutang-id-edit'" />
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

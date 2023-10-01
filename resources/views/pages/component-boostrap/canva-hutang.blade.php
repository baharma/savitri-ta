<div class="offcanvas offcanvas-bottom" tabindex="-1" style="z-index: 1060;height: 90%;" id="offcanvashutang" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasBottomLabel">Offcanvas bottom</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small p-3">
            <div class="row">
                <div class="col">
                    <x-layout.input  :label="'Nama Pelanggan'" :type="'text'" :idname="'nama-Pelanggan-id'" :placeholder="'Nama Pelanggan'" :name="'nama_Pelanggan'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input-large-groub label="Alamat" name="alamat_piutang" :idname="'alamat-piutang-id'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input  :label="'Tanggal Transaksi Piutang'" :type="'date'" :idname="'tgl_transaksi_hutang'" :placeholder="'tgl_transaksi_piutang'" :name="'tgl_transaksi_hutang'" />
                </div>
                <div class="col">
                    <x-layout.input  :label="'Tanggal Jatuh Tempo Piutang'" :type="'date'" :idname="'tgl_jatuh_tempo'" :placeholder="'tgl_jatuh_tempo_piutang'" :name="'tgl_jatuh_tempo'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input  :label="'Total Pembayaran'" :type="'text'" :placeholder="'total_pembayaran'" :idname="'total_transaksi_hutang'" :name="'total_transaksi_hutang'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input  :label="'Status Pembayaran'" :type="'text'" :placeholder="'status_pembayaran'" :name="'status_pembayaran'" :idname="'status-pembayaran-id'" />
                </div>
                <div class="col">
                    <x-layout.input  :label="'Sisa Tagihan'" :type="'text'" :placeholder="'sisa_tagihan'" :name="'sisa_tagihan'" :idname="'sisa-tagihan-id'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input-large-groub label="Description" name="description_hutang" :idname="'description-hutang-id'" />
                </div>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary">Save</button>
    </div>
  </div>

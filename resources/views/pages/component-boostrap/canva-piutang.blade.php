<div class="offcanvas offcanvas-bottom" tabindex="-1" style="z-index: 1060;height: 90%;" id="offcanvasPiutang" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasBottomLabel">Offcanvas bottom</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small p-3">
            <div class="row">
                <div class="col">
                    <x-layout.input  :label="'Nama Pelanggan'" :type="'text'" :placeholder="'Nama Pelanggan'" :name="'nama_Pelanggan'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input-large-groub label="Alamat" name="alamat_piutang" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input  :label="'Tanggal Transaksi Piutang'" :type="'date'" :placeholder="'tgl_transaksi_piutang'" :name="'tgl_transaksi_piutang'" />
                </div>
                <div class="col">
                    <x-layout.input  :label="'Tanggal Jatuh Tempo Piutang'" :type="'date'" :placeholder="'tgl_jatuh_tempo_piutang'" :name="'tgl_jatuh_tempo_piutang'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input  :label="'Total Pembayaran'" :type="'text'" :placeholder="'total_pembayaran'" :name="'total_pembayaran'" />
                </div>
                <div class="col">
                    <x-layout.input  :label="'Total Tagihan'" :type="'text'" :placeholder="'total_tagihan'" :name="'total_tagihan'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input  :label="'Status Pembayaran'" :type="'text'" :placeholder="'status_pembayaran'" :name="'status_pembayaran'" />
                </div>
                <div class="col">
                    <x-layout.input  :label="'Sisa Tagihan'" :type="'text'" :placeholder="'sisa_tagihan'" :name="'sisa_tagihan'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input-large-groub label="Description" name="description_piutang" />
                </div>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary">Save</button>
    </div>
  </div>



  <div class="offcanvas offcanvas-bottom" tabindex="-1" style="z-index: 1060;height: 90%;" id="offcanvasPiutangEdit" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasBottomLabel">Offcanvas bottom</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small p-3">
            <div class="row">
                <div class="col">
                    <x-layout.input   :label="'Nama Pelanggan'" :type="'text'" :placeholder="'Nama Pelanggan'" :name="'nama_Pelanggan'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input-large-groub label="Alamat" name="alamat_piutang" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input  :label="'Tanggal Transaksi Piutang'" :type="'date'" :placeholder="'tgl_transaksi_piutang'" :name="'tgl_transaksi_piutang'" />
                </div>
                <div class="col">
                    <x-layout.input  :label="'Tanggal Jatuh Tempo Piutang'" :type="'date'" :placeholder="'tgl_jatuh_tempo_piutang'" :name="'tgl_jatuh_tempo_piutang'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input  :label="'Total Pembayaran'" :type="'text'" :placeholder="'total_pembayaran'" :name="'total_pembayaran'" />
                </div>
                <div class="col">
                    <x-layout.input  :label="'Total Tagihan'" :type="'text'" :placeholder="'total_tagihan'" :name="'total_tagihan'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input  :label="'Status Pembayaran'" :type="'text'" :placeholder="'status_pembayaran'" :name="'status_pembayaran'" />
                </div>
                <div class="col">
                    <x-layout.input  :label="'Sisa Tagihan'" :type="'text'" :placeholder="'sisa_tagihan'" :name="'sisa_tagihan'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input-large-groub label="Description" name="description_piutang" />
                </div>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="Submit" class="btn btn-primary">Save</button>
    </div>
  </div>

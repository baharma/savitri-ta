<div class="offcanvas offcanvas-bottom" tabindex="-1" style="z-index: 1060;height: 90%;" id="offcanvashutang" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small p-3">
            <div class="row">
                <div class="col">
                    <x-layout.input  :label="'Tanggal Transaksi Hutang'" :type="'date'" :idname="'tgl_transaksi_hutang'" :placeholder="'tgl_transaksi_piutang'" :name="'tgl_transaksi_hutang'" />
                </div>
                <div class="col">
                    <x-layout.input  :label="'Tanggal Jatuh Tempo'" :type="'date'" :idname="'tgl_jatuh_tempo'" :placeholder="'tgl_jatuh_tempo'" :name="'tgl_jatuh_tempo'" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-layout.input  :label="'Total Transaksi Hutang'" :type="'number'" :placeholder="'Total Transaksi Hutang'" :name="'total_transaksi_hutang'" :idname="'total_transaksi_hutang'" />
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

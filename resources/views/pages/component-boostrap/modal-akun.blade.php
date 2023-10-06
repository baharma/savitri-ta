<form action="{{route('akun.create')}}" method="POST" enctype='multipart/form-data' id="modal-pengeluaran-edit">
    @csrf
    <div class="modal fade" id="staticModalaAkun" data-bs-backdrop="static" style="z-index: 1050;"
        data-bs-keyboard="false" tabindex="-12" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <x-layout.input :label="'Name Buku'" :idname="'name_akun'" :type="'text'"
                                :placeholder="'Name Akun'" :name="'name_akun'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input :label="'Kode Buku'" :idname="'kode_buku'" :type="'text'"
                                :placeholder="'kode_buku'" :name="'kode_buku'" />
                        </div>
                        <div class="col">
                            <x-layout.input :label="'Klasifikasi Akun'" :type="'text'" :idname="'klasifikasi_akun'"
                                :placeholder="'klasifikasi_akun'" :name="'klasifikasi_akun'" />
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



<form action="" method="POST" enctype='multipart/form-data' id="modal-akun-edit">
    @csrf
    @method('PUT')
    <div class="modal fade" id="staticModalaAkunEdit" data-bs-backdrop="static" style="z-index: 1050;"
        data-bs-keyboard="false" tabindex="-12" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <x-layout.input :label="'Name Buku'" :idname="'name_akun-edit'" :type="'text'"
                                :placeholder="'Name Akun'" :name="'name_akun'" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-layout.input :label="'Kode Buku'" :idname="'kode_buku-edit'" :type="'text'"
                                :placeholder="'kode_buku'" :name="'kode_buku'" />
                        </div>
                        <div class="col">
                            <x-layout.input :label="'Klasifikasi Akun'" :type="'text'" :idname="'klasifikasi_akun-edit'"
                                :placeholder="'klasifikasi_akun'" :name="'klasifikasi_akun'" />
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

<div class="modal fade" id="modalPenjualan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('penjualan-between')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Periode Start</label>
                                <input type="date" class="form-control" name="penjualan_start" id="exampleInputEmail1">

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Periode End</label>
                                <input type="date" name="penjualan_end" class="form-control" id="exampleInputEmail1"
                                    >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalpengeluaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('pdf-view.pengeluaran')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Periode Start</label>
                                <input type="date" class="form-control" name="penjualan_start" id="exampleInputEmail1">

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Periode End</label>
                                <input type="date" name="penjualan_end" class="form-control" id="exampleInputEmail1"
                                    >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalnaraca" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('naraca.view-pdf')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Periode Start</label>
                                <input type="date" class="form-control" name="penjualan_start" id="exampleInputEmail1">

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Periode End</label>
                                <input type="date" name="penjualan_end" class="form-control" id="exampleInputEmail1"
                                    >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--
<div class="modal fade" id="modalPenjualan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('penjualan-between')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Periode Start</label>
                                <input type="date" class="form-control" name="penjualan_start" id="exampleInputEmail1">

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Periode End</label>
                                <input type="date" name="penjualan_end" class="form-control" id="exampleInputEmail1"
                                    >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

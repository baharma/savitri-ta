<div class="modal fade" id="modal-jurnal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="jurnal-edit-form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="p-2 bd-highlight">
                        <input type="hidden" class="form-control" id="exampleInputEmail1" name="id"
                            aria-describedby="emailHelp" value="{{$item->id}}">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="p-2 bd-highlight">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kode Jurnal</label>
                            <input type="text" class="form-control" id="kode_jurnal" name="kode_jurnal"
                                aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="p-2 bd-highlight">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kode Akun</label>
                            <select class="form-select" aria-label="Default select example" name="id_akun">
                                @foreach ($akun as $item)
                                <option value="{{$item->id}}">{{$item->name_akun}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="p-2 bd-highlight">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Debit</label>
                            <input type="number" class="form-control" id="debit" name="debit"
                                aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="p-2 bd-highlight">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kredit</label>
                            <input type="number" class="form-control" id="kredit" name="kredit"
                                aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="p-2 bd-highlight">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">keterangan</label>
                            <input type="text" class="form-control" id="description" name="description"
                                aria-describedby="emailHelp">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

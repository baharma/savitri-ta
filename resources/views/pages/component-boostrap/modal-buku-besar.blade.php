<div class="modal fade" id="modalAddBukuBesar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('buku-besar.create')}}" method="Post">
                @csrf
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="form-group m-2">
                        <label for="exampleInputEmail1">Start Date</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="stard_date">
                    </div>
                    <div class=" form-group m-2">
                        <label for=""> Select Akun</label>
                        <select class="form-select" aria-label="Large select example" name="name_akun">
                            @foreach ( $akun as $item )
                            <option value="{{$item->id}}">{{$item->name_akun}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group m-2">
                        <label for="exampleInputEmail1">End Date</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="end_date">
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
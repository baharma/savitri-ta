@extends('layouts.apps')
@section('header-dasboard')
User
@endsection
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="d-flex justify-content-between mt-3" style="margin-top: 40px">
    <div class="text-center " style="padding-top: 30px">
        <h4>{{Auth::user()->name}}</h4>
        <div class="btn btn-primary">Hak Akses : {{Auth::user()->role}}</div>
    </div>
    <div class="m-5 " >
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-plus-square"></i>
            Add User
        </button>
    </div>
</div>
<div class="p-2 card">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $users as $item )
            <tr>
                <th>{{$loop->iteration}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->fullname}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->role}}</td>
                <td>
                    <a data-url="{{route('userDelete',$item->id)}}" data-id="{{$item->id}}"
                        class="btn btn-danger delete-item">
                        <i class="bi bi-trash"></i>
                    </a>
                    <a class="btn btn-info edit-users" data-bs-toggle="modal" data-edit="{{route('username-getss',$item->id)}}"
                        data-url="{{route('update-pass',$item->id)}}" data-id="{{$item->id}}"
                        data-bs-target="#exampleModalEdit">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-lab="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('user.create-new')}}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Nama:</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="fullname" class="col-md-4 col-form-label text-md-right">Nama Lengkap:</label>

                    <div class="col-md-6">
                        <input id="fullname" type="text" class="form-control" name="fullname" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Role:</label>
                    <div class="col-md-6">
                        <select class="form-select" aria-label="Default select example" name="role">
                            <option value="pemilik">Pemilik</option>
                            <option value="kasir">Kasir</option>
                          </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Kata Sandi:</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Konfirmasi Kata Sandi:</label>

                    <div class="col-md-6">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>



  <!-- Modal -->
<div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-lab="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="" id="edit-User">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Nama:</label>

                    <div class="col-md-6">
                        <input id="name-id" type="text" class="form-control" name="name" required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="fullname" class="col-md-4 col-form-label text-md-right">Nama Lengkap:</label>

                    <div class="col-md-6">
                        <input id="fullname-id" type="text" class="form-control" name="fullname" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>

                    <div class="col-md-6">
                        <input id="email-id" type="email" class="form-control" name="email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Role:</label>
                    <div class="col-md-6">
                        <select class="form-select" aria-label="Default select example" name="role">
                            <option value="pemilik">Pemilik</option>
                            <option value="kasir">Kasir</option>
                          </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Kata Sandi:</label>

                    <div class="col-md-6">
                        <input id="password-id" type="password" class="form-control" name="password" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Konfirmasi Kata Sandi:</label>

                    <div class="col-md-6">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" >
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>


@endsection

@push('script')
  <script src="{{asset('js/main/akun/getuser.js')}}"></script>
@endpush

@extends('layouts.app-login')
@section('content')


<div class="vh-100 d-flex justify-content-center align-items-center ">
    <div class="card w-50 shadow-sm p-3 mb-5 bg-white rounded">
        <div class="card-body">
            <div class="text-center">
                <img src="{{asset('logo.jpeg')}}" width="200px" alt="" class="mb-3">
            </div>

            <form class="user" method="POST" action="{{ route('login') }}">
                @csrf
                <br>
                <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                        aria-describedby="email" name="email" placeholder="Enter a email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" name="password"
                        id="exampleInputPassword" placeholder="Enter a password">
                </div>
                <div class="text-center">
                    <button class="btn btn-primary btn-user w-50" type="submit">Login</button>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <style>

    </style>

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    @include('sweetalert::alert')
</head>

<body class="" style="
background-image: url('https://media.discordapp.net/attachments/1070973998634119248/1175321652100345876/WhatsApp_Image_2023-11-17_at_20.56.36_a768adb8.jpg?ex=656ace96&is=65585996&hm=9c091684f77d3e46ec242964770020efa5006ce9ca6f6df05c4771879e70bf72&=');
background-size: cover;
background-position: center;
backdrop-filter: blur(5px);
">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 ">

            @yield('content')

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    @include('sweetalert::alert')

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

</body>

</html>

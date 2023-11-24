     <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <div class="sidebar-brand-icon ">
                Suci Lestari
                <small>Busana Bali</small>
            </div>
            <div class="sidebar-brand-text mx-3"></div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('dashboard')}}">
                <i class="bi bi-house"></i>
                <span>Dashboard</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Interface
        </div>
        @if (Auth::user()->role == 'kasir')


        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="bi bi-wallet-fill"></i>
                <span>Data Transaksi</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data :</h6>
                    <a class="collapse-item" href="{{route('sales.index')}}">Penjualan</a>
                    <a class="collapse-item" href="{{route('purchase.index')}}">Pengeluaran</a>
                    <a class="collapse-item" href="{{route('hutang.index')}}">Hutang</a>
                    <a class="collapse-item" href="{{route('piutang.index')}}">Piutang</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">


        <li class="nav-item">
            <a class="nav-link" href="{{route('journal.index')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>Jurnal Umum</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('bigbook.index')}}">
                <i class="bi bi-book"></i>
                <span>Buku Besar</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('laporan')}}">
                <i class="bi bi-filetype-pdf"></i>
                <span>Laporan</span></a>
        </li>
                <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
                aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="bi bi-wallet-fill"></i>
                <span>Master Data</span>
            </a>
            <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('akun.index')}}">COA</a>
                    <a class="collapse-item" href="{{route('customer.index')}}">Pelanggan</a>
                    <a class="collapse-item" href="{{route('user.index')}}">User</a>
                </div>
            </div>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{route('laporan')}}">
                <i class="bi bi-filetype-pdf"></i>
                <span>Laporan</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
                aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="bi bi-wallet-fill"></i>
                <span>Master Data</span>
            </a>
            <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar2">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('user.index')}}">User</a>
                </div>
            </div>
        </li>

        @endif


    </ul>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Siap</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Asets
    </div>

    <!-- Nav Item - List Aset -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('aset.index') }}">
            <i class="fas fa-book"></i>
            <span>List Aset</span></a>
    </li>

    <!-- Nav Transaksi Aset -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('peminjaman.index') }}">
            <i class="fas fa-clipboard-list"></i>
            <span>Peminjaman Aset</span></a>
    </li>

    <!-- Nav Item - List Aset -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('laporan.index') }}">

            <i class="fas fa-poll"></i>
            <span>Laporan</span></a>
    </li>

    <!-- Nav Item - List Aset -->
    @can('isAdmin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="fas fa-users"></i>
                <span>Users</span></a>
        </li>
    @endcan


    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

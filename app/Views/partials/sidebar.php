<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/') ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Suci Store</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('/') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Barang -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('barang') ?>">
            <i class="fas fa-box"></i>
            <span>Barang</span>
        </a>
    </li>

    <!-- Pelanggan -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('pelanggan') ?>">
            <i class="fas fa-user-tag"></i>
            <span>Pelanggan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Transaksi -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('transaksi') ?>">
            <i class="fas fa-cash-register"></i>
            <span>Transaksi</span>
        </a>
    </li>

    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

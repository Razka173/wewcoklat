    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fab fa-weebly"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo 'wew coklat' ?></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?php if(strpos(strtolower($title),'administrator')){echo 'active';} ?>">
        <a class="nav-link" href="<?php echo base_url('admin/dasbor') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- MENU TRANSAKSI -->
      <li class="nav-item <?php if(strpos(strtolower($title),'transaksi')){echo 'active';} ?>">
        <a class="nav-link" href="<?php echo base_url('admin/transaksi') ?>">
          <i class="fa fa-fw fa-check"></i>
          <span>Transaksi</span></a>
      </li>

      <!-- MENU PRODUK -->
      <li class="nav-item <?php if(strpos(strtolower($title),'produk')){echo 'active';} ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduk" aria-expanded="true" aria-controls="collapseProduk">
          <i class="fas fa-fw fa-sitemap"></i>
          <span>Produk</span>
        </a>
        <div id="collapseProduk" class="collapse" aria-labelledby="headingProduk" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu:</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/produk') ?>"><i class="fas fa-fw fa-table"></i> Data Produk</a>
            <a class="collapse-item" href="<?php echo base_url('admin/produk/tambah') ?>"><i class="fas fa-fw fa-plus"></i> Tambah Produk</a>
            <a class="collapse-item" href="<?php echo base_url('admin/kategori') ?>"><i class="fas fa-fw fa-tags"></i> Kategori Produk</a>
          </div>
        </div>
      </li>

      <!-- MENU REKENING -->
      <li class="nav-item <?php if(strpos(strtolower($title),'rekening')){echo 'active';} ?>">
        <a class="nav-link" href="<?php echo base_url('admin/rekening') ?>">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Data Rekening</span></a>
      </li>

      <!-- MENU USER -->
      <li class="nav-item <?php if(strpos(strtolower($title),'pengguna')){echo 'active';} ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengguna" aria-expanded="true" aria-controls="collapsePengguna">
          <i class="fas fa-fw fa-lock"></i>
          <span>Pengguna</span>
        </a>
        <div id="collapsePengguna" class="collapse" aria-labelledby="headingPengguna" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu:</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/user') ?>"><i class="fas fa-fw fa-table"></i> Data Pengguna</a>
            <a class="collapse-item" href="<?php echo base_url('admin/user/tambah') ?>"><i class="fas fa-fw fa-plus"></i> Tambah Pengguna</a>
          </div>
        </div>
      </li>

      <!-- MENU KONFIGURASI -->
      <li class="nav-item <?php if(strpos(strtolower($title),'konfigurasi')){echo 'active';} ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKonfigurasi" aria-expanded="true" aria-controls="collapseKonfigurasi">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Konfigurasi</span>
        </a>
        <div id="collapseKonfigurasi" class="collapse" aria-labelledby="headingKonfigurasi" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu:</h6>
            <a class="collapse-item" href="<?php echo base_url('admin/konfigurasi') ?>"><i class="fas fa-fw fa-home"></i> Konfigurasi Umum</a>
            <a class="collapse-item" href="<?php echo base_url('admin/konfigurasi/logo') ?>"><i class="fas fa-fw fa-image"></i> Konfigurasi Logo</a>
            <a class="collapse-item" href="<?php echo base_url('admin/konfigurasi/icon') ?>"><i class="fas fa-fw fa-camera-retro"></i> Konfigurasi Icon</a>
            <a class="collapse-item" href="<?php echo base_url('admin/konfigurasi/slider_primary') ?>"><i class="fas fa-fw fa-chalkboard"></i> Konfigurasi Slider 1</a>
            <a class="collapse-item" href="<?php echo base_url('admin/konfigurasi/slider_secondary') ?>"><i class="fas fa-fw fa-chalkboard"></i> Konfigurasi Slider 2</a>
            <a class="collapse-item" href="<?php echo base_url('admin/konfigurasi/slider_other') ?>"><i class="fas fa-fw fa-chalkboard"></i> Konfigurasi Slider 3</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <!-- <hr class="sidebar-divider"> -->

      <!-- Heading -->
      <!-- <div class="sidebar-heading">
        Addons
      </div> -->

      <!-- Nav Item - Charts -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li> -->

      <!-- Nav Item - Tables -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li> -->

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
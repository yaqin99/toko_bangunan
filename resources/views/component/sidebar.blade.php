<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      {{-- <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i> --}}
      <a class="navbar-brand m-0" href="/" >
        {{-- <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo"> --}}
        <div class="d-flex justify-content-center">

          <span class="ms-1 font-weight-bold">PT. BSG BADAY SEJAHTERA</span>
        </div>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Data Penjualan Harian') ? 'active' : '' }}" href="/">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              {{-- <i class="ni ni-tv-2 "></i> --}}
              <i class="ni ni-shop text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Beranda</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Data Penjualan' || $title === 'Tambah Transaksi' || $title === 'Edit Detail Transaksi' || $title === 'Edit Penjualan') || $title === 'Tambah Detail Transaksi' ? 'active' : '' }} " href="/dataPenjualan">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-laptop text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Data Penjualan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Stok Barang' || $title === 'Detail Supply' || $title === 'Tambah Stok' || $title === 'Edit Stok') ? 'active' : '' }} " href="/stokBarang">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              {{-- <i class="ni ni-credit-card text-success text-sm opacity-10"></i> --}}
              <i class="ni ni-box-2 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Stok Barang</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Data Supply' || $title === 'Tambah Catatan' || $title === 'Edit Supply') ? 'active' : '' }} " href="/dataSupply">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Data Supply</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Rincian Hutang' || $title === 'Data Customer' || $title === 'Tambah Customer' || $title === 'Edit Customer' || $title === 'Detail Customer') ? 'active' : '' }}" href="/dataCustomers">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              {{-- <i class="ni ni-app text-info text-sm opacity-10"></i> --}}
              <i class="ni ni-circle-08 text-dark text-sm opacity-10"></i>
            </div>
            <div class="d-flex align-items-center">
              
              <span class="nav-link-text ms-1">Data Customer</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Data Rekap' || $title === 'Cetak Hutang') ? 'active' : '' }}" href="/dataRekap">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-chart-pie-35 text-dark text-sm opacity-10"></i>
            </div>
            <div class="d-flex align-items-center">
              
              <span class="nav-link-text ms-1">Rekap Data</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Data Rekap' || $title === 'Cetak Hutang') ? 'active' : '' }}" href="/datazakatPajak">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-chart-pie-35 text-dark text-sm opacity-10"></i>
            </div>
            <div class="d-flex align-items-center">
              
              <span class="nav-link-text ms-1">Pajak dan Zakat</span>
            </div>
          </a>
        </li>
       
        
        
      
       
      </ul>
    </div>
    
  </aside>
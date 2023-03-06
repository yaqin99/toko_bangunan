<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      {{-- <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i> --}}
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        {{-- <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo"> --}}
        <span class="ms-1 font-weight-bold">PT. BADAY SEJAHTERA GROUP</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Data Penjualan Harian') ? 'active' : '' }}" href="/">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              {{-- <i class="ni ni-tv-2 "></i> --}}
              <i class="bi bi-house-door-fill text-primary text-lg opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Beranda</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Data Penjualan' || $title === 'Tambah Transaksi' || $title === 'Edit Detail Transaksi' || $title === 'Edit Penjualan') || $title === 'Tambah Detail Transaksi' ? 'active' : '' }} " href="/dataPenjualan">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-currency-dollar text-warning text-lg opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Data Penjualan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Stok Barang' || $title === 'Detail Supply' || $title === 'Tambah Stok' || $title === 'Edit Stok') ? 'active' : '' }} " href="/stokBarang">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              {{-- <i class="ni ni-credit-card text-success text-sm opacity-10"></i> --}}
              <i class="bi bi-card-checklist text-success text-lg opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Stok Barang</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Data Supply' || $title === 'Tambah Catatan' || $title === 'Edit Supply') ? 'active' : '' }} " href="/dataSupply">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="bi bi-box text-warning text-lg opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Data Supply</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Data Hutang' || $title === 'Tambah Hutang' || $title === 'Edit Hutang') ? 'active' : '' }}" href="/dataHutang">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              {{-- <i class="ni ni-app text-info text-sm opacity-10"></i> --}}
              <i class="bi bi-person-vcard-fill text-info text-lg opacity-10"></i>
            </div>
            <div class="d-flex align-items-center">
              
              <span class="nav-link-text ms-1">Data Hutang</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Rincian Hutang' || $title === 'Data Customer' || $title === 'Tambah Customer' || $title === 'Edit Customer' || $title === 'Detail Customer') ? 'active' : '' }}" href="/dataCustomers">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              {{-- <i class="ni ni-app text-info text-sm opacity-10"></i> --}}
              <i class="bi bi-person-fill text-success text-lg opacity-10"></i>
            </div>
            <div class="d-flex align-items-center">
              
              <span class="nav-link-text ms-1">Data Customer</span>
            </div>
          </a>
        </li>
        
        
      
       
      </ul>
    </div>
    
  </aside>
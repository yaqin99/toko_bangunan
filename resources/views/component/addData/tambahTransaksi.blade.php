
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <title>
    Tambah Transaksi
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
@include('component.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        {{-- <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
        </nav> --}}
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            
              {{-- <form action="/dataPenjualan" method="GET">
              <input type="text" class="form-control" name="searchTransaksi"  placeholder="Cari ..." value="{{ request('searchTransaksi') }}">
          </form> --}}
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            {{-- <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li> --}}
           
          </ul>
        </div>
      </div>
    </nav>    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
           

              <div class="card-header pb-0">
                <h6 class="text-center">Tambah Transaksi</h6>

            </div>
           
            
            <div class="card-body pb-2">
             <div class="col-12">
              <div class="table-responsive p-0">
                <form  action="/addTransaksi" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Nama Barang</label>
                      <select class="form-select" required name="nama_barang"  aria-label="Default select example">
                       
                        <option selected>Pilih -</option>
                        @foreach($stoks as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_barang }}</option>
                        @endforeach
                        
                        
                      </select>
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Jumlah Barang</label>
                      <input autocomplete="off" type="number" class="form-control" required name="jumlah_barang"  aria-describedby="emailHelp" value="{{ old('jumlah_barang') }}">
                      <span style="color:red"></span>
                    </div>
           
                    <div class="mb-3">
                      <label  class="form-label">Tanggal</label>
                      <input autocomplete="off" type="date" class="form-control" required name="tanggal"  aria-describedby="emailHelp" value="{{ old('tanggal') }}">
                      <span style="color:red"></span>
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Bayar</label>
                      <input autocomplete="off" type="text" class="form-control" required name="bayar"  aria-describedby="emailHelp" value="{{ old('bayar') }}">
                      <span style="color:red"></span>
                    </div>
                   
                  
                   
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" >Tambah</button>
                      </div>
                  </form>
                
                
              </div>
             </div>
            </div>
          </div>
        </div>
      </div>
      
      @include('component.footer')
    </div>
  </main>
  
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>
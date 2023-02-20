
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <title>
    Tambah Data Hutang
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
   @include('component.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
           

              <div class="card-header pb-0">
                <h6 class="text-center">Tambah Data Hutang</h6>

            </div>
           
            
            <div class="card-body pb-2">
             <div class="col-12">
              <div class="table-responsive p-0">
                <form  action="/addBook" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="mb-3">
                      <label  class="form-label">Nama Pelanggan</label>
                      <input autocomplete="off" type="text" class="form-control" name="nama_barang" " aria-describedby="emailHelp" value="{{ old('nama_barang') }}">
                      <span style="color:red"></span>
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Jenis Barang</label>
                      <input autocomplete="off" type="text" class="form-control" name="nama_barang" " aria-describedby="emailHelp" value="{{ old('nama_barang') }}">
                      <span style="color:red"></span>
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Jumlah Barang</label>
                      <input autocomplete="off" type="text" class="form-control" name="nama_barang" " aria-describedby="emailHelp" value="{{ old('nama_barang') }}">
                      <span style="color:red"></span>
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Total</label>
                      <input autocomplete="off" type="text" class="form-control" name="nama_barang" " aria-describedby="emailHelp" value="{{ old('nama_barang') }}">
                      <span style="color:red"></span>
                    </div>
                    
                    <div class="mb-3">
                      <label  class="form-label">Tanggal</label>
                      <input autocomplete="off" type="date" class="form-control" name="nama_barang" " aria-describedby="emailHelp" value="{{ old('nama_barang') }}">
                      <span style="color:red"></span>
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Bayar</label>
                      <input autocomplete="off" type="text" class="form-control" name="nama_barang" " aria-describedby="emailHelp" value="{{ old('nama_barang') }}">
                      <span style="color:red"></span>
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Sisa</label>
                      <input autocomplete="off" type="text" class="form-control" name="nama_barang" " aria-describedby="emailHelp" value="{{ old('nama_barang') }}">
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
@extends('admin')

@section('main')

<main class="main-content position-relative border-radius-lg ">


  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          
            <form id="formCari" action="/dataSupply" method="GET">
             
              <div class="input-group">
                <div class="me-3">

                  <input type="date" class="form-control" id="tanggalCari" oninput="tanggal()" name="searchSupply" value="{{ request('searchSupply') }}">
                </div>
                <div class="">

                  <input type="date" class="form-control" id="tanggalCari2" name="searchSupply2" oninput="tanggal()" value="{{ request('searchSupply2') }}">
                </div>
              </div>
             
            {{-- <button type="button" class="btn btn-primary">Cari</button> --}}
          </form>
        </div>
        <ul class="navbar-nav  justify-content-end">
          {{-- <li class="nav-item d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
              <i class="fa fa-user me-sm-1"></i>
              <span class="d-sm-inline d-none">Sign In</span>
            </a>
          </li> --}}
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
  </nav>
  <!-- End Navbar -->


  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
        
          @if(Session::get('suksesTambahSupply'))
            <div class="col-12">
              <div class="alert alert-success">
                <div class="text-light fw-bold">
                  <div class="d-flex justify-content-between">

                  {{ Session::get('suksesTambahSupply') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
              </div>
            </div>
          @endif
          @if(Session::get('berhasilEditSupply'))
            <div class="col-12">
              <div class="alert alert-success">
                <div class="text-light fw-bold">
                  <div class="d-flex justify-content-between">

                  {{ Session::get('berhasilEditSupply') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
              </div>
            </div>
          @endif
          @if(Session::get('berhasilHapusSupply'))
            <div class="col-12">
              <div class="alert alert-success">
                <div class="text-light fw-bold">
                  <div class="d-flex justify-content-between">

                  {{ Session::get('berhasilHapusSupply') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
              </div>
            </div>
          @endif
          @if(Session::get('tidakBoleh'))
            <div class="col-12">
              <div class="alert alert-danger">
                <div class="text-light fw-bold">
                  <div class="d-flex justify-content-between">

                  {{ Session::get('tidakBoleh') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
              </div>
            </div>
          @endif
          

          <div class="card-header pb-0">
            <h6>Catatan Supply</h6>
            <div class="d-flex justify-content-end">

            <a class="btn btn-dark me-2" href="/addDataSupply">+ Catatan</a>
            <a onload="cetak()" target="blank" onclick="noUrl()" id="cetakSupply" class="btn btn-dark justify-content-end" href="">Cetak</a>


            </div>
          </div>
          <div class="card-body p-3 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder bg-dark   text-white">Nama Barang</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2 bg-dark   text-white">Jumlah Stok</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2 bg-dark   text-white">Total Biaya</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder bg-dark   text-white">Tanggal</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder bg-dark   text-white">Edit</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder bg-dark   text-white">Hapus</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($supplys as $sup)
                    
                 
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $sup->stok->nama_barang }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $sup->nama_supplier }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <h5 class="text-xs font-weight-bold mb-0">{{ $sup->jumlah_stok }}</h5>
                      {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                    </td>
                    <td>
                      <h5 class="text-xs font-weight-bold mb-0">Rp. {{ @number_format($sup->biaya,2,",",".") }}</h5>
                      {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                    </td>
                    
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{\Carbon\Carbon::parse($sup->tanggal)->isoFormat(' dddd, D MMMM Y')}}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm "><a href="/editSupply/{{ $sup->id }}">Edit</a></span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm "><a  onclick="return confirm('Yakin Menghapus Data?')" href="/deleteSupply/{{ $sup->id }}">Hapus</a></span>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
             
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-start">

      {{ $supplys->links() }}
    </div>
    
    @include('component.footer')
  </div>
</main>
<script>

const tanggal = () => {
  let tanggal = document.getElementById('tanggalCari').value ; 
  let tanggal2 = document.getElementById('tanggalCari2').value ; 
  document.getElementById('formCari').submit();

}

  const cetak = () => {
    console.log('cetak');
    let tanggal = document.getElementById('tanggalCari').value ; 
    let tanggal2 = document.getElementById('tanggalCari2').value ;
    document.getElementById('cetakSupply').href = 'cetakSupply' + '/' + tanggal + '/' + tanggal2 ;
    let date = document.getElementById('cetakSupply').href ; 
    console.log('niBoss ' + date);
  }
  
  window.onload = (event) => {
  cetak();

  
};

const noUrl = () => {
  console.log('no');
  let tanggal = document.getElementById('tanggalCari').value ; 
  let tanggal2 = document.getElementById('tanggalCari2').value ;
    if (tanggal === '' && tanggal2 === '') {
      alert('Silahkan tentukan rentang tanggal untuk di cetak');
      document.getElementById('cetakSupply').href = '/dataSupply' ;
    }
  }

</script>
@endsection
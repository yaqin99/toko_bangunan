@extends('admin')

@section('main')
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
          
          <form id="formCari" action="/dataZakat" method="GET">
             
            <div class="input-group">
              <div class="me-3">

                <input type="date" class="form-control" id="tanggalCari" oninput="tanggal()" name="searchPajak" value="{{ request('searchPajak') }}">
              </div>
              <div class="">

                <input type="date" class="form-control" id="tanggalCari2" name="searchPajak2" oninput="tanggal()" value="{{ request('searchPajak2') }}">
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
        
          @if(Session::get('berhasilHapus'))
            <div class="col-12">
              <div class="alert alert-success">
                <div class="text-light fw-bold">
                  <div class="d-flex justify-content-between">

                  {{ Session::get('berhasilHapus') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
              </div>
            </div>
          @endif
          @if(Session::get('berhasilEdit'))
            <div class="col-12">
              <div class="alert alert-success">
                <div class="text-light fw-bold">
                  <div class="d-flex justify-content-between">

                  {{ Session::get('berhasilEdit') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
              </div>
            </div>
          @endif
          
       
          <div class="card-header pb-0">
            <h6 class="text-center">Data Pajak</h6>
            
            <div class="d-flex justify-content-end">

            <a class="btn btn-dark me-2" data-bs-toggle="modal" onclick="pajak()" data-bs-target="#modalPajak">
              <i class="bi bi-calculator"></i>
             Hitung Pajak
              
            </a>

          
            </div>
            
          </div>
          <div class="card-body p-3 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder  bg-dark   text-white">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2 bg-dark   text-white">Nominal</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2 bg-dark   text-white">Tanggal</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder  bg-dark   text-white">Aksi</th>
                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hapus</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $k)
                    
                 
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{$loop->index + 1 }}</h6>
                          {{-- <p class="text-xs text-secondary mb-0">{{ $stok->supplier }}</p> --}}
                        </div>
                      </div>
                    </td>
                    
                    <td>
                      <h5 class="text-xs font-weight-bold mb-0">Rp. {{ @number_format($k->nominal,2,",",".") }}</h5>
                      {{-- <input type="number" id="harga_satuan" value="{{$stok->harga_satuan}}" hidden> --}}
                      {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                    </td>
                    <td>
                      <h5 class="text-xs font-weight-bold mb-0" >{{$k->tanggal}}</h5>
                      {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                    </td>
                    <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm "><a href="/deletePajak/{{ $k->id }}" onclick="return confirm('Apakah Anda Yaqin Menghapus Data Pajak Ini ?')" ><i class="bi bi-trash-fill"></i>
                        </a></span>
                     
                    </td>
                    
                    {{-- <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm "><a  onclick="return confirm('Menghapus data bisa mempengaruhi fungsi data lainnya! Yakin Hapus Data?')" href="/deleteStok/{{ $stok->id }}"><i class="fas fa-trash fa-lg"></i></a></span>
                    </td> --}}
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

      {{ $data->links() }}
    </div>
    @include('component.modal.modalPajak')

    @include('component.footer')
  </div>
</main>
<script>
   function pajak(){
    let harga = document.getElementById('sigma').value  
    let saldo =  document.getElementById('saldo_akhir').value
    let sup =  document.getElementById('hutang_supplier').value
    let modal =   document.getElementById('hutang_modal').value
    harga =  Number(harga)
    saldo =  Number(saldo)
    sup =  Number(sup)
    modal =  Number(modal)
    let a = harga  + saldo
    let b = sup + modal ; 
    let total =  a - b  ; 
    document.getElementById('totalZakat').value = total*0.025;
    document.getElementById('totalZakat2').value = total*0.025;
  }

  
  const tanggal = () => {
    console.log('tanggal');
    let tanggal = document.getElementById('tanggalCari').value ; 
    let tanggal2 = document.getElementById('tanggalCari2').value ; 
   
    document.getElementById('formCari').submit();
  
  }

//   const cetak = () => {
//     console.log('cetak');
//     let tanggal = document.getElementById('tanggalCari').value ; 
//     let tanggal2 = document.getElementById('tanggalCari2').value ;
//     document.getElementById('cetakPenjualan').href = '/cetakPenjualan' + '/' + tanggal + '/' + tanggal2 ;
//     let date = document.getElementById('cetakPenjualan').href ; 
//     console.log('niBoss ' + date);
//   }
  
//   window.onload = (event) => {
//   cetak();

  
// };

const noUrl = () => {
  console.log('no');
  let tanggal = document.getElementById('tanggalCari').value ; 
  let tanggal2 = document.getElementById('tanggalCari2').value ;
    if (tanggal === '' && tanggal2 === '') {
      alert('Silahkan tentukan rentang tanggal untuk di cetak');
      document.getElementById('cetakPenjualan').href = 'dataPenjualan' ;
    }
  }
</script>
@endsection
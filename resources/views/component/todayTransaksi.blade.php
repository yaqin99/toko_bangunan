@extends('admin')

@section('main')

<main class="main-content position-relative border-radius-lg ">
  <!-- Navbar -->
 
  <!-- End Navbar -->
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
          
            {{-- <form action="/dataCustomers" method="GET">
            <input type="text" class="form-control" name="search"  placeholder="Cari ..." value="{{ request('search') }}">
        </form> --}}
        </div>
        <ul class="navbar-nav  justify-content-end">
          
          @auth
          <li class="nav-item d-flex align-items-center dropdown">
            <a href="javascript:;" class="nav-link text-white font-weight-bold px-0" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user me-sm-1"></i>
              <span class="d-sm-inline d-none">Welcome, {{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <form action="/logOut" method="POST"> 
                  @csrf
                 <button class="dropdown-item" type="submit">Keluar</button>
                </form>
              </li>
             
            </ul>
          </li>
          
          @endauth
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
  <div class="container-fluid py-4">
    
    <div class="row">
      <div class="col-md-8 mt-4">
        <div class="card">
          @if(Session::get('tidakCukup'))
          <div class="col-12">
            <div class="alert alert-danger">
              <div class="text-light fw-bold">
                <div class="d-flex justify-content-between">

                  {{ Session::get('tidakCukup') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
          </div>
        @endif
          @if(Session::get('bayar'))
          <div class="col-12">
            <div class="alert alert-danger">
              <div class="text-light fw-bold">
                <div class="d-flex justify-content-between">

                  {{ Session::get('bayar') }}
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
          @if(Session::get('nik'))
          <div class="col-12">
            <div class="alert alert-warning">
              <div class="text-light fw-bold">
                <div class="d-flex justify-content-between">

                  {{ Session::get('nik') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
          </div>
        @endif
          @if(Session::get('no'))
          <div class="col-12">
            <div class="alert alert-danger">
              <div class="text-light fw-bold">
                <div class="d-flex justify-content-between">

                  {{ Session::get('no') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
          </div>
        @endif
          @if(Session::get('kosong'))
          <div class="col-12">
            <div class="alert alert-danger">
              <div class="text-light fw-bold">
                <div class="d-flex justify-content-between">

                  {{ Session::get('kosong') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
          </div>
        @endif
          @if(Session::get('nikSudah'))
          <div class="col-12">
            <div class="alert alert-danger">
              <div class="text-light fw-bold">
                <div class="d-flex justify-content-between">
                  <div class="d-flex justify-content-between">

                    {{ Session::get('nikSudah') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              </div>
              </div>
            </div>
          </div>
        @endif
          @if(Session::get('suksesTambah'))
          <div class="col-12">
            <div class="alert alert-success">
              <div class="text-light fw-bold">
                
                <div class="d-flex justify-content-between">

                  {{ Session::get('suksesTambah') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
          </div>
        @endif
          <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Transaksi Harian</h6>
            <div class="d-flex justify-content-end">

              <a class="btn btn-dark  me-2" href="/addTransaksi">+ Transaksi</a>
              <a class="btn btn-dark " target="blank" href="/cetakHarian">Cetak</a>

            </div>
          </div>
          <div class="card-body pt-4 p-3">
            <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder  bg-dark  text-white">Kode Transaksi</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2 bg-dark text-white">Tanggal</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder  bg-dark text-white">Total</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder  bg-dark text-white">Bayar</th>
                  
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder  bg-dark text-white">Kembalian</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder  bg-dark text-white">Opsi</th>
                </tr>
              </thead>
              <tbody>
                
                  
                @foreach($transaksi as $sari)
                  
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      
                      <div class="d-flex flex-column justify-content-center">
                        <a href="/detailTransaksi/{{ $sari->id }}"><h4 class="mb-0 text-sm">{{ $sari->kode_transaksi }}</h4></a>
                      </div>
                    </div>
                  </td>
                  <td>
                    <h5 class="text-xs font-weight-bold mb-0">{{ date('d-m-Y', strtotime($sari->tanggal)) }}</h5>
                    {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">Rp.{{ @number_format($sari->total,2,",",".")}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">Rp.{{ @number_format($sari->bayar,2,",",".")}}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">Rp.{{ @number_format($sari->kembalian,2,",",".")}}</span>
                 
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm "><a href="/editTransaksi/{{ $sari->id }}">Edit</a></span>
                    <span class="badge badge-sm "><a href="/cetakNota/{{ $sari->id }}">Nota</a></span>

                  </td>
               
                
                </tr>
             

                @endforeach

              
               
              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mt-4">
        <form  method="POST" action="/addPenjualan/{{ $total }}">
          @csrf

        <div class="card h-100 mb-4">
          <div class="card-header pb-0 px-3">
            <div class="row">
              <div class="col-md-12 mb-3 d-flex justify-content-start">
                <h6 class="mb-0 mt-1">Data Struk</h6>
                {{-- <div class="col-3 d-flex justify-content-around " >
                  <h6 for="cekHutang" class="mt-1">Kredit</h6>
                <input type="checkbox" name="cekHutang" id="cekHutang" onclick="show()">
                </div> --}}
              </div>
              <div class="row" id="pelanggan" >
                <div class="col-md-8">
                    <select class="form-select" required id="nama_pelanggan" name="nama_pelanggan">
                    
                      <option>Pilih Pelanggan</option>
                      @foreach($customers as $k)
                      <option value="{{ $k->id }}">{{ $k->nama_pelanggan }}</option>
                      @endforeach
                    </select>
                </div>
                  <div class="col-md-4">
                      <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah
                      </button>
                  </div>
              </div>
              </div>
              
              <div class="col-md-5">
                {{-- <label for="examp leInputPassword1" class="form-label">Nama Barang</label> --}}
                <div class="d-flex justify-content-end">

                  
                </div>
            
  
            </div>
          </div>
          <div class="card-body pt-4 p-3">
            <ul class="list-group">
              @foreach($sementara as $sari)
                
             
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark text-sm">{{ $sari->stok->nama_barang }} x {{ $sari->jumlah_barang }}</h6>
                    <span class="text-xs">{{ $sari->tanggal }}</span>
                  </div>
                </div>
                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                  Rp.{{ @number_format($sari->total_biaya,2,",",".")}}
                </div>
                <a href="/deleteSementara/{{ $sari->id }}">
                  <i class="bi bi-x"></i>
                </a>
              </li>
              @endforeach
            </ul>
            <div class="row">
              <div class="col-md-12">
                <div class="d-flex justify-content-end">
                  <h6 class="mb-0 fw-lighter">Total Rp.{{ @number_format($total,2,",",".")}}</h6>
                </div>
              </div>
             
            </div>
            
          </div>
          <div class="card-footer ">
            
                
                <div class="d-flex">

                  <input  class="form-control me-2" required  type="number" placeholder="Bayar" name="bayar" value="{{ old('bayar') }}">
                  <button class="btn btn-dark" id="button-addon2" type="submit">Beli</button>
                  
                </div>
                  
                  
                  
                  </div>
                  
                </div>
                
              </form>
      </div>
    </div>
    <div class="d-flex justify-content-start">

      {{ $transaksi->links() }}
    </div>
    
    @include('component.footer')

  </div>
</main>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pelanggan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="dismiss()" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card mb-4">


          <div class="card-header pb-0">
            

        </div>
       
        
        <div class="card-body pb-2">
         <div class="col-12">
          <div class="table-responsive p-0">
            <form  action="/addCustomersModal" name="modal" method="POST" enctype="multipart/form-data">
                @csrf
               
                <div class="mb-3">
                  <label  class="form-label">Nama Pelanggan</label>
                  <input autocomplete="off" type="text" class="form-control" required name="nama_pelanggan"  value="{{ old('nama_pelanggan') }}">
                </div>
                <div class="mb-3">
                  <label  class="form-label">NIK</label>
                  <input autocomplete="off" type="number" oninput="stringlength(document.modal.nik,16)" class="form-control" id="nik" required name="nik" maxlength="16" value="{{ old('nik') }}">
                  <p><small  id="nikAlert"></small></p>
                  
                </div>
                <div class="mb-3">
                  <label  class="form-label">Nomer Telpon</label>
                  <input autocomplete="off" type="number"  oninput="noTelp(document.modal.noHp,10 , 13 )" id="noHp" class="form-control" required name="no_hp" maxlength="13" value="{{ old('no_hp') }}">
                  <p><small  id="noAlert"></small></p>

                </div>
                <div class="mb-3">
                  <label  class="form-label">Alamat</label>
                  <input autocomplete="off" type="text" class="form-control" required name="alamat"  value="{{ old('alamat') }}">
                </div>
                                 
               
                <div class="d-flex justify-content-end mb-3">
                  <button type="button" class="btn btn-secondary me-2" onclick="dismiss()" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" onclick="stringlength(document.modal.nik,16)">Tambah</button>
                </div>
              </form>
            
            
          </div>
         </div>
        </div>
      </div>
           
        
    </div>
  </div>
</div>

</div>
<script>
  document.getElementById("pelanggan").style.display = 'none';

function show() {

  if (document.getElementById('cekHutang').checked) {
    
    document.getElementById("pelanggan").style.display = '';

  } else  {
    document.getElementById("pelanggan").style.display = 'none'; 
   }

}

  
  function stringlength(inputtxt, length)
  { 
  var field = document.getElementById("nik").value; 
  var panjang = length;
  
  if(field.length != 16)
  { 
    document.getElementById("nikAlert").innerHTML = "NIK Harus Berisi 16 Digit";
    document.getElementById("nikAlert").style.color = "red";
    return false;
    }
  
  if(field.length == 16)
  { 
    document.getElementById("nikAlert").innerHTML = "NIK Sesuai";
    document.getElementById("nikAlert").style.color = "green";

    return false;
    }
  
  }
      function noTelp(inputtxt, min , max)
  { 
  var field = document.getElementById("noHp").value; 
  var min = min;
  var max = max;
  
  if(field.length < min)
  { 
    document.getElementById("noAlert").innerHTML = "Jumlah Digit Kurang";
    document.getElementById("noAlert").style.color = "red";
    return false;
    }
  
  if(field.length == 10 || field.length == 13)
  { 
    document.getElementById("noAlert").innerHTML = "Nomer Telepon Sesuai";
    document.getElementById("noAlert").style.color = "green";

    return false;
    }
  
  if( field.length > 13)
  { 
    document.getElementById("noAlert").innerHTML = "Jumlah Digit Terlalu Banyak";
    document.getElementById("noAlert").style.color = "red";

    return false;
    }
  
  }

  function dismiss(){
    document.getElementById("nikAlert").innerHTML = "";
    document.getElementById("nikAlert").style.color = "none";
    document.getElementById("noAlert").innerHTML = "";
    document.getElementById("noAlert").style.color = "none";
  }
  
</script>
@endsection
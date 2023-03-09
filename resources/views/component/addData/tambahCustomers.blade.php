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
  </nav>
  <!-- End Navbar -->
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          @if(Session::get('no'))
          <div class="col-12">
            <div class="alert alert-danger">
              <div class="text-light fw-bold">
               <div class="row">
                <div class="d-flex justify-content-between">
                  <span> {{ Session::get('no') }}</span>

                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
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
        @endif
        @if(Session::get('nikSudah'))
          <div class="col-12">
            <div class="alert alert-warning">
              <div class="text-light fw-bold">
                <div class="d-flex justify-content-between">
                  {{ Session::get('nikSudah') }}

                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>             
            </div>
          </div>
        @endif
        

            <div class="card-header pb-0">
              <h6 class="text-center">Tambah Customer</h6>

          </div>
         
          
          <div class="card-body pb-2">
           <div class="col-12">
            <div class="table-responsive p-0">
              <form name="formCus" action="/addCustomers" method="POST" enctype="multipart/form-data">
                  @csrf
                 
                  <div class="mb-3">
                    <label  class="form-label">Nama Pelanggan</label>
                    <input autocomplete="off" type="text" class="form-control" required name="nama_pelanggan"  value="{{ old('nama_pelanggan') }}">
                  </div>
                  <div class="mb-3">
                    <label  class="form-label">NIK</label>
                    <input autocomplete="off" type="number" oninput="stringlength(document.formCus.nik,16)" class="form-control" id="nik" required name="nik" maxlength="16" value="{{ old('nik') }}">
                    <p><small  id="nikAlert"></small></p>
                    
                  </div>
                  <div class="mb-3">
                    <label  class="form-label">Nomer Telpon</label>
                    <input autocomplete="off" type="number"  oninput="noTelp(document.formCus.noHp,12 , 13 )" id="noHp" class="form-control" required name="no_hp" maxlength="13" value="{{ old('no_hp') }}">
                    <p><small  id="noAlert"></small></p>
  
                  </div>
                  <div class="mb-3">
                    <label  class="form-label">Alamat</label>
                    <input autocomplete="off" type="text" class="form-control" required name="alamat"  value="{{ old('alamat') }}">
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
<script>
  
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

if(field.length == 12 || field.length == 13)
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
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
        <div class="card mb-6">
          @if(Session::get('nothing'))
          <div class="col-3">
            <div class="alert alert-warning">
              <div class="text-light fw-bold">
                {{ Session::get('nothing') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          </div>
        @endif
    

            <div class="card-header pb-0">
              <h6 class="text-center">Edit Stok</h6>

          </div>
         
          
          <div class="card-body pb-2">
           <div class="col-12">
            <div class="table-responsive p-0">
                @foreach($stoks as $you)
              <form  action="/editStok/{{ $you->id }}" method="POST" enctype="multipart/form-data">
               
                @method('put')

                  @csrf
                    
                
                  <div class="mb-3">
                    <label  class="form-label">Nama Barang</label>
                    <input autocomplete="off" type="text" class="form-control" name="nama_barang"  value="{{ old('nama_barang' , $you->nama_barang) }}">
                  </div>
                  <div class="mb-3">
                    <label  class="form-label">Jumlah Stok</label>
                    <input autocomplete="off" type="text" class="form-control" name="jumlah_stok"  value="{{ old('jumlah_stok', $you->jumlah_stok) }}">
                  </div>
                  <div class="mb-3">
                    <label  class="form-label">Nama Supplier</label>
                    <input autocomplete="off" type="text" class="form-control" name="nama_supplier"  value="{{ old('nama_supplier' , $you->supplier) }}">
                  </div>
                  <div class="mb-3">
                    <label  class="form-label">Tanggal</label>
                    <input autocomplete="off" type="date" class="form-control" name="tanggal"  value="{{ old('tanggal' , $you->tanggal) }}">
                  </div>
                                   
                 
                  <div class="mb-3">
                      <button type="submit" class="btn btn-primary" >Update</button>
                    </div>
                </form>
                @endforeach
              
              
            </div>
           </div>
          </div>
        </div>
      </div>
    </div>
    
    @include('component.footer')
  </div>
</main>

@endsection
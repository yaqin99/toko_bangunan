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
          
            {{-- <form action="/dataPenjualan" method="GET">
            <input type="text" class="form-control" name="searchTransaksi"  placeholder="Cari ..." value="{{ request('searchTransaksi') }}"> --}}
        </form>
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
          @if(Session::get('suksesTambahTransaksi'))
          <div class="col-12">
            <div class="alert alert-success">
              <div class="text-light fw-bold">
                <div class="d-flex justify-content-between">

                {{ Session::get('suksesTambahTransaksi') }}
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
        

            <div class="card-header pb-0">
              <h6>Detail Transaksi</h6>
              <div class="d-flex justify-content-end">

                <a class="btn btn-dark justify-content-end me-2" href="/addDetailTransaksi/{{ $single->transaksi->id }}/{{ $kode }}"><i class="bi bi-plus" ></i>Transaksi</a>
                <a class="btn btn-dark justify-content-end" href="/cetakPenjualan"><i class="bi bi-printer fa-lg"></i></a>

              </div>
              <div class="d-flex justify-content-start">
                <div class="row">
                  <div class="col-md-12">
                    
                    <p><small class="text-xs">Kode Transaksi :  <strong>{{$kode }}</strong></small></p>
                    
                  </div>
                </div>
              </div>
            
          </div>
         
          
          <div class="card-body p-3 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder bg-dark text-white">Nama Barang</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2 bg-dark text-white">Jumlah Barang</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder bg-dark text-white">Total Biaya</th>
                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Tanggal</th> --}}
                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Kode</th> --}}
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder bg-dark text-white">Edit</th>
                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hapus</th> --}}
                  </tr>
                </thead>
                <tbody>
                  
                  @foreach($data as $a)
                    
                  
                  <tr>
                    <td>
                      <div class="d-flex px-3 py-1">
                        
                        <div class="d-flex flex-column justify-content-center">
                          <h4 class="mb-0 text-sm">{{ $a->stok->nama_barang }}</h4>
                        </div>
                      </div>
                    </td>
                    <td>
                      <h5 class="text-xs font-weight-bold mb-0">{{ $a->jumlah_barang }}</h5>
                      {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
                    </td>                
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">Rp. {{  @number_format($a->total_biaya,2,",",".") }}</span>
                    </td>
                    {{-- <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($a->tanggal)->isoFormat(' dddd, D MMMM Y') }}</span>
                    </td>   --}}
                    {{-- <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $a->kode_transaksi }}</span>
                    </td>   --}}
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm "><a href="/editDetailTransaksi/{{ $a->id }}"><i class="fas fa-edit fa-lg"></i></a></span>
                    </td>
                    {{-- <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm "><a onclick="return confirm('Yakin Menghapus Data?')" href="/deleteTransaksi/{{ $a->id }}/{{ $a->nama_barang }}"><i class="fas fa-trash fa-lg"></i></a></span>
                    </td> --}}
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
    
    @include('component.footer')
  </div>
</main>

@endsection
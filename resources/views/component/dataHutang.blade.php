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
          
            <form action="/dataHutang" method="GET">
            <input type="text" class="form-control" name="searchHutang"  placeholder="Cari ..." value="{{ request('searchHutang') }}">
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
        <div class="card mb-4">
          @if(Session::get('success'))
          <div class="col-3">
            <div class="alert alert-success">
              <div class="text-light fw-bold">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          </div>
        @endif
          <div class="card-header pb-0">
            <h6>Data Hutang</h6>
            <div class="d-flex justify-content-end">

            <a class="btn btn-success justify-content-end" href="/addDataHutang"><i class="bi bi-plus"></i>Data Hutang</a>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pelanggan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Total Piutang</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Bayar</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sisa</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tambah Rincian</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rincian</th>
                   
                  </tr>
                </thead>
                <tbody>
                  @foreach($hutang as $h)
                    
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        
                        <div class="d-flex flex-column justify-content-center">
                          <h4 class="mb-0 text-sm">{{ $h->nama }}</h4>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        
                        <div class="d-flex flex-column justify-content-center">
                          <span class="text-secondary text-xs font-weight-bold">Rp. {{ @number_format($h->total,2,",",".") }}</span>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        
                        <div class="d-flex flex-column justify-content-center">
                          <span class="text-secondary text-xs font-weight-bold">Rp. {{ @number_format($h->bayar,2,",",".") }}</span>
                        </div>
                      </div>
                    </td>
                   
                   
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">Rp. {{ @number_format($h->sisa,2,",",".") }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $h->sisa === 0 ? 'Lunas' : 'Belum Lunas' }}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm "><a href="/addDataHutangLama/{{ $h->kode }}"><i class="bi bi-plus-circle fa-lg"></i></a></span>
                    </td> 
                    
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm "><a href="/detailHutang/{{ $h->kode }}">Lihat Detail</span>
                    </td>
                    
                    @endforeach

    
 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-start">

      {{ $hutang->links() }}
    </div>
    
    
    @include('component.footer')
  </div>
</main>

@endsection
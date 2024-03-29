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
          
            {{-- <form action="/dataSupply" method="GET">
            <input type="date" class="form-control" id="tanggalCari" name="searchSupply"  value="{{ request('searchSupply') }}"> --}}
            {{-- <button type="button" class="btn btn-primary">Cari</button> --}}
          {{-- </form> --}}
        </div>
        <ul class="navbar-nav  justify-content-end">
         
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
            <div class="col-3">
              <div class="alert alert-success">
                <div class="text-light fw-bold">
                  {{ Session::get('suksesTambahSupply') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
          @endif
          @if(Session::get('berhasilEditSupply'))
            <div class="col-3">
              <div class="alert alert-success">
                <div class="text-light fw-bold">
                  {{ Session::get('berhasilEditSupply') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
          @endif
          @if(Session::get('berhasilHapusSupply'))
            <div class="col-3">
              <div class="alert alert-success">
                <div class="text-light fw-bold">
                  {{ Session::get('berhasilHapusSupply') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
          @endif
          

          <div class="card-header pb-0">
            <h6>Catatan Supply</h6>
            <div class="d-flex justify-content-end">

            <a class="btn btn-dark me-2" href="/addDataSupplyDetail/{{ $stok_id }}">+ Catatan</a>
            <a class="btn btn-dark justify-content-end" href="/cetakSupply">Cetak </a>


            </div>
          </div>
          <div class="card-body p-3 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Stok</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Biaya</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Edit</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hapus</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $sup)
                    
                 
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
                      <span class="badge badge-sm "><a href="/editSupply/{{ $sup->id }}"><i class="fas fa-edit fa-lg"></i></a></span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm "><a  onclick="return confirm('Yakin Menghapus Data?')" href="/deleteSupply/{{ $sup->id }}"><i class="fas fa-trash fa-lg"></i></a></span>
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

      {{ $data->links() }}
    </div>
    
    @include('component.footer')
  </div>
</main>
<script>

//   let tanggal = document.getElementById('tanggalCari').value
//   alert(tanggal);
// $(document).ready(function(){
//   $("searchSupply").change(function(){
//     this.form.submit();
//   alert("The text has been changed.");
// });
// });
</script>
@endsection
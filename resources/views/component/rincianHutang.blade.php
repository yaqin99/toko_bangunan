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
          
          <form id="formCari" action="/rincianHutang/{{ $customer }}" method="GET">
             
            <div class="input-group">
              <div class="me-3">

                <input type="date" class="form-control" id="tanggalCari" oninput="tanggal()" name="searchRincian" value="{{ request('searchRincian') }}">
              </div>
              <div class="">

                <input type="date" class="form-control" id="tanggalCari2" name="searchRincian2" oninput="tanggal()" value="{{ request('searchRincian2') }}">
              </div>
            </div>
           
          {{-- <button type="button" class="btn btn-primary">Cari</button> --}}
        </form>
        </form>
        </div>
        <ul class="navbar-nav  justify-content-end">
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
          <div class="col-12">
            <div class="alert alert-success">
              <div class="text-light fw-bold">
                <div class="d-flex justify-content-between">

                  {{ Session::get('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
          </div>
        @endif
          @if(Session::get('belum'))
          <div class="col-12">
            <div class="alert alert-danger">
              <div class="text-light fw-bold">
                <div class="d-flex justify-content-between">

                  {{ Session::get('belum') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            </div>
          </div>
        @endif
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
              <h6>Rincian Hutang</h6>
              <div class="d-flex justify-content-end">

                <a class="btn btn-dark me-2 " href="/bayarHutang/{{$sisa}}/{{$customer}}"><i class="bi bi-plus"></i> Bayar</a>
                <a id="cetakPenjualan" onload="cetak()" onclick="noUrl()" class="btn btn-dark justify-content-end" href=""><i class="bi bi-printer fa-lg"></i></a>
                
             </div>
            
            </div>
            
            <div class="d-flex flex-column">

              <p><small class="text-xs">Nama Pelanggan : <strong>{{ $nama }}</strong></small></p>
              <p><small class="text-xs">Kode Pelanggan : <strong>{{$kode }}</strong></small></p>
            </div>

             


          
          </div>
          <div class="card-body p-3 ">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder bg-dark text-white">Keterangan</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder bg-dark text-white">Tanggal</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder bg-dark text-white ">Total Hutang</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder bg-dark text-white">Bayar</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder bg-dark text-white">Sisa</th>
                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Kode Transaksi</th> --}}
                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Keterangan</th> --}}
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder bg-dark text-white">Detail Transaksi</th>
                   
                  </tr>
                </thead>
                <tbody>
                  @foreach($hutang as $h)
                  
                  <tr>
                    
                    <td>
                      <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h4 id="keterangan" class="mb-0 text-sm">{{ $h->keterangan }}</h4>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-3 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h4 class="mb-0 text-sm">{{ \Carbon\Carbon::parse($h->tanggal)->isoFormat(' dddd, D MMMM Y')}}</h4>
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
                    {{-- <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <a href="/detailTransaksi/{{ $h->transaksi->kode_transaksi }}"><h4 class="mb-0 text-sm"><i class="bi bi-eye fa-lg"></i></h4></a>
                        </div>
                      </div>
                    </td> --}}
                    {{-- <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold" >{{ $h->sisa === 0 ? 'Lunas' : 'Belum Lunas' }}</span>
                    </td> --}}
                    
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm "><a id="rincian" href="/detailHutang/{{ $h->id }}/{{ $h->customer->nama_pelanggan }}/{{ $customer}}">{{ $h->keterangan == 'Kredit' ? 'Cek Detail' : '' }}</a></span>
                    </td>
                    
                  </tr>
                    @endforeach
                    
                    <tr>
                      
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-0 text-sm"></h4>

                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-3 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-0 text-sm">Total</h4>

                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center">
                            <span class="text-dark text-xs font-weight-bold"><strong>Rp. {{ @number_format($hutang->sum('total'),2,",",".") }}</strong></span>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center">
                            <span class="text-dark text-xs font-weight-bold"><strong>Rp. {{ @number_format($hutang->sum('bayar'),2,",",".") }}</strong></span>
                          </div>
                        </div>
                      </td>
                     
                     
                      <td class="align-middle text-center">
                        <span class="text-dark text-xs font-weight-bold"><strong>Rp. {{ @number_format($hutang->sum('sisa'),2,",",".") }}</strong>  </span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-dark text-xs font-weight-bold"><a onclick="return confirm('Fungsi ini akan menghapus seluruh data hutang dan pelanggan! Konfirmasi?')" href="/lunas/{{ $customer }}/{{ $sisa }}"><strong>{{ $hutang->sum('sisa')=== 0 ? 'Lunas' : 'Belum Lunas' }}</strong></a> </span>
                      </td>
                      
                      {{-- <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm ">
                        
                        </span>
                      </td> --}}
                      
                    </tr>
 
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
<script>
  
  
  function rincian () {
    console.log('called');
    var keterangan =  document.getElementById("keterangan").innerHTML;
      console.log(keterangan);
      if (keterangan === 'Bayar' ) {
        document.getElementById('rincian').innerHTML = 'none';       
  }
  }
    
  const tanggal = () => {
    let tanggal = document.getElementById('tanggalCari').value ; 
    let tanggal2 = document.getElementById('tanggalCari2').value ; 
    document.getElementById('formCari').submit();
  
  }
  
  

const cetak = () => {
  console.log('cetak');
  let tanggal = document.getElementById('tanggalCari').value ; 
  let tanggal2 = document.getElementById('tanggalCari2').value ;
  document.getElementById('cetakPenjualan').href = 'cetakHutang' + '/'+ '<?php echo $customer; ?>'+'/' + tanggal + '/' + tanggal2 ;
  let date = document.getElementById('cetakPenjualan').href ; 
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
    document.getElementById('cetakPenjualan').href = '<?php echo $customer; ?>';
  }
}
  
  
</script>



@endsection
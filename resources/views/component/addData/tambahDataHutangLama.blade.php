@extends('admin')

@section('main')

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
              <form  action="/addDataHutangLama/{{ $cuz->customer_id }}/{{ $cuz->hutang_id }}/{{ $cuz->total }}/{{ $cuz->bayar }}/{{ $cuz->sisa }}/{{ $nama }}" method="POST" enctype="multipart/form-data">
                  @csrf
                 <div class="mb-3">
                  <label  class="form-label">Nama Pelanggan </label>
                  <input autocomplete="off" type="text" class="form-control" disabled required name="nama" value="{{ old('nama' , $nama) }}">
                  
                </div>
                 
                  <div class="mb-3">
                    <label  class="form-label">Total Hutang</label>
                    <input autocomplete="off" type="number" class="form-control" disabled required name="total" value="{{ old('total' , $cuz->total) }}">
                    <span style="color:red"></span>
                  </div>
                  
                 
                  <div class="mb-3">
                    <label  class="form-label">Total Bayar</label>
                    <input autocomplete="off" type="number" class="form-control" disabled required name="bayar" value="{{ old('bayar' , $cuz->bayar) }}">
                    <span style="color:red"></span>
                  </div>
                  <div class="mb-3">
                    <label  class="form-label">Sisa</label>
                    <input autocomplete="off" type="number" class="form-control" disabled required name="sisa" value="{{ old('sisa' , $cuz->sisa) }}">
                    <span style="color:red"></span>
                  </div>
                  <div class="mb-3">
                    <label  class="form-label">Uang Masuk</label>
                    <input autocomplete="off" type="number" class="form-control" required name="uang_masuk" value="{{ old('uang_masuk') }}">
                    <span style="color:red"></span>
                  </div>
                  <div class="mb-3">
                    <label  class="form-label">Tanggal</label>
                    <input autocomplete="off" type="date" class="form-control" required name="tanggal" value="{{ old('tanggal') }}">
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

@endsection
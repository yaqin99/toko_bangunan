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
                <h6 class="text-center">Edit Data Hutang</h6>

            </div>
           
            
            <div class="card-body pb-2">
             <div class="col-12">
              <div class="table-responsive p-0">
                <form  action="/editDetailHutang/{{ $details->id }}/{{ $details->kode }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                   <div class="mb-3">
                    <label  class="form-label">Nama Pelanggan</label>
                    <input autocomplete="off" type="text" class="form-control" disabled required name="nama" value="{{ old('nama' , $details->nama) }}">
                    
                  </div>
                   
                    <div class="mb-3">
                      <label  class="form-label">Total</label>
                      <input autocomplete="off" type="number" class="form-control" required name="total" value="{{ old('total' , $details->total) }}">
                      <span style="color:red"></span>
                    </div>
                    
                   
                    <div class="mb-3">
                      <label  class="form-label">Bayar</label>
                      <input autocomplete="off" type="number" class="form-control" required name="bayar" value="{{ old('bayar' , $details->bayar) }}">
                      <span style="color:red"></span>
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Sisa</label>
                      <input autocomplete="off" type="number" class="form-control" required name="sisa" value="{{ old('sisa' , $details->sisa) }}">
                      <span style="color:red"></span>
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Tanggal</label>
                      <input autocomplete="off" type="date" class="form-control" required name="tanggal" value="{{ old('tanggal' , $details->tanggal) }}">
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
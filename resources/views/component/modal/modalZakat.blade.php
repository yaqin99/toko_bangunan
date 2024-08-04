<div class="modal fade" id="modalZakat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-center"  id="exampleModalLabel">Tambah Data Zakat</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <form class="signup-form" method="POST" action="/addZakat">
                @csrf
                <div class="form-group mb-2">
                    <label for="judul" class="text-dark">Tanggal</label>
                    <div class="input-group">
                      <input type="date" class="form-control"  required name="tanggal" >
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="judul" class="text-dark">Total Biaya Stok</label>
                    <div class="input-group">
                      <input type="number" class="form-control"   id="sigma" disabled required name="sigma_stok" value="{{$sigma_stok}}" >
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="ukuran" class="text-dark" >Saldo Akhir</label>
                    <div class="input-group">
                        <input type="number" class="form-control"  oninput="hitung()" id="saldo_akhir" required name="saldo_akhir"   >
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="kategori" class="text-dark" >Hutang Supplier</label>
                    <div class="input-group">
                        <input type="number" class="form-control"  oninput="hitung()" id="hutang_supplier" required name="hutang_supplier"  required >
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="kategori" class="text-dark" >Hutang Modal</label>
                    <div class="input-group">
                        <input type="number" class="form-control"  oninput="hitung()" id="hutang_modal" required name="modal"  required >
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="totalZakat" class="text-dark" >Jumlah Total Zakat</label>

                    <div class="input-group">
                        <input type="number" class="form-control" id="totalZakat" disabled name="totalZakat"  required >
                        <input type="number" class="form-control" id="totalZakat2"  hidden name="totalZakat2" >
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-primary">Tambah</button>
                  </div>
                
                
                </form>
            </div>
           
        </div>
       
      </div>
    </div>
  </div>
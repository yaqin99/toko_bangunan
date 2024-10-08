<div class="modal fade" id="modalPajak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-center"  id="exampleModalLabel">Edit Data Pajak</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <form class="signup-form" method="POST" id="formEditPajak">
                @csrf
                @method('put')
                <div class="form-group mb-2">
                    <label for="judul" class="text-dark">Tanggal</label>
                    <div class="input-group">
                      <input type="date" class="form-control" id="tanggalPajak" required name="tanggal" >
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="judul" class="text-dark">Nominal</label>
                    <div class="input-group">
                      <input type="number" class="form-control"   id="nominalEdit" required name="nominal" >
                    </div>
                </div>
                
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Konfirmasi Perubahan Data')">Konfirmasi</button>
                  </div>
                
                
                </form>
            </div>
           
        </div>
       
      </div>
    </div>
  </div>
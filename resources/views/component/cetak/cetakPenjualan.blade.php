<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>{{ $title }}</title>
    <style type="text/css">
      @media print {
        #bg {
          background-color: #f0ad4e !important;
        }
        
        
      }
    </style>
</head>
<body>
    <div class="form-group mt-20 mb-5">
        <div align="center"><h1 class="display-6 text-xs font-weight-bold"><strong>Laporan Penjualan</strong> </h1></div>
    </div>
   
    <table class="table table-bordered" align="center" width="90%" id="table">
        <thead>
          <tr id="bg" class="bg-warning">
            <th scope="col">No</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Kode Transaksi</th>
            <th scope="col">Jumlah Barang</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Harga Satuan</th>
            <th scope="col">Total Biaya</th>
            <th scope="col">Bayar</th>
            <th scope="col">Kembalian</th>
          </tr>
        </thead>
        <tbody>
            @foreach($data as $sariCantik)
                
            <tr>
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td>{{ $sariCantik->stok->nama_barang }}</td>
                <td>{{ $sariCantik->kode_transaksi }}</td>
                <td>{{ $sariCantik->jumlah_barang }}</td>
                <td>{{  \Carbon\Carbon::parse($sariCantik->tanggal)->isoFormat(' dddd, D MMMM Y') }}</td>
                <td> {{ $sariCantik->stok->harga_satuan }}</td>
                <td> {{ $sariCantik->total_biaya }}</td>
                <td> {{ $sariCantik->transaksi->bayar }}</td>
                <td> {{ $sariCantik->transaksi->kembalian }}</td>
                
                
            </tr>
            
            @endforeach
            <tr>
              <td scope="row"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>Total</td>
              <td>Rp. {{ @number_format($data->sum('total_biaya'),2,",",".") }}</td>
              <td id="myTime"></td>
              <td>Rp. {{ @number_format($data->sum('kembalian'),2,",",".") }}</td>
              
              
          </tr>
           
        </tbody>
      </table>
      <script type="text/javascript">
         
            
        var tableBody = document.getElementsByTagName("tbody").item(0);
        var i;
        var howManyRows = tableBody.rows.length;
        let arr = [] ;
        for (i=0; i<(howManyRows-1); i++) // skip first and last row (hence i=1, and howManyRows-1)
        {
            var thisTrElem = tableBody.rows[i];
            var thisTdElem = thisTrElem.cells[7];			
          var thisTextNode = thisTdElem.childNodes.item(0);
          
             let data = thisTextNode.data ;
             arr.push(data);
//             
// });
        } // end for
        let intArr = [] ; 
        let length = arr.length ; 
        arr.forEach( ele => intArr.push(+ele))

    
          console.log(intArr);

        let result = intArr.reduce((x, y) => {
            return x + y;
          }, );

          var	number_string = result.toString(),
          sisa 	= number_string.length % 3,
          rupiah 	= number_string.substr(0, sisa),
          ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
            
        if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }

          document.getElementById('myTime').innerHTML = 'Rp.'+rupiah ; 
             console.log(rupiah);

        
            // window.print();
      </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
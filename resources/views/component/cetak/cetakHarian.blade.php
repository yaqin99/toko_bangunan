<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>{{ $title }}</title>
</head>
<body>
    <div class="form-group mt-20 mb-5">
        <div align="center"><h1 class="display-6 text-xs font-weight-bold"><strong>Laporan Penjualan Harian</strong> </h1></div>
    </div>
   
    <table class="table table-bordered" align="center" width="90%">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Kode Transaksi</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Total Biaya</th>
            <th scope="col">Bayar</th>
            <th scope="col">Kembalian</th>
          </tr>
        </thead>
        <tbody>
            @foreach($data as $sariCantik)
                
            <tr>
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td>{{ $sariCantik->kode_transaksi }}</td>
                <td>{{  \Carbon\Carbon::parse($sariCantik->tanggal)->isoFormat(' dddd, D MMMM Y') }}</td>
                <td>Rp. {{ @number_format($sariCantik->total,2,",",".") }}</td>
                <td>Rp. {{ @number_format($sariCantik->bayar,2,",",".") }}</td>
                <td>Rp. {{ @number_format($sariCantik->kembalian,2,",",".") }}</td>
                
                
            </tr>
           
            
            @endforeach
            <tr>
              <td scope="row"></td>
              <td></td>
              <td><strong>Total</strong></td>
              <td>Rp. {{ @number_format($data->sum('total'),2,",",".") }}</td>
              <td>Rp. {{ @number_format($data->sum('bayar'),2,",",".") }}</td>
              <td>Rp. {{ @number_format($data->sum('kembalian'),2,",",".") }}</td>
              
              
          </tr>
         
          
           
        </tbody>
      </table>
      <script type="text/javascript">
            window.print();
      </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
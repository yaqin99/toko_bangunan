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
    <div class="form-group mt-20">
        <div align="center"><p><strong>Laporan Rekap</strong> </p></div>
    </div>
   
    <table class="table table-bordered" align="center" width="90%">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Total Transaksi</th>
            <th scope="col">Uang Masuk</th>
            <th scope="col">Sisa</th>
            <th scope="col">Keterangan</th>
          </tr>
        </thead>
        <tbody>
            @foreach($data as $sariCantik)
                
            <tr>
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($sariCantik->tanggal)->isoFormat(' dddd, D MMMM Y') }}</td>
                <td>{{ $sariCantik->transaksi }}</td>
                <td> {{ $sariCantik->uang_masuk }}</td>
                <td> {{ $sariCantik->uang_keluar }}</td>
                <td> {{ $sariCantik->keterangan }}</td>
             </tr>
            
            @endforeach
            <tr>
                <td scope="row"></td>
                <td>Total</td>
                <td>{{ $data->sum('transaksi') }}</td>
                <td> {{$data->sum('uang_masuk') }}</td>
                <td> {{$data->sum('uang_keluar') }}</td>
                <td> </td>
             </tr>
        </tbody>
      </table>
      <script type="text/javascript">
            window.print();
      </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
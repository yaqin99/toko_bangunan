<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    
    <style>
        .containery {
            width: 200px;
        }
        .header {
            margin: 0;
            text-align: center;
        }
        h2, p {
            margin: 0;
        }
        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }
        .flex-container-1 > div {
            text-align : left;
        }
        .flex-container-1 .right {
            text-align : right;
            width: 200px;
        }
        .flex-container-1 .left {
            width: 100px;
        }
        .flex-container {
            width: 200px;
            display: flex;
        }
        .flex-container > div {
            -ms-flex: 1;  /* IE 10 */
            flex: 1;
        }
        ul {
            display: contents;
        }
        ul li {
            display: block;
        }
        hr {
            border-style: dashed;
        }
        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="containery">
        <div class="header" style="margin-bottom: 20px;">
            <h2>Sederhana Motor</h2>
            <small>Jl. Sersan Mesrul, Kabupaten Pemekasan, Jawa Timur 69315
            </small>
            {{-- <small>BATU PUTIH DAYA D2-D3 NO. 20, Jl. Kyai Haji Zainul Arifin, RT.8/RW.7, Krukut, Kec. Taman Sari, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11140
            </small> --}}
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li><small>No Order</small></li>
                    {{-- <li>Kasir</li> --}}
                    <li><small>Tanggal</small></li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li> <small>{{ $single->kode_transaksi }}</small> </li>
                    {{-- <li> Yaqin </li> --}}
                    <li> <small>{{ date('d-m-Y', strtotime($single->tanggal))  }}</small> </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;"><small>Nama Product</small></div>
            <div><small>Total</small></div>
        </div>
            <div class="flex-container" style="text-align: right; display:block;">
               @foreach($data as $fia)
                
               <div style="text-align: left; "><small>{{ $fia->stok->nama_barang }} x {{ $fia->jumlah_barang }}</small></div>
               {{-- <div>Rp. {{ $fia->stok->harga_satuan }} </div> --}}
               <div><small>Rp. {{ @number_format($fia->total_biaya,2,",",".") }} </small></div>
               <br>
               @endforeach
            </div>
        <hr>
        <div class="flex-container" style=" margin-top: 5px;">
            <div></div>
            <div  style="text-align: left; position: absolute; left:7px;">
                <ul>
                    <li><small>Total</small></li>
                    <li><small>Bayar</small></li>
                    <li><small>Kembali</small></li>
                </ul>
            </div>
            <div style="text-align: right;">
                <ul>
                   
                        
                    <li><small> Rp. {{ @number_format($single->transaksi->total,2,",",".") }}  </small></li>
                    <li><small> Rp. {{ @number_format($single->transaksi->bayar,2,",",".") }}  </small></li>
                    <li><small> Rp. {{ @number_format($single->transaksi->kembalian,2,",",".") }}  </small></li>
                   
                    
                  
                </ul>
            </div>
        </div>
        <hr>
        <div class="header" style="margin-top: 20px;">
            <h3>Terimakasih</h3>
            <p>Barang yang sudah dibeli tidak bisa ditukar atau dikembalikan</p>
        </div>
    </div>
    <script type="text/javascript">
        window.print();
  </script>
</body>
</html>
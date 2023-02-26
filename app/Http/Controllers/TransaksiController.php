<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\Stok;
use Illuminate\Support\Facades\DB;



class TransaksiController extends Controller
{
   

    public function addTransaksi(){


        request()->validate([
             'nama_barang' => 'required' , 
             'bayar' => 'required',
             'jumlah_barang' => 'required' , 
             'tanggal' => 'required' , 
           
             
         ]);
        $data = Stok::find(request()->nama_barang);
        $totalBiaya = $data->harga_satuan * request()->input('jumlah_barang');
        $kembalian = request()->input('bayar') - $totalBiaya ; 
        $query = DB::table('transaksis')->insert([
             'nama_barang' =>$data->nama_barang, 
             'jumlah_barang' =>request()->input('jumlah_barang'),
             'harga_satuan' =>$data->harga_satuan,
             'total_biaya'  =>$totalBiaya,
             'tanggal' => request()->input('tanggal'),
             'bayar' => request()->input('bayar'),
             'kembalian' => $kembalian,

           
         ]);

        $data->jumlah_stok = $data->jumlah_stok - request()->input('jumlah_barang');
        $data->save();

 
         if($query){
             return redirect('/dataPenjualan')->with('suksesTambahTransaksi' , 'Data Transaksi Berhasil di Tambahkan');
         } 

             dd('gagal');
 
         
     }

     public function editTransaksi( $id , $idStok){
        
       
        
        $validatedData =  request()->validate([
            'nama_barang' => 'required' , 
            'bayar' => 'required',
            'jumlah_barang' => 'required' , 
            'tanggal' => 'required' , 
        ]);
        
        if (request()->nama_barang === 'Pilih -') {
            return back()->with('lengkapi' , 'Harap Lengkapi Semua Data');

        }

        $stok = DB::table('stoks')->select('*')->where('id',$idStok)->first();
        
        $data = Transaksi::find($id)->jumlah_barang ;
        $newStok = $stok->jumlah_stok + $data ;
       
        $totalStok = $newStok - request()->input('jumlah_barang');
        DB::table('stoks')->where('id' , $stok->id)->update(['jumlah_stok' => $totalStok ]);
        $totalBiaya = $stok->harga_satuan * request()->input('jumlah_barang');
        $kembalian = request()->input('bayar') - $totalBiaya ; 
       
        DB::table('transaksis')->where('id' , $id)->update(['total_biaya' => $totalBiaya  , 'kembalian' => $kembalian]);

        

        $cek = DB::table('transaksis')->where('id' , $id)->update($validatedData);
        if ($cek) {
            # code...
            return redirect('/dataPenjualan')->with('berhasilEditSupply' , 'Data Berhasil di Update');
        } else {

            
            return back()->with('nothing' , 'Tidak Ada Data yang Berubah');
        }


    }

    public function deleteTransaksi($id , $nama_barang){
        $data = Transaksi::find($id);
        $stok = DB::table('stoks')->select('*')->where('nama_barang',$nama_barang)->first();
        $newStok = $stok->jumlah_stok + $data->jumlah_barang ; 
        DB::table('stoks')->where('id' , $stok->id)->update(['jumlah_stok' => $newStok ]);
        $delete =  $data->delete();

       if($delete){
        return back()->with('berhasilHapus' , 'Data Berhasil di Hapus');
    } else {
        return back()->with('gagalHapus' , 'Data Gagal di Hapus');

    }
    }

  
  
}

<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\DetailHutang;
use App\Models\DetailTransaksi;
use App\Models\Hutang;
use App\Models\Stok;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;




class TransaksiController extends Controller
{
   

    public function addTransaksi(){


        request()->validate([
             'nama_barang' => 'required' , 
            //  'bayar' => 'required',
             'jumlah_barang' => 'required' , 
           
             
         ]);
        
        // $ranStr = Str::random(5);
        // $ranNum =  random_int(100, 10000);
        // $kode = $ranStr.$ranNum ;
        $data = Stok::find(request()->nama_barang);

        if ($data->jumlah_stok < request()->input('jumlah_barang')) {
           return back()->with('tidakCukup' , 'Stok Barang Tidak Cukup');
        }
        $totalBiaya = $data->harga_satuan * request()->input('jumlah_barang');
        $kembalian = request()->input('bayar') - $totalBiaya ; 

        $query = DB::table('sementaras')->insert([
             'stok_id' =>request()->input('nama_barang'),
             'jumlah_barang' =>request()->input('jumlah_barang'),
             'total_biaya'  =>$totalBiaya,
           

           
         ]);

        // $data->jumlah_stok = $data->jumlah_stok - request()->input('jumlah_barang');
        // $data->save();

 
         if($query){
             return redirect('/')->with('suksesTambahTransaksi' , 'Data Transaksi Berhasil di Tambahkan');
         } 

             dd('gagal');
 
         
     }

     public function editTransaksi( $id , $kode_transaksi){
        $validatedData =  request()->validate([
            'bayar' => 'required' ,
            'tanggal' => 'required' , 
        ]);

        $bayar =  Transaksi::select('total')->where('id',$id)->first();
        $kembalian = request()->bayar - $bayar->total ; 
        $cek = DB::table('transaksis')->where('id' , $id)->update([
            "bayar" => request()->bayar , 
            "tanggal" => request()->tanggal , 
            "kembalian" => $kembalian , 
        ]);

        $hutang = Hutang::with('customer' , 'transaksi')->select('*')->where('transaksi_id',$id)->first();

        if ($hutang != null) {
           
            Hutang::where('transaksi_id' , $id)->update([
                'bayar' => request()->bayar , 
                'sisa' => $hutang->total - request()->bayar ,
            ]);

            DetailHutang::where('hutang_id' , $hutang->id)->update([
                'bayar' => request()->bayar , 
                'sisa' => $hutang->total - request()->bayar ,
                'uang_masuk' => request()->bayar ,
            ]);
        }

        if ($cek) {
            # code...
            return redirect('/dataPenjualan')->with('berhasilEdit' , 'Data Berhasil di Update');
        } else {

            
            return back()->with('nothing' , 'Tidak Ada Data yang Berubah');
        }


    }

    public function deleteTransaksi($id , $kode_transaksi){
        $data = Transaksi::find($id);


        $detail = DetailTransaksi::with('stok')->select('*')->where('kode_transaksi' , $kode_transaksi)->get();
        //DETAIL DI ATAS KARENA GET MAKA DIA DAPATNYA COLLECTION ATAU BANYAK DATA
        $single = DetailTransaksi::with('stok')->select('*')->where('kode_transaksi' , $kode_transaksi)->first();
        
        //SINGLE DI ATAS KARENA FIRST MAKA DAPAT SINGLE DATA 
        $newStok = $single->stok->jumlah_stok + $single->jumlah_barang ; 
        
        DB::table('stoks')->where('id' , $single->stok->id)->update(['jumlah_stok' => $newStok ]);

        DetailTransaksi::where('kode_transaksi', $kode_transaksi)->delete();
        $delete =  $data->delete();

       if($delete){
        return back()->with('berhasilHapus' , 'Data Berhasil di Hapus');
    } else {
        return back()->with('gagalHapus' , 'Data Gagal di Hapus');

    }
    }

  
  
}

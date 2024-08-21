<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\DetailHutang;
use App\Models\DetailTransaksi;
use App\Models\Hutang;
use App\Models\Rekap;
use App\Models\Stok;
use App\Models\pajak;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon ; 



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

        
         
         $latest = pajak::orderBy('id','desc')->first();
         pajak::where('id',$latest['id'])->update([
             'nominal' => $latest->nominal + $totalBiaya*0.05 , 
         ]);

            
        

        // $data->jumlah_stok = $data->jumlah_stok - request()->input('jumlah_barang');
        // $data->save();

 
         if($query){
             return redirect('/')->with('suksesTambahTransaksi' , 'Data Transaksi Berhasil di Tambahkan');
         } 

             dd('gagal');
 
         
     }

     public function editTransaksi( $id , $kode_transaksi){
        request()->validate([
            'bayar' => 'required' ,
            'tanggal' => 'required' , 
        ]);

        $bayar =  Transaksi::select('total' , 'kode_transaksi' , 'id')->where('id',$id)->first();
        $kembalian = request()->bayar - $bayar->total ; 

        $cek = DB::table('transaksis')->where('id' , $id)->update([
            "bayar" => request()->bayar , 
            "tanggal" => request()->tanggal , 
            "kembalian" => $kembalian , 
        ]);
  
        Hutang::where('transaksi_id' , $id)->update([
                'bayar' => request()->bayar , 
                'tanggal' => request()->tanggal ,
                'sisa'=> $kembalian , 
            ]);
        DetailTransaksi::where('kode_transaksi' , $bayar->kode_transaksi)->update([
               
                'tanggal' => request()->tanggal ,
                
            ]);
        
        Rekap::where('transaksi_id' , $id)->update([
           
                "transaksi" => $bayar->total , 
                "uang_masuk" => request()->bayar , 
                "uang_keluar" => request()->bayar - $bayar->total , 
                'tanggal' => request()->tanggal ,
            ]);
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

<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Stok;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Carbon\Carbon;


class DetailTransaksiController extends Controller
{
   public function editDetailTransaksi ($id){

    $data = DetailTransaksi::find($id);

    request()->validate([
        "jumlah_barang" => 'required' , 
    ]);

    $total_biaya = $data->stok->harga_satuan * request()->jumlah_barang ;

    if ($data->stok->jumlah_stok < request()->input('jumlah_barang')) {
        return back()->with('tidakCukup' , 'Stok Barang Tidak Cukup');
     }
   DetailTransaksi::where('id',$id)->update([
    "jumlah_barang" => request()->jumlah_barang , 
    "total_biaya" => $total_biaya , 
   ]);
   $stok = $data->stok->jumlah_stok + $data->jumlah_barang ; 
   $newStok = $stok - request()->jumlah_barang ; 

   Stok::where('id',$data->stok->id)->update([
    "jumlah_stok" => $newStok , 
  
   ]);

   $sum = DetailTransaksi::select('total_biaya')->where('kode_transaksi' , $data->kode_transaksi)->get();
   $totalBiayaTransaksi = $sum->sum('total_biaya');
   
  $bayar =  Transaksi::select('bayar')->where('kode_transaksi',$data->kode_transaksi)->first();
   $sisa = $bayar->bayar - $totalBiayaTransaksi ; 
   Transaksi::where('kode_transaksi',$data->kode_transaksi)->update([
    "total" => $totalBiayaTransaksi , 
    "kembalian" => $sisa , 
   ]);

   return redirect('/detailTransaksi'.'/'.$data->kode_transaksi)->with('berhasilEdit' , 'Data Berhasil di Edit');

   }


   public function addDetailTransaksi($kode){


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
    $tanggal = Carbon::now();
    $query = DB::table('detail_transaksis')->insert([
         'stok_id' =>request()->input('nama_barang'),
         'jumlah_barang' =>request()->input('jumlah_barang'),
         'total_biaya'  =>$totalBiaya,
         'tanggal' => $tanggal , 
         'kode_transaksi' => $kode , 
     ]);

    $stok = $data->jumlah_stok - request()->input('jumlah_barang') ; 
   

    Stok::where('id',request()->nama_barang)->update([
        "jumlah_stok" => $stok , 
    
    ]);

    $sum = DetailTransaksi::select('total_biaya')->where('kode_transaksi' , $kode)->get();
    $totalBiayaTransaksi = $sum->sum('total_biaya');
    
    $bayar =  Transaksi::select('bayar')->where('kode_transaksi',$kode)->first();
    $sisa = $bayar->bayar - $totalBiayaTransaksi ; 
    Transaksi::where('kode_transaksi',$kode)->update([
        "total" => $totalBiayaTransaksi , 
        "kembalian" => $sisa , 
    ]);



     if($query){
         return redirect('/')->with('suksesTambahTransaksi' , 'Data Transaksi Berhasil di Tambahkan');
     } 

         dd('gagal');

     
 }
}

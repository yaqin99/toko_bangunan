<?php

namespace App\Http\Controllers;

use App\Models\Sementara;
use App\Models\Transaksi;
use App\Models\Hutang;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;



class SementaraController extends Controller
{

    public function addPenjualan($total){

        
        request()->validate([
            'bayar' => 'required' , 
        ]);

        $sementaraData = Sementara::all();
        if ($sementaraData == "[]") {
            return back()->with('kosong','Silahkan Pilih Barang ');       
         }
        // $data = [
        //     "nama_pelanggan" => request()->input('nama_pelanggan'),
        //     "bayar" => request()->input('bayar'),
        // ];
        // dd($data);
        if (request()->input('nama_pelanggan') == "Pilih Pelanggan") {
            if (request()->input('bayar') < $total) {
                return back()->with('tidakCukup','Uang Anda Kurang, Silahkan Pilih Customers Jika Data Merupakan Data Hutang');
            }
            if (request()->input('bayar') >= $total) {
            $ranStr = Str::random(6);
            $ranNum =  random_int(100, 10000);
            $kode = $ranStr.$ranNum ;
            $time = Carbon::now();
            $kembalian = request()->input('bayar') - $total ; 

            $query = DB::table('transaksis')->insert([
                'kode_transaksi' =>$kode,
                'tanggal' => $time,
                'total'  =>$total,
                'bayar' =>request()->input('bayar'),
                'kembalian' => $kembalian , 
            ]);
    
            $readyData = [
                "nama_barang" => 0 , 
                "jumlah_barang" => 0 , 
                "total_biaya" => 0 , 
                "tanggal" => '' , 
                "kode_transaksi" => '',
            ] ; 
    
             $roses = Transaksi::select('id')->orderBy('id' , 'desc')->latest()->first();

            foreach ($sementaraData as $a) {
           
                $readyData['nama_barang'] = $a->stok->id ; 
                $readyData['jumlah_barang'] = $a->jumlah_barang ; 
                $readyData['total_biaya'] = $a->jumlah_barang * $a->stok->harga_satuan;
                $readyData['tanggal'] = $time ; 
                $readyData['kode_transaksi'] = $kode;
                
                $query = DB::table('detail_transaksis')->insert([
                    "stok_id" => $readyData['nama_barang'] , 
                    "transaksi_id" => $roses->id , 
                    "jumlah_barang" => $readyData['jumlah_barang'] , 
                    "total_biaya" => $readyData['total_biaya'] , 
                    "tanggal" => $readyData['tanggal'] , 
                    "kode_transaksi" => $readyData['kode_transaksi'],
                ]);
    
                $newStok = $a->stok->jumlah_stok - $readyData['jumlah_barang'] ; 
                DB::table('stoks')->where('id' , $a->stok->id)->update(['jumlah_stok' => $newStok ]);
    
             }

             $query = DB::table('rekaps')->insert([
                 "tanggal" => $time , 
                "transaksi" => $total  , 
                "uang_masuk" => request()->input('bayar'), 
                "uang_keluar" => $kembalian , 
                "keterangan" => 'Cash',
            ]);
            }
        }
       
        
       
        
        

        
         if (request()->input('nama_pelanggan') != "Pilih Pelanggan") {
            if (request()->input('bayar') < $total) {

            $ranStr = Str::random(6);
            $ranNum =  random_int(100, 10000);
            $pelanggan = Customers::select('kode_customers')->where('id' , request()->input('nama_pelanggan'))->first();
            $kode = $pelanggan->kode_customers.' - '.$ranStr.$ranNum ;
            $time = Carbon::now();
            $kembalian = request()->input('bayar') - $total ; 
            $query = DB::table('transaksis')->insert([
                'kode_transaksi' =>$kode,
                'tanggal' => $time,
                'total'  =>$total,
                'bayar' =>request()->input('bayar'),
                'kembalian' => $kembalian , 
            ]);
    
            $readyData = [
                "nama_barang" => 0 , 
                "jumlah_barang" => 0 , 
                "total_biaya" => 0 , 
                "tanggal" => '' , 
                "kode_transaksi" => '',
            ] ; 
            $sementaraData = Sementara::all();
    
            $roses = Transaksi::select('id')->orderBy('id' , 'desc')->latest()->first();

            foreach ($sementaraData as $a) {
           
                $readyData['nama_barang'] = $a->stok->id ; 
                $readyData['jumlah_barang'] = $a->jumlah_barang ; 
                $readyData['total_biaya'] = $a->jumlah_barang * $a->stok->harga_satuan;
                $readyData['tanggal'] = $time ; 
                $readyData['kode_transaksi'] = $kode;
                
                $query = DB::table('detail_transaksis')->insert([
                    "stok_id" => $readyData['nama_barang'] , 
                    "transaksi_id" => $roses->id , 
                    "jumlah_barang" => $readyData['jumlah_barang'] , 
                    "total_biaya" => $readyData['total_biaya'] , 
                    "tanggal" => $readyData['tanggal'] , 
                    "kode_transaksi" => $readyData['kode_transaksi'],
                ]);
    
                $newStok = $a->stok->jumlah_stok - $readyData['jumlah_barang'] ; 
                DB::table('stoks')->where('id' , $a->stok->id)->update(['jumlah_stok' => $newStok ]);
    
             }

             $query = DB::table('rekaps')->insert([
                "tanggal" => $time , 
               "transaksi" => $total  , 
               "uang_masuk" => request()->input('bayar'), 
               "uang_keluar" => $kembalian , 
               "keterangan" => 'Kredit',
           ]);
             $transaksi =  Transaksi::select('*')->orderBy('id' , 'desc')->latest()->first();

                $query = DB::table('hutangs')->insertGetId([
                    'customer_id' => request()->input('nama_pelanggan'),
                    'transaksi_id' => $transaksi->id,
                    'keterangan' => 'Kredit',
                    'tanggal' => $time,
                    'total' => $transaksi->total ,
                    'bayar' => $transaksi->bayar ,
                    'sisa' =>  $transaksi->bayar - $transaksi->total, 
                ]);

                // $roses = DB::getPdo()->lastInsertId(); 
                
                // $query = DB::table('hutang_customer')->insert([
                //     'hutang_id' => $roses,
                //     'customer_id' => request()->input('nama_pelanggan'),
                    
                // ]);
                
             $hutang =  Hutang::select('id')->orderBy('id' , 'desc')->latest()->first();

                // $query = DB::table('detail_hutangs')->insert([
                //     'customer_id' => request()->input('nama_pelanggan'),
                //     'hutang_id' => $hutang->id,
                //     'transaksi_id' => $transaksi->id,
                //     'total' => $transaksi->total ,
                //     'bayar' => $transaksi->bayar , 
                //     'sisa' =>  $transaksi->total - $transaksi->bayar, 
                //     'uang_masuk' => $transaksi->bayar , 
                //     'tanggal' => $transaksi->tanggal , 
                // ]);


            }
            

            if (request()->input('bayar') >= $total) {
                return back()->with('bayar','Pada Data Hutang Pembayaran Harus Di Bawah Total');
            }
            
    
         }


         


        if($query){
            Sementara::query()->delete();
            return redirect('/')->with('suksesTambahTransaksi' , 'Data Transaksi Berhasil di Tambahkan');
        } 
    }

    public function delete($id){
        $data = Sementara::find($id);
        
        $delete =  $data->delete();

       if($delete){
        return back();
    } else {
        return back()->with('gagalHapus' , 'Data Gagal di Hapus');

    }
    }

    public function deleteAll(){
        return Sementara::query()->delete();
    }
}

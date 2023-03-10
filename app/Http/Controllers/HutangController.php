<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use App\Http\Requests\StoreHutangRequest;
use App\Http\Requests\UpdateHutangRequest;
use App\Models\Customers;
use Illuminate\Support\Facades\DB;

class HutangController extends Controller
{
    
    public function bayarHutang($customer_id , $sisa){

        $keterangan = 'Bayar Kredit' ; 
        if (request()->nominal  < 0) {
           $keterangan = 'Kembalian';
        }

        $query = DB::table('hutangs')->insert([
            'customer_id' => $customer_id,
            
            'keterangan' => $keterangan , 
            'tanggal' => request()->tanggal , 
            'total'  => 0,
            'bayar'  => request()->nominal,
            'sisa'  => request()->nominal ,
          
            
      
          
        ]);

        DB::table('rekaps')->insert([
            "tanggal" => request()->tanggal , 
            "transaksi" => 0  , 
            "uang_masuk" => request()->nominal, 
            "uang_keluar" => request()->nominal , 
            "keterangan" => $keterangan,
        ]);
        if ($query) {
            return redirect('/rincianHutang'.'/'.$customer_id);
         }
 
    }

    public function lunas($customer_id , $sisa){

        if ($sisa < 0) {
            return back()->with('belum' , 'Hutang Belum Lunas');
        }
        
        if ($sisa == 0) {
            Customers::find($customer_id)->delete();
            Hutang::where('customer_id' , $customer_id)->delete();
            return redirect('/dataCustomers')->with('lunas' , 'Hutang Lunas');

        }   
       

    }
   

   
}

<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use App\Http\Requests\StoreHutangRequest;
use App\Http\Requests\UpdateHutangRequest;
use Illuminate\Support\Facades\DB;

class HutangController extends Controller
{
    
    public function bayarHutang($customer_id){

        $query = DB::table('hutangs')->insert([
            'customer_id' => $customer_id,
            
            'keterangan' => 'Bayar' , 
            'tanggal' => request()->tanggal , 
            'total'  => 0,
            'bayar'  => request()->nominal,
            'sisa'  => 0 - request()->nominal,
          
        
      
          
        ]);
        if ($query) {
            return redirect('/rincianHutang'.'/'.$customer_id);
         }
 
    }
   

   
}

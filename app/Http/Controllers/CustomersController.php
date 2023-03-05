<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Http\Requests\StoreCustomersRequest;
use App\Http\Requests\UpdateCustomersRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CustomersController extends Controller
{
    public function addCustomers(){


        request()->validate([
             'nama_pelanggan' => 'required' , 
             'nik' => 'required',
             'no_hp' => 'required' , 
             'alamat' => 'required' , 
           
             
         ]);
        
        $ranStr = Str::random(5);
        $ranNum =  random_int(100, 10000);
        $kode = $ranStr.$ranNum ;

        $query = DB::table('customers')->insert([
             'nama_pelanggan' =>request()->input('nama_pelanggan'),
             'kode_customers' => $kode , 
             'nik' =>request()->input('nik'),
             'no_hp'  =>request()->input('no_hp'),
             'alamat' => request()->input('alamat'),
         ]);

        // $data->jumlah_stok = $data->jumlah_stok - request()->input('jumlah_barang');
        // $data->save();

 
         if($query){
             return redirect('/dataCustomers')->with('suksesTambah' , 'Data Pelanggan Berhasil di Tambahkan');
         } 

             dd('gagal');
 
         
     }

     
     public function editCustomer($id){

      $data =  request()->validate([
            "nama_pelanggan" => 'required' , 
            "nik" => 'required' , 
            "no_hp" => 'required' , 
            "alamat" => 'required' , 
        ]);

        $query = Customers::where('id' , $id)->update($data);

        if ($query) {
           return redirect('/dataCustomers')->with('edit','Data Berhasil Di Edit');
        }
     }
}

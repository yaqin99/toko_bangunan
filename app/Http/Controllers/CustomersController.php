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


        
        $nik = Str::length(request()->nik);
        $no = Str::length(request()->no_hp);
        if($nik > 16 || $nik < 16){
            return back()->with('nik' , 'Masukkan NIK yang Benar');
        }
             
        if($no > 13 || $no < 10 ){
            return back()->with('no' , 'Masukkan Nomor Telepon yang Benar');
        }
        
    
        
        request()->validate([
            'nama_pelanggan' => 'required' , 
            'nik' => 'required',
            'no_hp' => 'required' , 
            'alamat' => 'required' , 
          
            
        ]);
        // $ranStr = Str::random(5);
        // $ranNum =  random_int(100, 10000);
        $data = Customers::select('*')->orderBy('id','desc')->latest()->first();
        $akbar = Customers::select('*')->where('nik' , request()->nik)->first();
        
        $a = $data->id+1;
        if ($akbar != null) {
            return back()->with('nik' , 'Nik sudah terdaftar');
        }
        $kode = 'CO'.$a ;

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
    public function addCustomersModal(){


        
        // $nik = Str::length(request()->nik);
        $no = Str::length(request()->no_hp);
        // if($nik > 16 || $nik < 16){
        //     return back()->with('nik' , 'Masukkan NIK yang Benar');
        // }
             
        if($no > 13 || $no < 10 ){
            return back()->with('no' , 'Masukkan Nomor Telepon yang Benar');
        }
        
    
        
        request()->validate([
            'nama_pelanggan' => 'required' , 
            'nik' => 'required',
            'no_hp' => 'required' , 
            'alamat' => 'required' , 
          
            
        ]);
        // $ranStr = Str::random(5);
        // $ranNum =  random_int(100, 10000);
        $akbar = Customers::select('*')->where('nik' , request()->nik)->first();
        if ($akbar != null) {
            return back()->with('nikSudah' , 'Nik sudah terdaftar');
        }
        $query = DB::table('customers')->insert([
            'nama_pelanggan' =>request()->input('nama_pelanggan'),
            'kode_customers' => '' , 
            'nik' =>request()->input('nik'),
            'no_hp'  =>request()->input('no_hp'),
            'alamat' => request()->input('alamat'),
        ]);
        
        // $data->jumlah_stok = $data->jumlah_stok - request()->input('jumlah_barang');
        // $data->save();
        $data = Customers::select('*')->orderBy('id','desc')->latest()->first();
        $kode = 'CO'.$data->id ;
        $data->kode_customers = $kode;
        $data->save();
         if($query){
             return redirect('/')->with('suksesTambah' , 'Data Pelanggan Berhasil di Tambahkan');
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
           return redirect('/detailCustomer'.'/'.$id)->with('edit','Data Berhasil Di Edit');
        }
     }
}

<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Http\Requests\StoreSupplyRequest;
use App\Http\Requests\UpdateSupplyRequest;
use App\Models\Stok;
use Illuminate\Support\Facades\DB;


class SupplyController extends Controller
{

    public function addSupply(){


        request()->validate([
             'nama_barang' => 'required' , 
             'nama_supplier' => 'required' , 
             'biaya' => 'required',
             'jumlah_stok' => 'required' , 
             'tanggal' => 'required' , 
           
             
         ]);
        $data = Stok::find(request()->nama_barang);

        $query = DB::table('supplies')->insert([
             'nama_barang' =>$data->nama_barang, 
             'nama_supplier'  =>request()->input('nama_supplier'),
             'biaya'  =>request()->input('biaya'),
             'jumlah_stok' =>request()->input('jumlah_stok'),
             'tanggal' => request()->input('tanggal'),
           
         ]);

        $data->jumlah_stok = $data->jumlah_stok + request()->jumlah_stok;
        $data->supplier = request()->nama_supplier;
        $data->save();

 
         if($query){
             return redirect('/dataSupply')->with('suksesTambahSupply' , 'Data Berhasil di Tambahkan');
         } 

             dd('gagal');
 
         
     }

     public function editSupply( $id){
        

       
        
        $data =  request()->validate([
            'nama_barang' =>'required' ,
            'nama_supplier'  =>'required',
            'biaya' => 'required',
            // 'jumlah_stok' =>'required',
            'tanggal' => 'required' , 
        ]);
        
        // $validatedData = [
        //     'nama_barang' => $data['nama_barang'] , 
        //     'supplier' => $data['nama_supplier'] , 
        //     'jumlah_stok' => $data['jumlah_stok'] , 
        //     'tanggal' => $data['tanggal'],
        // ];
        
        

        $cek = DB::table('supplies')->where('id' , $id)->update($data);
        if ($cek) {
            # code...
            return redirect('/dataSupply')->with('berhasilEditSupply' , 'Data Berhasil di Update');
        } else {

            
            return back()->with('nothing' , 'Tidak Ada Data yang Berubah');
        }


    }


     
     public function deleteSupply($id,$nama_supplier){
        $data = Supply::find($id);
        // $nama = Stok::has($nama_supplier);
        // if($nama){
           
        //     dd($nama);
        // }
        // // $nama->jumlah_stok = $nama->jumlah_stok - $data->jumlah_stok;
        // $nama->save();
        $delete =  $data->delete();
       if($delete){
        return back()->with('berhasilHapusSupply' , 'Data Berhasil di Hapus');
    } else {
        return back()->with('gagalHapus' , 'Data Gagal di Hapus');

    }
    }
  
}

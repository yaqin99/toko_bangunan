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

     public function editSupply( $id , $idStok){
        

       
        
        $dataUpdate =  request()->validate([
            // 'nama_barang' =>'required' ,
            'nama_supplier'  =>'required',
            'biaya' => 'required',
            'jumlah_stok' =>'required',
            'tanggal' => 'required' , 
        ]);
        
        // $validatedData = [
        //     'nama_barang' => $data['nama_barang'] , 
        //     'supplier' => $data['nama_supplier'] , 
        //     'jumlah_stok' => $data['jumlah_stok'] , 
        //     'tanggal' => $data['tanggal'],
        // ];

        $stok = DB::table('stoks')->select('*')->where('id',$idStok)->first();
        
        $data = Supply::find($id)->jumlah_stok ;
        $newStok =  $data - request()->input('jumlah_stok');;
       
        $totalStok = $stok->jumlah_stok - $newStok;
        DB::table('stoks')->where('id' , $stok->id)->update(['jumlah_stok' => $totalStok ]);
        
        

        $cek = DB::table('supplies')->where('id' , $id)->update($dataUpdate);
        if ($cek) {
            # code...
            return redirect('/dataSupply')->with('berhasilEditSupply' , 'Data Berhasil di Update');
        } else {

            
            return back()->with('nothing' , 'Tidak Ada Data yang Berubah');
        }


    }


     
     public function deleteSupply($id,$nama_barang){
        $data = Supply::find($id);
        $stok = DB::table('stoks')->select('*')->where('nama_barang',$nama_barang)->first();
        $newStok = $stok->jumlah_stok - $data->jumlah_stok ; 
        DB::table('stoks')->where('id' , $stok->id)->update(['jumlah_stok' => $newStok ]);
        $delete =  $data->delete();
       if($delete){
        return back()->with('berhasilHapusSupply' , 'Data Berhasil di Hapus');
    } else {
        return back()->with('gagalHapus' , 'Data Gagal di Hapus');

    }
    }
  
}

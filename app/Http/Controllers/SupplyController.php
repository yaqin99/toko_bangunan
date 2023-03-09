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

        if (request()->nama_barang === 'Pilih -') {
            return back()->with('lengkapi' , 'Harap Lengkapi Semua Data');
        }

        request()->validate([
             'nama_barang' => 'required' , 
             'nama_supplier' => 'required' , 
             'biaya' => 'required',
             'jumlah_stok' => 'required' , 
             'tanggal' => 'required' , 
           
             
         ]);


        $data = Stok::find(request()->nama_barang);

        $query = DB::table('supplies')->insert([
             'stok_id' =>request()->nama_barang, 
             'nama_supplier'  =>request()->input('nama_supplier'),
             'biaya'  =>request()->input('biaya'),
             'jumlah_stok' =>request()->input('jumlah_stok'),
             'tanggal' => request()->input('tanggal'),
           
         ]);

        $data->jumlah_stok = $data->jumlah_stok + request()->jumlah_stok;
        // $data->supplier = request()->nama_supplier;
        $data->save();

 
         if($query){
             return redirect('/dataSupply')->with('suksesTambahSupply' , 'Data Berhasil di Tambahkan');
         } 

             dd('gagal');
 
         
     }

     public function editSupply( $id){
        

       
        
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

        $data = Supply::find($id) ;
        $stok = DB::table('stoks')->select('*')->where('id',$data->stok->id)->first();
        
        $newStok =  $data->jumlah_stok - request()->input('jumlah_stok');;
       
        $totalStok = $stok->jumlah_stok - $newStok;
        DB::table('stoks')->where('id' , $data->stok->id)->update(['jumlah_stok' => $totalStok ]);
        
        

        $cek = DB::table('supplies')->where('id' , $id)->update($dataUpdate);
        if ($cek) {
            # code...
            return redirect('/dataSupply')->with('berhasilEditSupply' , 'Data Berhasil di Update');
        } else {

            
            return back()->with('nothing' , 'Tidak Ada Data yang Berubah');
        }


    }


     
     public function deleteSupply($id){
        $data = Supply::find($id);
        $stok = DB::table('stoks')->select('jumlah_stok')->where('id',$data->stok->id)->first();
        $newStok = $stok->jumlah_stok - $data->jumlah_stok ; 
        if ($newStok < 0) {
            return back()->with('tidakBoleh' , 'Mengahapus Data akan menyebabkan jumlah stok menjadi minus');
        }
        DB::table('stoks')->where('id' , $data->stok->id)->update(['jumlah_stok' => $newStok ]);
        $delete =  $data->delete();
       if($delete){
        return back()->with('berhasilHapusSupply' , 'Data Berhasil di Hapus');
    } else {
        return back()->with('gagalHapus' , 'Data Gagal di Hapus');

    }
    }
  
}

<?php

namespace App\Http\Controllers;

use App\Models\DetailHutang;
use App\Models\Hutang;
use App\Http\Requests\StoreDetailHutangRequest;
use App\Http\Requests\UpdateDetailHutangRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class DetailHutangController extends Controller
{
  
    public function addHutang(){


        request()->validate([
             'nama' => 'required',
             'total' => 'required' , 
             'bayar' => 'required' , 
             'sisa' => 'required' , 
             'tanggal' => 'required' , 
           
             
         ]);

       
        // $data = DB::table('hutangs')->select('nama' , 'kode')->where('kode',request()->nama_lama)->get();
       

 
           $ranStr = Str::random(5);
           $ranNum =  random_int(100, 10000);
           $kode = $ranStr.$ranNum ;
         DB::table('detail_hutangs')->insert([
            'nama'=>request()->input('nama'), 
            'kode' => $kode , 
            'total'  =>request()->input('total'),
            'bayar' =>request()->input('bayar'),
            'sisa' =>request()->input('sisa'),
            'tanggal' => request()->input('tanggal'),
           
         ]);

         $query = DB::table('hutangs')->insert([
            'nama'=>request()->input('nama'), 
            'kode' => $kode , 
            'total'  =>request()->input('total'),
            'bayar' =>request()->input('bayar'),
            'sisa' =>request()->input('sisa'),
           
         ]);

         if($query){
             return redirect('/dataHutang')->with('success' , 'Data Berhasil di Tambahkan');
         } 

             dd('gagal mek');
 
         
     }
    public function addHutangLama($kode , $nama){


        request()->validate([
             'total' => 'required' , 
             'bayar' => 'required' , 
             'sisa' => 'required' , 
             'tanggal' => 'required' , 
           
             
         ]);

       
       

 
           
        $query = DB::table('detail_hutangs')->insert([
            'nama'=>$nama, 
            'kode' => $kode , 
            'total'  =>request()->input('total'),
            'bayar' =>request()->input('bayar'),
            'sisa' =>request()->input('sisa'),
            'tanggal' => request()->input('tanggal'),
           
         ]);
         $data = DB::table('detail_hutangs')->orderBy('tanggal' , 'desc')->latest()->select('*')->where('kode',$kode)->first();

         DB::table('hutangs')->where('kode' , $kode)->update([
            "total" => $data->total , 
            "bayar" => $data->bayar,
            "sisa" => $data->sisa,
         ]);

       


         if($query){
             return redirect('/detailHutang'.'/'.$kode)->with('success' , 'Data Berhasil di Tambahkan');
         } 

             dd('gagal mek');
 
         
     }

     public function editDetailHutang( $id , $kode){
        

       
        
        request()->validate([
           
            'total' => 'required' , 
            'bayar' => 'required' , 
            'sisa' => 'required' , 
            'tanggal' => 'required' , 
          
            
        ]);
        
       
        
        $cek = DB::table('detail_hutangs')->where('id' , $id)->update([
            
            'total' => request()->input('total') , 
            'bayar' => request()->input('bayar') , 
            'sisa' => request()->input('sisa') , 
            'tanggal' => request()->input('tanggal') , 
            
        ]);
        
        $data = DB::table('detail_hutangs')->orderBy('tanggal' , 'desc')->latest()->select('*')->where('kode',$kode)->first();
        $hutang = DB::table('hutangs')->where('kode' , $kode)->update([
            "total" => $data->total , 
            "bayar" => $data->bayar,
            "sisa" => $data->sisa,
         ]);

        if ($cek && $hutang) {
            # code...
            return redirect('/detailHutang'.'/'.$kode)->with('berhasilEdit' , 'Data Berhasil di Update');
        } 

        // return redirect('/editStok'.'/'.$id)->with('nothing' , 'Tidak Ada Data yang Berubah');


    }

    public function deleteDetailHutang($id , $kode){
        $data = DetailHutang::find($id);
       $delete =  $data->delete();
       $data = DB::table('detail_hutangs')->orderBy('tanggal' , 'desc')->latest()->select('*')->where('kode',$kode)->first();
       $hutang = DB::table('hutangs')->where('kode' , $kode)->update([
           "total" => $data->total , 
           "bayar" => $data->bayar,
           "sisa" => $data->sisa,
        ]);
       if($delete && $hutang){
        return back()->with('berhasilHapus' , 'Data Berhasil di Hapus');
    } else {
        return back()->with('gagalHapus' , 'Data Gagal di Hapus');

    }
    }

}
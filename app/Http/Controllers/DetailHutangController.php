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
             'uang_masuk' => 'required' , 
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
            'uang_masuk' =>request()->input('uang_masuk'),
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
    public function addHutangLama($customer_id , $hutang_id , $tot , $bay , $sis,$nama){


        request()->validate([
          
             'uang_masuk' => 'required' , 
             'tanggal' => 'required' , 
           
             
         ]);
        $totalBayar = $bay + request()->input('uang_masuk') ; 
        $sisa = $tot - $totalBayar ; 
        if ($sisa < 0) {
            $sisa = 0 ; 
        }
        $query = DB::table('detail_hutangs')->insert([
            'customer_id' => $customer_id , 
            'hutang_id' => $hutang_id , 
            'total'  =>$tot,
            'bayar' =>$totalBayar , 
            'sisa' => $sisa ,
            'uang_masuk' =>request()->input('uang_masuk'),
            'tanggal' => request()->input('tanggal'),
           
         ]);
        
       
         DB::table('hutangs')->where('id' , $hutang_id)->update([
            "total" =>  $tot, 
            "bayar" => $totalBayar,
            "sisa" => $sisa,
         ]);

       


         if($query){
             return redirect('/detailHutang'.'/'.$hutang_id.'/'.$nama.'/'.$customer_id)->with('success' , 'Data Berhasil di Tambahkan');
         } 

             dd('gagal mek');
 
         
     }

     public function editDetailHutang( $id , $total , $bayar , $sisa , $hutang_id){

        request()->validate([
            'uang_masuk' => 'required' , 
            'tanggal' => 'required' , 
       
        ]);

        $totalBayar = request()->input('uang_masuk') - $total ; 
        $totalFix = $totalBayar + $total ; 
        $sisaHutang = $total - $totalFix ; 
        if ($sisaHutang < 0) {
            $sisaHutang = 0 ; 
        }
        $cek = DB::table('detail_hutangs')->where('id' , $id)->update([
           
            'bayar' => $totalFix , 
            'sisa' => $sisaHutang , 
            'uang_masuk' => request()->input('uang_masuk') , 
            'tanggal' => request()->input('tanggal') , 
            
        ]);

     
        
        $hutang = DB::table('hutangs')->where('id' , $hutang_id)->update([
            "total" => $total , 
            "bayar" => $totalFix,
            "sisa" => $sisaHutang,
         ]);

        if ($cek && $hutang) {
            # code...
            return redirect('/dataHutang')->with('berhasilEdit' , 'Data Berhasil di Update');
        } 

        // return redirect('/editStok'.'/'.$id)->with('nothing' , 'Tidak Ada Data yang Berubah');


    }

    public function deleteDetailHutang($id){
        $data = DetailHutang::find($id);
       $delete =  $data->delete();
       $element = DetailHutang::select('*')->orderBy('id' , 'desc')->latest()->where('hutang_id',$data->hutang->id)->first();
       $hutang = DB::table('hutangs')->where('id' , $data->hutang->id)->update([
           "total" => $element->total , 
           "bayar" => $element->bayar,
           "sisa" => $element->sisa,
        ]);
       if($delete && $hutang){
        return back()->with('berhasilHapus' , 'Data Berhasil di Hapus');
    } else {
        return back()->with('gagalHapus' , 'Data Gagal di Hapus');

    }
    }

}

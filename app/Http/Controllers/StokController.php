<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Stok;
use App\Http\Requests\StoreStokRequest;
use App\Http\Requests\UpdateStokRequest;
use Illuminate\Support\Facades\DB;


class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function deleteStok($id){
        $data = Stok::find($id);
       $delete =  $data->delete();

       if($delete){
        return back()->with('berhasilHapus' , 'Data Berhasil di Hapus');
    } else {
        return back()->with('gagalHapus' , 'Data Gagal di Hapus');

    }
    }

    public function addStok(Request $request){


        $request->validate([
             'nama_barang' => 'required' , 
             'jumlah_stok' => 'required' , 
             'nama_supplier' => 'required' , 
             'tanggal' => 'required' , 
           
             
         ]);
       
        $query = DB::table('stoks')->insert([
             'nama_barang' =>$request->input('nama_barang'), 
             'supplier'  =>$request->input('nama_supplier'),
             'jumlah_stok' =>$request->input('jumlah_stok'),
             'tanggal' => $request->input('tanggal'),
           
         ]);
 
         if($query){
             return redirect('/stokBarang')->with('success' , 'Data Berhasil di Tambahkan');
         } 

             dd('gagal mek');
 
         
     }


     public function editStok( $id){
        

       
        
        $data =  request()->validate([
            'nama_barang' =>'required' ,
            'nama_supplier'  =>'required',
            'jumlah_stok' =>'required',
            'tanggal' => 'required' , 
        ]);
        
        $validatedData = [
            'nama_barang' => $data['nama_barang'] , 
            'supplier' => $data['nama_supplier'] , 
            'jumlah_stok' => $data['jumlah_stok'] , 
            'tanggal' => $data['tanggal'],
        ];
        
        

        $cek = DB::table('stoks')->where('id' , $id)->update($validatedData);
        if ($cek) {
            # code...
            return redirect('/stokBarang')->with('berhasilEdit' , 'Data Berhasil di Update');
        } 

        return redirect('/editStok'.'/'.$id)->with('nothing' , 'Tidak Ada Data yang Berubah');


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStokRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStokRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function show(Stok $stok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function edit(Stok $stok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStokRequest  $request
     * @param  \App\Models\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStokRequest $request, Stok $stok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stok  $stok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stok $stok)
    {
        //
    }
}

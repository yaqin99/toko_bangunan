<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Supply;
class AdminController extends Controller
{
   public function index(){
        return view(
            'component.home' , [
                'title' => 'Home'
            ]
        );
   }
   public function dataPenjualan(){
        return view(
            'component.dataPenjualan' , 
            ["title" => 'Data Penjualan']
        );
   }
   public function stokBarang(){
        return view(
            'component.stok'
         , 
        [
            "stoks" => Stok::orderBy('id' , 'desc')->latest()->SearchStok()->paginate(10)->withQueryString(),
            "title" => 'Stok Barang' , 
        ]);
   }
   public function dataSupply(){
        return view(
            'component.dataSupply' , 
            [   "supplys" => Supply::orderBy('id' , 'desc')->latest()->SearchSupply()->paginate(10)->withQueryString(),
                "title" => 'Data Supply'
            ]
        );
   }
   public function dataHutang(){
        return view(
            'component.dataHutang' , [
                "title" => 'Data Hutang'
            ]
        );
   }
   public function addTransaksi(){
        return view(
            'component.addData.tambahTransaksi'
        );
   }
   public function addStok(){
        return view(
            'component.addData.tambahStok' , 
            ["title" => 'Tambah Stok']
        );
   }
   public function addSupply(){
    
    return view(
        'component.addData.tambahDataSupply' , 
        ["stoks" => Stok::all() , 
        "title" => "Tambah Catatan"
        ]
    );
}

   public function editStokLayout($id){
    $data = Stok::find($id);
    return view('component.editData.editStok' , [
        'stoks' => $data->where('id' , $id)->get(),
        'title' => "Edit Stok"
       
    ]);
   }

   public function addDataHutang(){
        return view(
            'component.addData.tambahDataHutang'
        );
   }
   
}

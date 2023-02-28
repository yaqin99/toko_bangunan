<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Supply;
use App\Models\Transaksi;
use App\Models\DetailHutang;
use App\Models\Hutang;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            ["title" => 'Data Penjualan',
            "transaksi" => Transaksi::orderBy('tanggal' , 'desc')->latest()->SearchTransaksi()->paginate(10)->withQueryString(),

            ]
        );
   }
   public function todayTransaksi(){
    $date =  Carbon::today()->toDateString();
    $data = Transaksi::select('*')->where('tanggal',$date)->orderBy('tanggal' , 'desc')->latest()->SearchTransaksi()->paginate(10)->withQueryString();
        return view(
            'component.todayTransaksi' , 
            ["title" => 'Data Penjualan Harian',
            "transaksi" => $data,

            ]
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
                'hutang' => Hutang::orderBy('id' , 'desc')->latest()->SearchHutang()->paginate(10)->withQueryString(),
                "title" => 'Data Hutang'
            ]
        );
   }
   public function detailHutang($kode){
    $data = DB::table('detail_hutangs')->orderBy('tanggal' , 'asc')->latest()->select('*')->where('kode',$kode)->paginate(10);
    
        return view(
            'component.detailHutang' , [
                'data' => $data,
                'kode' => $kode , 
                "title" => 'Rincian Hutang'
            ]
        );
   }
   public function cetakDetail($kode){
    $data = DB::table('detail_hutangs')->orderBy('tanggal' , 'asc')->latest()->select('*')->where('kode',$kode)->get();
    $nama = DB::table('detail_hutangs')->select('nama')->where('kode',$kode)->first();
        return view(
            'component.cetakDetail' , [
                'data' => $data,
                'nama' => $nama->nama,
                'kode' => $kode , 
                "title" => 'Cetak Detail'
            ]
        );
   }
   public function cetakStok(){
        return view(
            'component.cetakStok' , [
                'data' => Stok::all(),
                 
                "title" => 'Cetak Stok'
            ]
        );
   }
   public function cetakSupply(){
        return view(
            'component.cetakSupply' , [
                'data' => Supply::all(),
                 
                "title" => 'Cetak Supply'
            ]
        );
   }
   public function cetakPenjualan(){
        return view(
            'component.cetakPenjualan' , [
                'data' => Transaksi::all(),
                 
                "title" => 'Cetak Penjualan'
            ]
        );
   }
   public function cetakPenjualanHarian(){
    $date =  Carbon::today()->toDateString();
    $data = Transaksi::select('*')->where('tanggal',$date)->orderBy('tanggal' , 'desc')->latest()->get();
        return view(
            'component.cetakPenjualanHarian' , [
                'data' => $data,
                 
                "title" => 'Cetak Penjualan Harian'
            ]
        );
   }
   public function addTransaksi(){
        return view(
            'component.addData.tambahTransaksi' , 
            ["title" => "Tambah Transaksi" , 
            "stoks" => Stok::all() , 
            ]
        );
   }
   public function addStok(){
        return view(
            'component.addData.tambahStok' , 
            ["title" => 'Tambah Stok']
        );
   }

   public function addDataSupply(){
    
    return view(
        'component.addData.tambahSupply' , 
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
   public function editDetailHutangLayout($id , $nama , $kode){
    $data = DetailHutang::find($id);
    return view('component.editData.editDetailHutang' , [
        'details' => $data,
        'title' => "Edit Stok"
       
    ]);
   }
   public function editSupplyLayout($id , $nama_barang){
    $stok = DB::table('stoks')->select('*')->where('nama_barang',$nama_barang)->first();

    return view('component.editData.editSupply' , [
        'supplys' => Supply::find($id),
        'stok' => $stok , 
        'title' => "Edit Supply"
       
    ]);
   }
   public function editTransaksiLayout($id , $nama_barang){
    $data = Transaksi::find($id);
    $stok = DB::table('stoks')->select('*')->where('nama_barang',$nama_barang)->first();

    return view('component.editData.editTransaksi' , [
        'transaksis' =>Transaksi::find($id),
        'stok' =>$stok,
        'title' => "Edit Transaksi"
       
    ]);
   }

   public function addDataHutang(){
    
        return view(
            'component.addData.tambahDataHutang' , [
                
                "title" => "Tambah Catatan Piutang"
            ]
        );
   }
   public function addDataHutangLama($kode){
    
        return view(
            'component.addData.tambahDataHutangLama' , [
                "cuz" =>  DB::table('detail_hutangs')->select('*')->where('kode',$kode)->orderBy('tanggal' , 'desc')->latest()->first(),
                
                "title" => "Tambah Catatan Piutang"
            ]
        );
   }
   
}

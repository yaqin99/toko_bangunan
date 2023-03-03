<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Supply;
use App\Models\Transaksi;
use App\Models\DetailHutang;
use App\Models\Hutang;
use App\Models\Sementara;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
   public function index(){
    Sementara::query()->delete();
        return view(
            'component.home' , [
                'title' => 'Home'
            ]
        );
   }
   public function dataPenjualan(){
    Sementara::query()->delete();
        return view(
            'component.dataPenjualan' , 
            ["title" => 'Data Penjualan',
            "transaksi" => Transaksi::orderBy('tanggal' , 'desc')->latest()->SearchTransaksi()->paginate(10)->withQueryString(),

            ]
        );
   }
   public function dataCustomers(){
    Sementara::query()->delete();
        return view(
            'component.dataCustomers' , 
            ["title" => 'Data Customer',
            "customer" => Customers::orderBy('id' , 'desc')->latest()->SearchCustomers()->paginate(10)->withQueryString(),

            ]
        );
   }
   public function todayTransaksi(){
    $date =  Carbon::today()->toDateString();
    $data = Transaksi::select('*')->where('tanggal',$date)->orderBy('tanggal' , 'desc')->latest()->SearchTransaksi()->paginate(10)->withQueryString();
    $sementara = Sementara::all();
    $total = $sementara->sum('total_biaya');
    return view(
            'component.todayTransaksi' , 
            ["title" => 'Data Penjualan Harian',
            "transaksi" => $data,
            "sementara" => $sementara,
            "total" => $total , 
            "customers" => Customers::select('*')->orderBy('nama_pelanggan' , 'asc')->latest()->get(),
            ]
        );
   }
   public function stokBarang(){
    Sementara::query()->delete();
        return view(
            'component.stok'
         , 
        [
            "stoks" => Stok::orderBy('id' , 'desc')->latest()->SearchStok()->paginate(10)->withQueryString(),
            "title" => 'Stok Barang' , 
        ]);
   }
   public function dataSupply(){
    Sementara::query()->delete();
        return view(
            'component.dataSupply' , 
            [   "supplys" => Supply::orderBy('id' , 'desc')->latest()->SearchSupply()->paginate(10)->withQueryString(),
                "title" => 'Data Supply'
            ]
        );
   }
   public function dataHutang(){
    $data = Hutang::with('customer' , 'transaksi')->orderBy('id' , 'desc')->SearchHutang()->paginate(10)->withQueryString() ; 
    Sementara::query()->delete();
        return view(
            'component.dataHutang' , [
                'hutang' => $data , 
                "title" => 'Data Hutang'
            ]
        );
   }
   public function detailHutang($kode){
    Sementara::query()->delete();
    $data = DB::table('detail_hutangs')->orderBy('tanggal' , 'asc')->latest()->select('*')->where('kode',$kode)->paginate(10);
    
        return view(
            'component.detailHutang' , [
                'data' => $data,
                'kode' => $kode , 
                "title" => 'Rincian Hutang'
            ]
        );
   }
   public function detailTransaksi($kodeTransaksi){
    Sementara::query()->delete();
    $data = DB::table('detail_transaksis')->orderBy('tanggal' , 'asc')->latest()->select('*')->where('kode_transaksi',$kodeTransaksi)->paginate(10);
    
        return view(
            'component.detailTransaksi' , [
                'data' => $data,
                // 'kode' => $kode , 
                "title" => 'Detail Transaksi'
            ]
        );
   }
   public function cetakDetail($kode){
    Sementara::query()->delete();
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
    Sementara::query()->delete();
        return view(
            'component.cetakStok' , [
                'data' => Stok::all(),
                 
                "title" => 'Cetak Stok'
            ]
        );
   }
   public function cetakSupply(){
    Sementara::query()->delete();
        return view(
            'component.cetakSupply' , [
                'data' => Supply::all(),
                 
                "title" => 'Cetak Supply'
            ]
        );
   }
   public function cetakPenjualan(){
    Sementara::query()->delete();
        return view(
            'component.cetakPenjualan' , [
                'data' => Transaksi::all(),
                 
                "title" => 'Cetak Penjualan'
            ]
        );
   }
   public function cetakPenjualanHarian(){
    Sementara::query()->delete();
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
   public function addCustomers(){
        return view(
            'component.addData.tambahCustomers' , 
            ["title" => "Tambah Customer" , 
           
            ]
        );
   }
   public function addStok(){
    Sementara::query()->delete();
        return view(
            'component.addData.tambahStok' , 
            ["title" => 'Tambah Stok']
        );
   }

   public function addDataSupply(){
    Sementara::query()->delete();
    return view(
        'component.addData.tambahSupply' , 
        ["stoks" => Stok::all() , 
        "title" => "Tambah Catatan"
        ]
    );
}

   public function editStokLayout($id){
    Sementara::query()->delete();
    $data = Stok::find($id);
    return view('component.editData.editStok' , [
        'stoks' => $data->where('id' , $id)->get(),
        'title' => "Edit Stok"
       
    ]);
   }
   public function editDetailHutangLayout($id , $nama , $kode){
    Sementara::query()->delete();
    $data = DetailHutang::find($id);
    return view('component.editData.editDetailHutang' , [
        'details' => $data,
        'title' => "Edit Stok"
       
    ]);
   }
   public function editSupplyLayout($id , $nama_barang){
    Sementara::query()->delete();
    $stok = DB::table('stoks')->select('*')->where('nama_barang',$nama_barang)->first();

    return view('component.editData.editSupply' , [
        'supplys' => Supply::find($id),
        'stok' => $stok , 
        'title' => "Edit Supply"
       
    ]);
   }
   public function editTransaksiLayout($id , $nama_barang){
    Sementara::query()->delete();
    $data = Transaksi::find($id);
    $stok = DB::table('stoks')->select('*')->where('nama_barang',$nama_barang)->first();

    return view('component.editData.editTransaksi' , [
        'transaksis' =>Transaksi::find($id),
        'stok' =>$stok,
        'title' => "Edit Transaksi"
       
    ]);
   }

   public function addDataHutang(){
    Sementara::query()->delete();
        return view(
            'component.addData.tambahDataHutang' , [
                
                "title" => "Tambah Catatan Piutang"
            ]
        );
   }
   public function addDataHutangLama($kode){
    Sementara::query()->delete();
        return view(
            'component.addData.tambahDataHutangLama' , [
                "cuz" =>  DB::table('detail_hutangs')->select('*')->where('kode',$kode)->orderBy('tanggal' , 'desc')->latest()->first(),
                
                "title" => "Tambah Catatan Piutang"
            ]
        );
   }
   
}

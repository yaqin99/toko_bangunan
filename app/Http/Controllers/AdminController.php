<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\Supply;
use App\Models\Transaksi;
use App\Models\DetailHutang;
use App\Models\DetailTransaksi;
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
    // $roles = Customers::with('hutang')->select('*')->orderBy('nama_pelanggan' , 'asc')->latest()->SearchCustomer()->paginate(10)->withQueryString();
    // $totalHutang = Hutang::with(['customer' , 'transaksi'])->where('customer_id' , );
    
    $data = Customers::orderBy('nama_pelanggan' , 'asc')->latest()->SearchCustomer()->paginate(10)->withQueryString();
    // dd($data);
    return view(
            'component.dataCustomers' , 
            ["title" => 'Data Customer',
            "customer" => $data,

            ]
        );
   }
   public function todayTransaksi(){
    $date =  Carbon::today()->toDateString();
    $data = Transaksi::select('*')->where('tanggal',$date)->orderBy('tanggal' , 'desc')->latest()->SearchTransaksi()->paginate(10)->withQueryString();
    $sementara = Sementara::with('stok')->get();
    $total = $sementara->sum('total_biaya');
    return view(
            'component.todayTransaksi' , 
            ["title" => 'Data Penjualan Harian',
            "transaksi" => $data,
            "sementara" => $sementara,
            "total" => $total , 
            "customers" => Customers::select(['id' , 'nama_pelanggan' , 'kode_customers'])->orderBy('nama_pelanggan' , 'asc')->latest()->get(),
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
            [   "supplys" => Supply::with('stok')->orderBy('id' , 'desc')->latest()->SearchSupply()->paginate(10)->withQueryString(),
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
   public function detailHutang($id , $nama , $customer_id){
    Sementara::query()->delete();
    $data = DetailHutang::with('customer')->orderBy('tanggal' , 'asc')->latest()->select('*')->where('hutang_id',$id)->paginate(10);
    
    return view(
            'component.detailHutang' , [
                'data' => $data,
                'hutang_id' => $id , 
                'nama' => $nama,
                "customer_id" => $customer_id , 
                "title" => 'Rincian Hutang'
            ]
        );
   }
   public function detailTransaksi($kodeTransaksi){
    Sementara::query()->delete();
    $data = DetailTransaksi::with('stok')->orderBy('tanggal' , 'asc')->latest()->select('*')->where('kode_transaksi',$kodeTransaksi)->paginate(10);
    $single = DetailTransaksi::with('stok')->latest()->select('kode_transaksi')->where('kode_transaksi',$kodeTransaksi)->first();
   
        return view(
            'component.detailTransaksi' , [
                'data' => $data,
                'kode' => $single->kode_transaksi , 
                "title" => 'Detail Transaksi'
            ]
        );
   }
   public function detailSupply($id){
    Sementara::query()->delete();
    
    $data  = Supply::with('stok')->select('*')->where('stok_id',$id)->orderBy('tanggal','desc')->paginate(40);
   
        return view(
            'component.detailSupply' , [
                'data' => $data,
                "stok_id" => $id , 
                "title" => 'Detail Supply'
            ]
        );
   }
   public function detailCustomer($id){
    Sementara::query()->delete();
    
    $data  = Customers::select('*')->where('id',$id)->first();
   
        return view(
            'component.detailCustomer' , [
                'customer' => $data,
                
                "title" => 'Detail Customer'
            ]
        );
   }
   public function rincianHutang($id){
    Sementara::query()->delete();
    
    $data = Hutang::with('customer' , 'transaksi')->orderBy('id' , 'desc')->where('customer_id' , $id)->paginate(40); 
    $namaKode = Hutang::with('customer')->select('customer_id')->where('customer_id' , $id)->latest()->first(); 
    
        return view(
            'component.rincianHutang' , [
                'hutang' => $data,
                 'nama' => $namaKode->customer->nama_pelanggan , 
                 'kode' => $namaKode->customer->kode_customers , 
                "title" => 'Rincian Hutang'
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
   public function addDetailTransaksi($kode){
        return view(
            'component.addData.tambahDetailTransaksi' , 
            ["title" => "Tambah Detail Transaksi" , 
            "stoks" => Stok::all() , 
            "kode" => $kode , 
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
   public function addDataSupplyDetail($stok_id){
    Sementara::query()->delete();
    $data = Stok::select(['nama_barang' , 'id'])->where('id' , $stok_id)->latest()->first();
    return view(
        'component.addData.tambahSupplyDetail' , 
        ["data" => $data, 
        "title" => "Tambah Catatan"
        ]
    );
}

   public function editStokLayout($id){
    Sementara::query()->delete();
    $data = Stok::find($id);
    return view('component.editData.editStok' , [
        'data' => $data,
        'title' => "Edit Stok"
       
    ]);
   }
   public function editDetailHutangLayout($id ){
    Sementara::query()->delete();
    $data = DetailHutang::find($id);
    return view('component.editData.editDetailHutang' , [
        'details' => $data,
        'title' => "Edit Stok"
       
    ]);
   }
   public function editSupplyLayout($id){
    Sementara::query()->delete();
    $data = Supply::find($id);
    $stok = DB::table('stoks')->select('*')->where('id',$data->stok->id)->first();

    return view('component.editData.editSupply' , [
        'supplys' => $data,
        'stok' => $stok , 
        'title' => "Edit Supply"
       
    ]);
   }
   public function editCustomerLayout($id){
    Sementara::query()->delete();
    $data = Customers::find($id);
    return view('component.editData.editCustomer' , [
        'data' => $data,
       
        'title' => "Edit Customers"
       
    ]);
   }
   public function editTransaksiLayout($id){
    Sementara::query()->delete();
    // $data = Transaksi::find($id);
    // $stok = DB::table('stoks')->select('*')->where('nama_barang',$nama_barang)->first();

    return view('component.editData.editTransaksi' , [
        'transaksis' =>Transaksi::find($id),
        // 'stok' =>$stok,
        'title' => "Edit Transaksi"
       
    ]);
   }
   public function editDetailTransaksiLayout($id){
    Sementara::query()->delete();
    // $data = Transaksi::find($id);
    $detail = DetailTransaksi::with('stok')->select('*')->where('id',$id)->first();
    return view('component.editData.editDetailTransaksi' , [
        'detail' =>$detail,
        // 'stok' =>$stok,
        'title' => "Edit Detail Transaksi"
       
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
   public function addDataHutangLama($hutang_id , $nama,$customer_id){
    Sementara::query()->delete();
    $data = DB::table('detail_hutangs')->select('*')->where('hutang_id',$hutang_id)->orderBy('id' , 'desc')->latest()->first() ; 
        return view(
            'component.addData.tambahDataHutangLama' , [
                "cuz" =>  $data ,
                "nama" => $nama , 
                "customer_id" =>$customer_id,
                "title" => "Tambah Catatan Piutang"
            ]
        );
   }
   
}

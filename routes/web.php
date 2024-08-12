<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\DetailHutangController;
use App\Http\Controllers\SementaraController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\ZakatController;
use App\Http\Controllers\UserController;

// GET METHOD

Route::get('/',[AdminController::class , 'todayTransaksi'])->middleware('auth');
Route::get('/dataPenjualan',[AdminController::class , 'dataPenjualan']);
Route::get('/dataRekap',[AdminController::class , 'dataRekap']);
Route::get('/dataPajak',[PajakController::class , 'index']);
Route::get('/dataZakat',[ZakatController::class , 'index']);
Route::get('/stokBarang',[AdminController::class , 'stokBarang']);
Route::get('/dataHutang',[AdminController::class , 'dataHutang']);
Route::get('/dataSupply',[AdminController::class , 'dataSupply']);
Route::get('/dataCustomers',[AdminController::class , 'dataCustomers']);


Route::get('/signIn',[AdminController::class , 'signIn'])->name('login')->middleware('guest');
Route::get('/badayDaftarAdmin',[AdminController::class , 'signUp'])->middleware('guest');


Route::get('/detailHutang/{id}/{nama}/{customer_id}',[AdminController::class , 'detailHutang']);
Route::get('/detailTransaksi/{id}',[AdminController::class , 'detailTransaksi']);
Route::get('/detailSupply/{id}',[AdminController::class , 'detailSupply']);
Route::get('/rincianHutang/{id}',[AdminController::class , 'rincianHutang']);
Route::get('/detailCustomer/{id}',[AdminController::class , 'detailCustomer']);


Route::get('/cetakNota/{id}',[AdminController::class , 'cetakNota']);
Route::get('/cetakDetail/{kode}',[AdminController::class , 'cetakDetail']);
Route::get('/cetakStok',[AdminController::class , 'cetakStok']);
Route::get('/cetakHarian',[AdminController::class , 'cetakHarian']);
Route::get('/cetakSupply',[AdminController::class , 'cetakSupply']);
Route::get('/cetakPenjualan/{tanggal1}/{tanggal2}',[AdminController::class , 'cetakPenjualan']);
Route::get('/cetakSupply/{tanggal1}/{tanggal2}',[AdminController::class , 'cetakSupply']);
Route::get('/cetakRekap/{tanggal1}/{tanggal2}',[AdminController::class , 'cetakRekap']);
Route::get('/rincianHutang/cetakHutang/{id}/{tanggal1}/{tanggal2}',[AdminController::class , 'cetakHutang']);
Route::get('/cetakPenjualanHarian',[AdminController::class , 'cetakPenjualanHarian']);


Route::get('/addTransaksi',[AdminController::class , 'addTransaksi']);
Route::get('/addDetailTransaksi/{id}/{kode}',[AdminController::class , 'addDetailTransaksi']);
Route::get('/addStok',[AdminController::class , 'addStok']);
Route::get('/addDataHutang',[AdminController::class , 'addDataHutang']);
Route::get('/addDataHutangLama/{hutang_id}/{nama}/{customer_id}',[AdminController::class , 'addDataHutangLama']);
Route::get('/bayarHutang/{sisa}/{customer_id}',[AdminController::class , 'bayarHutang']);
Route::get('/addDataSupply',[AdminController::class , 'addDataSupply']);
Route::get('/addDataSupplyDetail/{stok_id}',[AdminController::class , 'addDataSupplyDetail']);
Route::get('/addCustomers',[AdminController::class , 'addCustomers']);


Route::get('/editStok/{id}',[AdminController::class , 'editStokLayout']);
Route::get('/editSupply/{id}',[AdminController::class , 'editSupplyLayout']);
Route::get('/editTransaksi/{id}',[AdminController::class , 'editTransaksiLayout']);
Route::get('/editDetailTransaksi/{id}/{transaksi_id}',[AdminController::class , 'editDetailTransaksiLayout']);
Route::get('/editDetailHutang/{id}',[AdminController::class , 'editDetailHutangLayout']);
Route::get('/editCustomer/{id}',[AdminController::class , 'editCustomerLayout']);

// POST METHOD
Route::post('/addStok',[StokController::class , 'addStok']);
Route::post('/addZakat',[ZakatController::class , 'addZakat']);
Route::post('/addKonsumsi',[AdminController::class , 'addKonsumsi']);
Route::post('/bayarHutang/{customer_id}/{sisa}',[HutangController::class , 'bayarHutang']);
Route::post('/addPenjualan/{total}',[SementaraController::class , 'addPenjualan']);
Route::post('/addSupply',[SupplyController::class , 'addSupply']);
Route::post('/addTransaksi',[TransaksiController::class , 'addTransaksi']);
Route::post('/addDetailTransaksi/{id}/{kode}',[DetailTransaksiController::class , 'addDetailTransaksi']);
Route::post('/addCustomers',[CustomersController::class , 'addCustomers']);
Route::post('/addCustomersModal',[CustomersController::class , 'addCustomersModal']);
Route::post('/addDataHutang',[DetailHutangController::class , 'addHutang']);
Route::post('/addDataHutangLama/{customer_id}/{hutang_id}/{tot}/{bay}/{sis}/{nama}',[DetailHutangController::class , 'addHutangLama']);



//AUTHENTICATION
Route::post('/signIn',[UserController::class , 'signIn']);
Route::post('/signUp',[UserController::class , 'signUp']);
Route::post('/logOut',[UserController::class , 'logOut']);





// DELETE METHOD
Route::get('/lunas/{customer_id}/{sisa}' , [HutangController::class , 'lunas']);
Route::get('/deleteStok/{id}' , [StokController::class , 'deleteStok']);
Route::get('/deleteZakat/{id}' , [ZakatController::class , 'destroy']);
Route::get('/deleteSementara/{id}' , [SementaraController::class , 'delete']);
Route::get('/deleteSupply/{id}' , [SupplyController::class , 'deleteSupply']);
Route::get('/deleteTransaksi/{id}/{kode_transaksi}' , [TransaksiController::class , 'deleteTransaksi']);
Route::get('/deleteDetailHutang/{id}' , [DetailHutangController::class , 'deleteDetailHutang']);


// PUT METHOD 
Route::put('/editPajak/{id}', [PajakController::class , 'editPajak']);
Route::put('/editPajak/{id}', [PajakController::class , 'editPajak']);
Route::put('/editStok/{id}', [StokController::class , 'editStok']);
Route::put('/editSupply/{id}',[SupplyController::class , 'editSupply']);
Route::put('/editTransaksi/{id}/{kode_transaksi}',[TransaksiController::class , 'editTransaksi']);
Route::put('/editDetailTransaksi/{id}/{transaksi_id}',[DetailTransaksiController::class , 'editDetailTransaksi']);
Route::put('/editDetailHutang/{id}/{total}/{bayar}/{sisa}/{hutang_id}',[DetailHutangController::class , 'editDetailHutang']);
Route::put('/editCustomer/{id}',[CustomersController::class , 'editCustomer']);


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

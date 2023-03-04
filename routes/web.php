<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailHutangController;
use App\Http\Controllers\SementaraController;
use App\Http\Controllers\CustomersController;

// GET METHOD

Route::get('/',[AdminController::class , 'todayTransaksi']);
Route::get('/dataPenjualan',[AdminController::class , 'dataPenjualan']);
Route::get('/stokBarang',[AdminController::class , 'stokBarang']);
Route::get('/dataHutang',[AdminController::class , 'dataHutang']);
Route::get('/dataSupply',[AdminController::class , 'dataSupply']);
Route::get('/dataCustomers',[AdminController::class , 'dataCustomers']);


Route::get('/detailHutang/{id}/{nama}/{customer_id}',[AdminController::class , 'detailHutang']);
Route::get('/detailTransaksi/{kode_transaksi}',[AdminController::class , 'detailTransaksi']);


Route::get('/cetakDetail/{kode}',[AdminController::class , 'cetakDetail']);
Route::get('/cetakStok',[AdminController::class , 'cetakStok']);
Route::get('/cetakSupply',[AdminController::class , 'cetakSupply']);
Route::get('/cetakPenjualan',[AdminController::class , 'cetakPenjualan']);
Route::get('/cetakPenjualanHarian',[AdminController::class , 'cetakPenjualanHarian']);


Route::get('/addTransaksi',[AdminController::class , 'addTransaksi']);
Route::get('/addStok',[AdminController::class , 'addStok']);
Route::get('/addDataHutang',[AdminController::class , 'addDataHutang']);
Route::get('/addDataHutangLama/{hutang_id}/{nama}/{customer_id}',[AdminController::class , 'addDataHutangLama']);
Route::get('/addDataSupply',[AdminController::class , 'addDataSupply']);
Route::get('/addCustomers',[AdminController::class , 'addCustomers']);


Route::get('/editStok/{id}',[AdminController::class , 'editStokLayout']);
Route::get('/editSupply/{id}/{nama_barang}',[AdminController::class , 'editSupplyLayout']);
Route::get('/editTransaksi/{id}',[AdminController::class , 'editTransaksiLayout']);
Route::get('/editDetailHutang/{id}/{nama_barang}/{kode}',[AdminController::class , 'editDetailHutangLayout']);

// POST METHOD
Route::post('/addStok',[StokController::class , 'addStok']);
Route::post('/addPenjualan/{total}/{sementara}',[SementaraController::class , 'addPenjualan']);
Route::post('/addSupply',[SupplyController::class , 'addSupply']);
Route::post('/addTransaksi',[TransaksiController::class , 'addTransaksi']);
Route::post('/addCustomers',[CustomersController::class , 'addCustomers']);
Route::post('/addDataHutang',[DetailHutangController::class , 'addHutang']);
Route::post('/addDataHutangLama/{customer_id}/{hutang_id}/{tot}/{bay}/{sis}',[DetailHutangController::class , 'addHutangLama']);


// DELETE METHOD
Route::get('/deleteStok/{id}' , [StokController::class , 'deleteStok']);
Route::get('/deleteSementara/{id}' , [SementaraController::class , 'delete']);
Route::get('/deleteSupply/{id}/{nama_barang}/' , [SupplyController::class , 'deleteSupply']);
Route::get('/deleteTransaksi/{id}/{kode_transaksi}' , [TransaksiController::class , 'deleteTransaksi']);
Route::get('/deleteDetailHutang/{id}/{kode}' , [DetailHutangController::class , 'deleteDetailHutang']);


// PUT METHOD 
Route::put('/editStok/{id}', [StokController::class , 'editStok']);
Route::put('/editSupply/{id}/{idStok}',[SupplyController::class , 'editSupply']);
Route::put('/editTransaksi/{id}',[TransaksiController::class , 'editTransaksi']);
Route::put('/editDetailHutang/{id}/{kode}',[DetailHutangController::class , 'editDetailHutang']);

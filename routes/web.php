<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailHutangController;


// GET METHOD

Route::get('/',[AdminController::class , 'index']);
Route::get('/dataPenjualan',[AdminController::class , 'dataPenjualan']);
Route::get('/stokBarang',[AdminController::class , 'stokBarang']);
Route::get('/dataHutang',[AdminController::class , 'dataHutang']);
Route::get('/dataSupply',[AdminController::class , 'dataSupply']);
Route::get('/detailHutang/{kode}',[AdminController::class , 'detailHutang']);
Route::get('/addTransaksi',[AdminController::class , 'addTransaksi']);
Route::get('/addStok',[AdminController::class , 'addStok']);
Route::get('/addDataHutang',[AdminController::class , 'addDataHutang']);
Route::get('/addDataHutangLama/{kode}',[AdminController::class , 'addDataHutangLama']);
Route::get('/addDataSupply',[AdminController::class , 'addDataSupply']);


Route::get('/editStok/{id}',[AdminController::class , 'editStokLayout']);
Route::get('/editSupply/{id}/{nama_barang}',[AdminController::class , 'editSupplyLayout']);
Route::get('/editTransaksi/{id}/{nama_barang}',[AdminController::class , 'editTransaksiLayout']);

// POST METHOD
Route::post('/addStok',[StokController::class , 'addStok']);
Route::post('/addSupply',[SupplyController::class , 'addSupply']);
Route::post('/addTransaksi',[TransaksiController::class , 'addTransaksi']);
Route::post('/addDataHutang',[DetailHutangController::class , 'addHutang']);
Route::post('/addDataHutangLama/{kode}/{nama}',[DetailHutangController::class , 'addHutangLama']);


// DELETE METHOD
Route::get('/deleteStok/{id}' , [StokController::class , 'deleteStok']);
Route::get('/deleteSupply/{id}/{nama_barang}/' , [SupplyController::class , 'deleteSupply']);
Route::get('/deleteTransaksi/{id}/{nama_barang}/' , [TransaksiController::class , 'deleteTransaksi']);


// PUT METHOD 
Route::put('/editStok/{id}', [StokController::class , 'editStok']);
Route::put('/editSupply/{id}/{idStok}',[SupplyController::class , 'editSupply']);
Route::put('/editTransaksi/{id}/{idStok}',[TransaksiController::class , 'editTransaksi']);

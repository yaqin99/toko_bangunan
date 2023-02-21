<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplyController;


// GET METHOD

Route::get('/',[AdminController::class , 'index']);
Route::get('/dataPenjualan',[AdminController::class , 'dataPenjualan']);
Route::get('/stokBarang',[AdminController::class , 'stokBarang']);
Route::get('/dataHutang',[AdminController::class , 'dataHutang']);
Route::get('/dataSupply',[AdminController::class , 'dataSupply']);
Route::get('/addTransaksi',[AdminController::class , 'addTransaksi']);
Route::get('/addStok',[AdminController::class , 'addStok']);
Route::get('/addDataHutang',[AdminController::class , 'addDataHutang']);
Route::get('/addDataSupply',[AdminController::class , 'addDataSupply']);

Route::get('/editStok/{id}',[AdminController::class , 'editStokLayout']);
Route::get('/editSupply/{id}',[AdminController::class , 'editSupplyLayout']);

// POST METHOD
Route::post('/addStok',[StokController::class , 'addStok']);
Route::post('/addSupply',[SupplyController::class , 'addSupply']);


// DELETE METHOD
Route::get('/deleteStok/{id}' , [StokController::class , 'deleteStok']);
Route::get('/deleteSupply/{id}/{nama_supplier}/' , [SupplyController::class , 'deleteSupply']);


// PUT METHOD 
Route::put('/editStok/{id}', [StokController::class , 'editStok']);
Route::put('/editSupply/{id}',[SupplyController::class , 'editSupply']);

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

   

    public function transaksi(){

        return $this->hasOne(Transaksi::class);
       
      }
    public function stok(){

        return $this->belongsTo(Stok::class);
       
      }
}

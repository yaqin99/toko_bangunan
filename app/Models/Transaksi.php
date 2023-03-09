<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public function scopeSearchTransaksi($query ){
      if (request('searchTransaksi') || request('searchTransaksi2')) {
        $query->whereBetween('tanggal',[request('searchTransaksi') , request('searchTransaksi2')]);
        // ->orWhere('nama_kategori','like','%'.request('search').'%');
    } 
    }

      public function detailTransaksi(){

        return $this->belongsTo(DetailTransaksi::class);
       
      }
      public function hutang(){

        return $this->belongsTo(Hutang::class);
       
      }
      public function detailHutang(){

        return $this->hasOne(DetailHutang::class);
       
      }
}

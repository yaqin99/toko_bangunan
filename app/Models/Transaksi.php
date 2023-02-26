<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public function scopeSearchTransaksi($query ){
        if (request('searchTransaksi')) {
          $query->where('nama_barang','like','%'.request('searchTransaksi')
          );
          // ->orWhere('nama_kategori','like','%'.request('search').'%');
      } 
      }
}

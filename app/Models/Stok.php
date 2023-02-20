<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeSearchStok($query ){
      if (request('search')) {
        $query->where('nama_barang','like','%'.request('search').'%')->orWhere(
            'supplier','like','%'.request('search').'%'
        );
        // ->orWhere('nama_kategori','like','%'.request('search').'%');
    } 
    }
}

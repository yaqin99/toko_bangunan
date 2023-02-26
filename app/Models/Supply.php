<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeSearchSupply($query ){
      if (request('searchSupply')) {
        $query->where('nama_barang','like','%'.request('searchSupply').'%')->orWhere(
            'nama_supplier','like','%'.request('searchSupply').'%'
        );
        // ->orWhere('nama_kategori','like','%'.request('search').'%');
    } 
    }

    public function stok(){

        return $this->belongsTo(Stok::class);
       
      }
}

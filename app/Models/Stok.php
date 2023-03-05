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
        $query->where('nama_barang','like','%'.request('search').'%');
        // ->orWhere('nama_kategori','like','%'.request('search').'%');
    } 
    }

    public function supply(){
        return $this->hasMany(Supply::class);
    }
    public function detailTransaksi(){

        return $this->hasMany(DetailTransaksi::class);
       
      }
    public function sementara(){

        return $this->hasMany(Sementara::class);
       
      }
}

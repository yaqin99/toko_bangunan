<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

   

    public function scopeSearchCustomer($query ){
        if (request('search')) {
          $query->where('nama_pelanggan','like','%'.request('search').'%')
          ->orWhere('nik','like','%'.request('search').'%');
      }
      }
  

      public function hutang(){
        //HARUS SPESIFY IDNYA
        return $this->hasMany(Hutang::class , 'id');
    }
      public function detailHutang(){
        return $this->hasMany(DetailHutang::class, 'customer_id');
    }
      public function bayar(){
        return $this->hasMany(Bayar::class);
    }
}

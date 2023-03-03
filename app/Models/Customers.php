<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

   

    public function scopeSearchCustomers($query ){
        if (request('searchCustomers')) {
          $query->where('nama_pelanggan','like','%'.request('searchCustomers').'%')
          ->orWhere('alamat','like','%'.request('search').'%');
      } 
      }
  

      public function hutang(){
        return $this->hasMany(Hutang::class, 'customer_id');
    }
}

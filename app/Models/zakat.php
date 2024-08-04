<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zakat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeSearchZakat($query ){
      
        if (request('searchZakat') || request('searchZakat2')) {
          $query->whereBetween('tanggal',[request('searchZakat') , request('searchZakat2')]);
          // ->orWhere('nama_kategori','like','%'.request('search').'%');
      } 
      }
}

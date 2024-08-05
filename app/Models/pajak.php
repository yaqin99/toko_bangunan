<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pajak extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeSearchPajak($query ){
      
        if (request('searchPajak') || request('searchPajak2')) {
          $query->whereBetween('tanggal',[request('searchPajak') , request('searchPajak2')]);
          // ->orWhere('nama_kategori','like','%'.request('search').'%');
      } 
      }
}

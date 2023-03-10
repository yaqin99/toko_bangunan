<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    use HasFactory;

    public function scopeSearchRekap($query ){
    //     if (request('searchRekap') || request('searchRekap2')) {
    //       $query->whereBetween('tanggal',[request('searchRekap') , request('searchRekap2')]);
    //       // ->orWhere('nama_kategori','like','%'.request('search').'%');
    //   } 
      if (request('searchRekap') || request('searchRekap2')) {
        $query->where(function($query) {
            $query->whereBetween('tanggal',[request('searchRekap') , request('searchRekap2')]);
                  
          });
        
        
       
    }
      }
}

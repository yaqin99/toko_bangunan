<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function scopeSearchHutang($query ){
      if (request('searchHutang')) {
        $query->where('nama','like','%'.request('searchHutang').'%');
        // ->orWhere('nama_kategori','like','%'.request('search').'%');
    } 
    }

    public function detailHutang(){
        return $this->hasMany(DetailHutang::class);
    }
}

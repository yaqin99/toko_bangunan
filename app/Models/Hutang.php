<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Hutang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function scopeSearchHutang($query ){
        if (request('searchRincian') || request('searchRincian')) {
            $query->where(function($query) {
                $query->whereBetween('tanggal',[request('searchRincian') , request('searchRincian2')]);
                      
              });
            
            
           
        }
            
            // ->orWhere('nama_kategori','like','%'.request('search').'%');
        
    //   if (request('searchRincian') || request('searchRincian2')) {
    //     $query->whereHas('customer',function (Builder $query) {
    //         $query->where('nama_pelanggan', 'like', '%'.request('searchHutang').'%')->orWhere('kode_customers','like','%'.request('searchHutang').'%');
    //     });
        
    //     //
    // } 
    // // if (request()->input('searchHutang')) {
    // //     $search_text = request()->input('searchHutang');
    // //     $query->where('nama_pelanggan', 'Like', '%' . $search_text . '%')
    // //     ->orWhereHas('customer', function ($query2)use($search_text) {
    // //         $query2->where('nama_pelanggan', 'Like', '%' . $search_text . '%');
    // //     });
    // // }
    }

    public function detailHutang(){
        return $this->hasMany(DetailHutang::class );
    }
    // public function customer(){
    //     return $this->belongsToMany(Customers::class , 'hutang_customer' , 'hutang_id' , 'customer_id');
    // }
    public function customer(){
        return $this->belongsTo(Customers::class);
    }
    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }
}

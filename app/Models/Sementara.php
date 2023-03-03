<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sementara extends Model
{
    use HasFactory;

    public function stok(){

        return $this->belongsTo(Stok::class);
       
      }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailHutang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function hutang(){
        return $this->belongsTo(Hutang::class);
    }
}

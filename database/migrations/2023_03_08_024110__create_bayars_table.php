<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBayarsTable extends Migration
{
    public function up()
    {
        Schema::create('bayars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->string('keterangan');
            $table->date('tanggal');
            $table->integer('total');
            $table->integer('bayar');
            $table->integer('sisa');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

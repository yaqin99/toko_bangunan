<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailHutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_hutangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->foreignId('hutang_id');
            $table->integer('total');
            $table->integer('bayar');
            $table->integer('sisa');
            $table->integer('uang_masuk');
            $table->date('tanggal');
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
        Schema::dropIfExists('detail_hutangs');
    }
}

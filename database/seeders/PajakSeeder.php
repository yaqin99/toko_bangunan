<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PajakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pajaks')->insert(
            [
                'nominal' => "000000" , 
                'tanggal' => "2012-12-12 00:00:00" , 
               
            ]
            );
    }
}

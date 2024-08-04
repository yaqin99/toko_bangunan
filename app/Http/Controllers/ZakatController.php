<?php

namespace App\Http\Controllers;

use App\Models\zakat;
use App\Models\Stok;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ZakatController extends Controller
{
    public function addZakat(Request $request){
        $adding = zakat::create([
            'nominal' => request('totalZakat2'), 
            'tanggal' =>  request('tanggal'), 
        ]);

        if ($adding) {
            return redirect('/dataZakat');
        }
    }
   
    public function index()
    {
        $total = [];
        $data = Zakat::searchZakat()->paginate(1);
        $stok = Stok::all();
        foreach ($stok as $key) {
          $x = $key['jumlah_stok']*$key['harga_satuan'];
          $y = array_push($total ,$x );
        }
        $jumlah = array_sum($total);
        
        $title = 'Zakat';
        return view(
            'component.zakat' , [
                'data' => $data , 
                'title' => $title , 
                'sigma_stok' => $jumlah,
            ]
        );
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show(zakat $zakat)
    {
        //
    }

  
    public function edit(zakat $zakat)
    {
        //
    }

  
    public function update(Request $request, zakat $zakat)
    {
        //
    }

  
    public function destroy(zakat $zakat , $id)
    {
        $del = $zakat::where('id' , $id)->delete();

        if ($del) {
        return redirect('/dataZakat');
        }
    }
}

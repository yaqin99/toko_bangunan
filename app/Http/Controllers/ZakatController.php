<?php

namespace App\Http\Controllers;

use App\Models\zakat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ZakatController extends Controller
{
   
    public function index()
    {
        $data = Zakat::all();
        $title = 'Zakat';
        return view(
            'component.zakat' , [
                'data' => $data , 
                'title' => $title , 
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

  
    public function destroy(zakat $zakat)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\pajak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PajakController extends Controller
{
   
    public function index()
    {
        $data = Pajak::all();
        return view(
            'component.pajak' , [
                'data' => $data , 
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    
}

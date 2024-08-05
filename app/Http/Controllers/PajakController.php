<?php

namespace App\Http\Controllers;

use App\Models\pajak;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PajakController extends Controller
{
   
    public function index()
    {
        $data = Pajak::searchPajak()->paginate(15);
        $title = 'Pajak' ; 
        return view(
            'component.pajak' , [
                'data' => $data , 
                'title' => $title , 
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

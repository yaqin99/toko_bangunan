<?php

namespace App\Http\Controllers;

use App\Models\HutangCustomer;
use App\Http\Requests\StoreHutangCustomerRequest;
use App\Http\Requests\UpdateHutangCustomerRequest;

class HutangCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHutangCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHutangCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HutangCustomer  $hutangCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(HutangCustomer $hutangCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HutangCustomer  $hutangCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(HutangCustomer $hutangCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHutangCustomerRequest  $request
     * @param  \App\Models\HutangCustomer  $hutangCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHutangCustomerRequest $request, HutangCustomer $hutangCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HutangCustomer  $hutangCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(HutangCustomer $hutangCustomer)
    {
        //
    }
}

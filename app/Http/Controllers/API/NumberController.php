<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Number;

class NumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = 5;
        $dtac = Number::limit($limit)
            ->where('operator','dtac')
            ->orderBy('price','desc');
        
        $ais = Number::limit($limit)
            ->where('operator','ais')
            ->orderBy('price','desc');

        $happy = Number::limit($limit)
            ->where('operator','happy')
            ->orderBy('price','desc');

        $truemove = Number::limit($limit)
            ->where('operator','truemove')
            ->orderBy('price','desc');

        $numbers = $dtac->union($happy)
            ->union($ais)
            ->union($truemove)
            ->orderBy('price','desc')
            ->get();
        return $numbers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

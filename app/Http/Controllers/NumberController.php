<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Number;
use Illuminate\Http\Request;

class NumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $operator = $request->get('operator');
        $range = $request->get('range');
        $sum = $request->get('sum');
        //$numbers = $request->get('number');
        $perPage = 25;
        /*
        
        $sum = 0;
        foreach($numbers as $number){
            if(!empty($number)){
                $sum += $number;
            }
        }*/

        if (!empty($keyword)||!empty($operator)||!empty($sum)) {
            $number = Number::where('operator', 'LIKE', "%$operator%")
                //->where('number', 'LIKE', "%$keyword%")
                ->where('price', '<', $range)
                ->where('total',  $sum)
                ->latest()->paginate($perPage);
        } else {
            $number = Number::latest()->paginate($perPage);
        }

        return view('number.index', compact('number'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('number.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Number::create($requestData);

        return redirect('number')->with('flash_message', 'Number added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $number = Number::findOrFail($id);

        return view('number.show', compact('number'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $number = Number::findOrFail($id);

        return view('number.edit', compact('number'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $number = Number::findOrFail($id);
        $number->update($requestData);

        return redirect('number')->with('flash_message', 'Number updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Number::destroy($id);

        return redirect('number')->with('flash_message', 'Number deleted!');
    }
}

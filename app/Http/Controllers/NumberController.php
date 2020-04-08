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
        $total = $request->get('total');
        $price = $request->get('price');
        $sort = $request->get('sort','asc');
        $numbers = $request->get('numbers');
        
        $perPage = 100;
        
        
        $filter_number_string = "____________";
        if( is_array($numbers) ){
            for($i=0; $i<count($numbers); $i++){
                if( !empty($numbers[$i]) ){
                    $filter_number_string[$i] = $numbers[$i];
                }
            }
        }


        $needFilter = !empty($keyword) || !empty($operator) || !empty($sum)  || !empty($price) ;
        if ($needFilter) {
            $number = Number::where('operator', 'LIKE', "%$operator%")
                ->where('price', '<', $price)
                ->where('total', 'LIKE', "%$total%")
                ->where('number', 'LIKE', $filter_number_string)
                ->where('number', 'LIKE', "%$keyword%")
                ->orderBy('price', $sort)
                ->latest()->paginate($perPage);
        } else {
            $number = Number::orderBy('price', 'asc')->latest()->paginate($perPage);
        }

        
        $total_array = Number::selectRaw('total,count(total) as count')
            ->orderBy('total', 'asc')
            ->groupBy('total')
            ->get();

        $operator_array = Number::selectRaw('operator,count(operator) as count')
            ->orderBy('operator', 'asc')
            ->groupBy('operator')
            ->get();


        return view('number.index', compact('number','total_array','operator_array'));
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

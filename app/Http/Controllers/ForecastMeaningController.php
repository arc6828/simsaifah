<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ForecastMeaning;
use Illuminate\Http\Request;

class ForecastMeaningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $forecastmeaning = ForecastMeaning::where('number', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->orWhere('position', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $forecastmeaning = ForecastMeaning::latest()->paginate($perPage);
        }

        return view('forecast-meaning.index', compact('forecastmeaning'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('forecast-meaning.create');
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
        
        ForecastMeaning::create($requestData);

        return redirect('forecast-meaning')->with('flash_message', 'ForecastMeaning added!');
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
        $forecastmeaning = ForecastMeaning::findOrFail($id);

        return view('forecast-meaning.show', compact('forecastmeaning'));
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
        $forecastmeaning = ForecastMeaning::findOrFail($id);

        return view('forecast-meaning.edit', compact('forecastmeaning'));
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
        
        $forecastmeaning = ForecastMeaning::findOrFail($id);
        $forecastmeaning->update($requestData);

        return redirect('forecast-meaning')->with('flash_message', 'ForecastMeaning updated!');
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
        ForecastMeaning::destroy($id);

        return redirect('forecast-meaning')->with('flash_message', 'ForecastMeaning deleted!');
    }
}

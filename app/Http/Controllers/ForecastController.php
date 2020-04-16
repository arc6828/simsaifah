<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Forecast;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tel = $request->get('tel');
        //$grade = $request->get('grade');

        //$arr1 = str_split($str);

        //$length = count($array);
        return $this->forecast($tel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('forecast.create');
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
        
        Forecast::create($requestData);

        return redirect('forecast')->with('flash_message', 'Forecast added!');
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
        $forecast = Forecast::findOrFail($id);

        return view('forecast.show', compact('forecast'));
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
        $forecast = Forecast::findOrFail($id);

        return view('forecast.edit', compact('forecast'));
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
        
        $forecast = Forecast::findOrFail($id);
        $forecast->update($requestData);

        return redirect('forecast')->with('flash_message', 'Forecast updated!');
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
        Forecast::destroy($id);

        return redirect('forecast')->with('flash_message', 'Forecast deleted!');
    }

    public function forecast($tel)
    {
        if(empty($tel)){
            $forecast = "";
        } else {
            $array = [];
            $array = str_split($tel);
            $set1 = $array[1] . $array[2];
            $set2 = $array[2] . $array[3];
            $set3 = $array[3] . $array[4];
            $set4 = $array[4] . $array[5];
            $set5 = $array[5] . $array[6];
            $set6 = $array[6] . $array[7];
            $set7 = $array[7] . $array[8];
            $set8 = $array[8] . $array[9];

            //echo " " . $set1;
            //echo " " . $set2;
            //echo " " . $set3;
            //echo " " . $set4;
            //echo " " . $set5;
            //echo " " . $set6;
            //echo " " . $set7;
            //echo " " . $set8;

            //strpos
            //$array = array("color" => array("blue", "red", "green"),
                       //"size"  => array("small", "medium", "large"));

            $goodarr = array("14","15","16","19","22","23","24","26","28","29","32","35","36","39","41","42","44","45",
            "46","49","51","53","54","55","56","59","61","62","63","64","65","66","69","78","79","82","87","89","91",
            "92","93","94","95","96","97","98","99");
            
            $medarr = array("33","47","74");

            $badarr = array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","17","18","20","21",
            "25","27","30","31","34","37","38","40","43","48","50","52","57","58","60","67","68","70",
            "71","72","73","75","76","77","80","81","83","84","85","86","88","90");

            //good
            if (in_array($set1, $goodarr))
            {
                $grade1 = 1;
            }
            if (in_array($set2, $goodarr))
            {
                $grade2 = 1;
            }
            if (in_array($set3, $goodarr))
            {
                $grade3 = 1;
            }
            if (in_array($set4, $goodarr))
            {
                $grade4 = 1;
            }
            if (in_array($set5, $goodarr))
            {
                $grade5 = 1;
            }
            if (in_array($set6, $goodarr))
            {
                $grade6 = 1;
            }
            if (in_array($set7, $goodarr))
            {
                $grade7 = 1;
            }
            if (in_array($set8, $goodarr))
            {
                $grade8 = 1;
            }
            //med
            if (in_array($set1, $medarr))
            {
                $grade1 = 0.5;
            }
            if (in_array($set2, $medarr))
            {
                $grade2 = 0.5;
            }
            if (in_array($set3, $medarr))
            {
                $grade3 = 0.5;
            }
            if (in_array($set4, $medarr))
            {
                $grade4 = 0.5;
            }
            if (in_array($set5, $medarr))
            {
                $grade5 = 0.5;
            }
            if (in_array($set6, $medarr))
            {
                $grade6 = 0.5;
            }
            if (in_array($set7, $medarr))
            {
                $grade7 = 0.5;
            }
            if (in_array($set8, $medarr))
            {
                $grade8 = 0.5;
            }
            //bad
            if (in_array($set1, $badarr))
            {
                $grade1 = 0;
            }
            if (in_array($set2, $badarr))
            {
                $grade2 = 0;
            }
            if (in_array($set3, $badarr))
            {
                $grade3 = 0;
            }
            if (in_array($set4, $badarr))
            {
                $grade4 = 0;
            }
            if (in_array($set5, $badarr))
            {
                $grade5 = 0;
            }
            if (in_array($set6, $badarr))
            {
                $grade6 = 0;
            }
            if (in_array($set7, $badarr))
            {
                $grade7 = 0;
            }
            if (in_array($set8, $badarr))
            {
                $grade8 = 0;
            }

            //echo "g1" . $grade1;
            //echo "g2" . $grade2;
            //echo "g3" . $grade3;
            //echo "g4" . $grade4;
            //echo "g5" . $grade5;
            //echo "g6" . $grade6;
            //echo "g7" . $grade7;
            //echo "g8" . $grade8;

            $grade = $grade1 + $grade2 + $grade3 + $grade4 + $grade5 + $grade6 + $grade7 + $grade8;

            $avggrade = $grade/8;

            //echo "avg" . $avggrade;

            if ($avggrade > 0.95){
                $result = "A+";
            }
            else if ($avggrade > 0.75){
                $result = "A";
            }
            else if ($avggrade > 0.50){
                $result = "B";
            }
            else if ($avggrade > 0.20){
                $result = "C";
            }
            else if ($avggrade > 0.00){
                $result = "D";
            }
            else if ($avggrade = 0.00){
                $result = "F";
            }

            $forecast = $result;
        }

        return view('forecast.index', compact('forecast'));
    }
}

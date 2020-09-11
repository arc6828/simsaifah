<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Forecast;
use App\ForecastMeaning;
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
        $date = $request->get('date');
        $hour = $request->get('hour');
        $minute = $request->get('minute');
        //$grade = $request->get('grade');

        //$arr1 = str_split($str);

        //$length = count($array);
        if (empty($tel) && empty($date) && empty($hour) && empty($minute)) {
            $forecast = null;
            $plotchart = null;
            $mean1 = null;
            $mean2 = null;
            $mean3 = null;
            $mean4 = null;
            return view('forecast.index', compact('forecast','plotchart','mean1','mean2','mean3','mean4'));
        } else if (empty($date) && empty($hour) && empty($minute)) {
            return $this->forecast2($tel);
        } else if (empty($hour) && empty($minute)) {
            $hour = null;
            $minute = null;
            return $this->forecast($tel,$date,$hour,$minute);
        } else {
            return $this->forecast($tel,$date,$hour,$minute);
        }
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

    public function forecast($tel,$date,$hour,$minute)
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

        $grandtable = array(array(1,2,3,4,5,6,7),
                            array(6,7,1,2,3,4,5),
                            array(4,5,6,7,1,2,3),
                            array(2,3,4,5,6,7,1),
                            array(7,1,2,3,4,5,6),
                            array(5,6,7,1,2,3,4),
                            array(3,4,5,6,7,1,2),
                            array(1,2,3,4,5,6,7),
                            array(1,2,3,4,5,6,7),
                            array(5,6,7,1,2,3,4),
                            array(2,3,4,5,6,7,1),
                            array(6,7,1,2,3,4,5),
                            array(3,4,5,6,7,1,2),
                            array(7,1,2,3,4,5,6),
                            array(4,5,6,7,1,2,3),
                            array(1,2,3,4,5,6,7)
                            );

        //algorithm2

        if (empty($date)){
            $day = null;
            $noday = null;
            $key1 = null;
        } else {
            $timestamp = strtotime($date);
            $key1 = date('w', $timestamp);
            $day = date('D', $timestamp);
        }
        $key1=$key1+1;
        //echo "<br>key1 : " . $key1;

        if ($hour == null && $minute == null){
            $key2 = intval($key1);
            //echo "<br>key2 if : " . $key2;
            
        } else {
            //$timearr = explode(":",$time);
            //$hour = $timearr[0];
            //$minute = $timearr[1];

            $row = fmod(floor(($hour + $minute / 60) / 24*16) -4, 16);
            $row = $row<0 ? $row+16 : $row;
            //$row2 = (floor(($hour + $minute / 60) / 24*16) -4) %16;
            //echo "row" . $row;
            //echo "row2" . $row2;

            $space = 7 - fmod($row,8);
            //echo "<br>space" . $space."<br>";

            $offset = fmod(floor($minute / 60 * 16) , 8);

            if ($offset > $space) {
                $offset = fmod(floor($minute / 60 * 16) , 8) - 7;
            }

            //echo "<br>offset" . $offset."<br>";
            $rowtrue = $row + $offset;
            //echo "<br>rowtrue" . $rowtrue."<br>";
            //exit;
            $key2 = $grandtable[$rowtrue][$key1-1];
            //echo "key2" . $key2;
        }
        
        //echo "<br>key2 : " . $key2;
        //echo "<br>key1 : {$key1} <br>";
        //echo "<br>key2 : {$key2} <br>";
        
        //key1
        if ($key1 == 1) {
            $arrmaha1 = array(1,2,3,4,7,5,8,6);
        }
        if ($key1 == 2) {
            $arrmaha1 = array(2,3,4,7,5,8,6,1);
        }
        if ($key1 == 3) {
            $arrmaha1 = array(3,4,7,5,8,6,1,2);
        }
        if ($key1 == 4) {
            $arrmaha1 = array(4,7,5,8,6,1,2,3);
        }
        if ($key1 == 5) {
            $arrmaha1 = array(5,8,6,1,2,3,4,7);
        }
        if ($key1 == 6) {
            $arrmaha1 = array(6,1,2,3,4,7,5,8);
        }
        if ($key1 == 7) {
            $arrmaha1 = array(7,5,8,6,1,2,3,4);
        }

        //key2
        if ($key2 == 1) {
            $arrmaha2 = array(1,2,3,4,7,5,8,6);
        }
        if ($key2 == 2) {
            $arrmaha2 = array(2,3,4,7,5,8,6,1);
        }
        if ($key2 == 3) {
            $arrmaha2 = array(3,4,7,5,8,6,1,2);
        }
        if ($key2 == 4) {
            $arrmaha2 = array(4,7,5,8,6,1,2,3);
        }
        if ($key2 == 5) {
            $arrmaha2 = array(5,8,6,1,2,3,4,7);
        }
        if ($key2 == 6) {
            $arrmaha2 = array(6,1,2,3,4,7,5,8);
        }
        if ($key2 == 7) {
            $arrmaha2 = array(7,5,8,6,1,2,3,4);
        }

        //table mahataksa
        $mahatb = array($arrmaha1,$arrmaha2);

        //key success in no.phone
        $success = $array[1]; //สำเร็จ
        $destroy = $array[2]; //วินาศ
        $oppo = $array[4]; //อุปสรรค
        $blue = array($array[3],$array[5],$array[6],$array[7],$array[8],$array[9]);
        $red = array($array[2],$array[4]);

        $rgbtb = array(array(0,0,0,0,0,0,0,0,0,0),
                       array(0,0,0,0,0,0,0,0,0,0),
                       array(0,0,0,0,0,0,0,0,0,0),
                       array(0,0,0,0,0,0,0,0,0,0),
                       array(0,0,0,0,0,0,0,0,0,0),
                       array(0,0,0,0,0,0,0,0,0,0),
                       array(0,0,0,0,0,0,0,0,0,0),
                      );

        //สำเร็จ
        if ($success == $destroy || $success == $oppo) {
            $rgbtb[0][3] = 0;
            $rgbtb[0][5] = 0;
            $rgbtb[0][6] = 0;
            $rgbtb[0][7] = 0;
            $rgbtb[0][8] = 0;
            $rgbtb[0][9] = 0;
        } else {
            if ($success == $array[3]){
                $rgbtb[0][3] = 1;
            }
            if ($success == $array[5]){
                $rgbtb[0][5] = 1;
            }
            if ($success == $array[6]){
                $rgbtb[0][6] = 1;
            }
            if ($success == $array[7]){
                $rgbtb[0][7] = 1;
            }
            if ($success == $array[8]){
                $rgbtb[0][8] = 1;
            }
            if ($success == $array[9]){
                $rgbtb[0][9] = 1;
            }
        }

        //กาลี
        if ($arrmaha1[7] == $success) {
            if ($arrmaha1[7] == $array[3]) {
                $rgbtb[1][3] = -4;
            }
            if ($arrmaha1[7] == $array[5]) {
                $rgbtb[1][5] = -4;
            }
            if ($arrmaha1[7] == $array[6]) {
                $rgbtb[1][6] = -4;
            }
            if ($arrmaha1[7] == $array[7]) {
                $rgbtb[1][7] = -4;
            }
            if ($arrmaha1[7] == $array[8]) {
                $rgbtb[1][8] = -4;
            }
            if ($arrmaha1[7] == $array[9]) {
                $rgbtb[1][9] = -4;
            }
        } else {
        if ($arrmaha1[7] == $array[3]) {
            $rgbtb[1][3] = -2;
        }
        if ($arrmaha1[7] == $array[5]) {
            $rgbtb[1][5] = -2;
        }
        if ($arrmaha1[7] == $array[6]) {
            $rgbtb[1][6] = -2;
        }
        if ($arrmaha1[7] == $array[7]) {
            $rgbtb[1][7] = -2;
        }
        if ($arrmaha1[7] == $array[8]) {
            $rgbtb[1][8] = -2;
        }
        if ($arrmaha1[7] == $array[9]) {
            $rgbtb[1][9] = -2;
        }
    }

    if ($arrmaha2[7] == $success) {
        if ($arrmaha2[7] == $array[3]) {
            $rgbtb[1][3] = -4;
        }
        if ($arrmaha2[7] == $array[5]) {
            $rgbtb[1][5] = -4;
        }
        if ($arrmaha2[7] == $array[6]) {
            $rgbtb[1][6] = -4;
        }
        if ($arrmaha2[7] == $array[7]) {
            $rgbtb[1][7] = -4;
        }
        if ($arrmaha2[7] == $array[8]) {
            $rgbtb[1][8] = -4;
        }
        if ($arrmaha2[7] == $array[9]) {
            $rgbtb[1][9] = -4;
        }
    } else {
        if ($arrmaha2[7] == $array[3]) {
            $rgbtb[1][3] = -2;
        }
        if ($arrmaha2[7] == $array[5]) {
            $rgbtb[1][5] = -2;
        }
        if ($arrmaha2[7] == $array[6]) {
            $rgbtb[1][6] = -2;
        }
        if ($arrmaha2[7] == $array[7]) {
            $rgbtb[1][7] = -2;
        }
        if ($arrmaha2[7] == $array[8]) {
            $rgbtb[1][8] = -2;
        }
        if ($arrmaha2[7] == $array[9]) {
            $rgbtb[1][9] = -2;
        }
    }

        //อายุ
        if ($arrmaha1[1] == $array[9]) {
            $rgbtb[2][9] = 2;
        }
        if ($arrmaha2[1] == $array[9]) {
            $rgbtb[2][9] = 2;
        }

        //ศรี
        if ($arrmaha1[3] == $array[3]) {
            $rgbtb[4][3] = 2;
        }
        if ($arrmaha1[3] == $array[5]) {
            $rgbtb[4][5] = 2;
        }
        if ($arrmaha1[3] == $array[6]) {
            $rgbtb[4][6] = 2;
        }
        if ($arrmaha1[3] == $array[7]) {
            $rgbtb[4][7] = 2;
        }
        if ($arrmaha1[3] == $array[8]) {
            $rgbtb[4][8] = 2;
        }

        if ($arrmaha2[3] == $array[3]) {
            $rgbtb[4][3] = 2;
        }
        if ($arrmaha2[3] == $array[5]) {
            $rgbtb[4][5] = 2;
        }
        if ($arrmaha2[3] == $array[6]) {
            $rgbtb[4][6] = 2;
        }
        if ($arrmaha2[3] == $array[7]) {
            $rgbtb[4][7] = 2;
        }
        if ($arrmaha2[3] == $array[8]) {
            $rgbtb[4][8] = 2;
        }

        //มูละ
        if ($arrmaha1[4] == $array[5]) {
            $rgbtb[5][5] = 2;
        }
        if ($arrmaha1[4] == $array[8]) {
            $rgbtb[5][8] = 2;
        }

        if ($arrmaha2[4] == $array[5]) {
            $rgbtb[5][5] = 2;
        }
        if ($arrmaha2[4] == $array[8]) {
            $rgbtb[5][8] = 2;
        }

        //บริวาร
        if ($arrmaha1[0] == $array[9]) {
            $rgbtb[3][9] = 2;
        }

        if ($arrmaha2[0] == $array[9]) {
            $rgbtb[3][9] = 2;
        }

        //มนตรี
        if ($arrmaha1[6] == $array[3]) {
            $rgbtb[6][3] = 2;
        }
        if ($arrmaha1[6] == $array[6]) {
            $rgbtb[6][6] = 2;
        }
        if ($arrmaha1[6] == $array[7]) {
            $rgbtb[6][7] = 2;
        }

        if ($arrmaha2[6] == $array[3]) {
            $rgbtb[6][3] = 2;
        }
        if ($arrmaha2[6] == $array[6]) {
            $rgbtb[6][7] = 2;
        }
        if ($arrmaha2[6] == $array[7]) {
            $rgbtb[6][7] = 2;
        }


        //ผลรวม
        $love = $rgbtb[0][3]+$rgbtb[1][3]+$rgbtb[2][3]+$rgbtb[3][3]+$rgbtb[4][3]+$rgbtb[5][3]+$rgbtb[6][3];
        $bet = $rgbtb[0][5]+$rgbtb[1][5]+$rgbtb[2][5]+$rgbtb[3][5]+$rgbtb[4][5]+$rgbtb[5][5]+$rgbtb[6][5];
        $family = $rgbtb[0][6]+$rgbtb[1][6]+$rgbtb[2][6]+$rgbtb[3][6]+$rgbtb[4][6]+$rgbtb[5][6]+$rgbtb[6][6];
        $commu = $rgbtb[0][7]+$rgbtb[1][7]+$rgbtb[2][7]+$rgbtb[3][7]+$rgbtb[4][7]+$rgbtb[5][7]+$rgbtb[6][7];
        $money = $rgbtb[0][8]+$rgbtb[1][8]+$rgbtb[2][8]+$rgbtb[3][8]+$rgbtb[4][8]+$rgbtb[5][8]+$rgbtb[6][8];
        $health = $rgbtb[0][9]+$rgbtb[1][9]+$rgbtb[2][9]+$rgbtb[3][9]+$rgbtb[4][9]+$rgbtb[5][9]+$rgbtb[6][9];

        //mid
        $middle = 5;

        //คะแนนที่ได้
        $love_true = $love + $middle;
        $bet_true = $bet + $middle;
        $family_true = $family + $middle;
        $commu_true = $commu + $middle;
        $money_true = $money + $middle;
        $health_true = $health + $middle;
        /*
        echo "<br> Love : " . $love_true;
        echo "<br> Bet : " . $bet_true;
        echo "<br> Family : " . $family_true;
        echo "<br> commu : " . $commu_true;
        echo "<br> money : " . $money_true;
        echo "<br> health : " . $health_true;
        */
        //chart
        $plotchart = array($love_true,$bet_true,$family_true,$commu_true,$money_true,$health_true);

        //คำทำนาย
        $arrstr1 = intval($array[2] . $array[3]);
        $arrstr2 = intval($array[4] . $array[5]);
        $arrstr3 = intval($array[6] . $array[7]);
        $arrstr4 = intval($array[8] . $array[9]);

        

        $mean1 = ForecastMeaning::where('number','=',$arrstr1)
                                ->where('position','=','P23')
                                ->first();

        $mean2 = ForecastMeaning::where('number','=',$arrstr2)
                                ->where('position','=','P45')
                                ->first();

        $mean3 = ForecastMeaning::where('number','=',$arrstr3)
                                ->where('position','=','P67')
                                ->first();

        $mean4 = ForecastMeaning::where('number','=',$arrstr4)
                                ->where('position','=','P89')
                                ->first();

        //$meaning = $mean1 . $mean2 . $mean3 . $mean4;

        return view('forecast.index', compact('forecast','plotchart','mean1','mean2','mean3','mean4','key1','key2'));
    }

    public function forecast2($tel){
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

            //คำทำนาย
        $arrstr1 = intval($array[2] . $array[3]);
        $arrstr2 = intval($array[4] . $array[5]);
        $arrstr3 = intval($array[6] . $array[7]);
        $arrstr4 = intval($array[8] . $array[9]);

        

        $mean1 = ForecastMeaning::where('number','=',$arrstr1)
                                ->where('position','=','P23')
                                ->first();

        $mean2 = ForecastMeaning::where('number','=',$arrstr2)
                                ->where('position','=','P45')
                                ->first();

        $mean3 = ForecastMeaning::where('number','=',$arrstr3)
                                ->where('position','=','P67')
                                ->first();

        $mean4 = ForecastMeaning::where('number','=',$arrstr4)
                                ->where('position','=','P89')
                                ->first();

        $plotchart = array(0,0,0,0,0,0);

        //$meaning = $mean1 . $mean2 . $mean3 . $mean4;

        return view('forecast.index', compact('forecast','plotchart','mean1','mean2','mean3','mean4'));
        }
    }
}

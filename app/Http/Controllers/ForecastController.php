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
        if (empty($tel && $date && $hour && $minute)){
            $forecast = null;
            $plotchart = null;
            $mean1 = null;
            $mean2 = null;
            $mean3 = null;
            $mean4 = null;
            return view('forecast.index', compact('forecast','plotchart','mean1','mean2','mean3','mean4'));
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
        if (empty($hour && $minute)){
            $minute = null;
            $hour = null;
        } else {
            //$timearr = explode(":",$time);
            //$hour = $timearr[0];
            //$minute = $timearr[1];

            $row = fmod(floor(($hour + $minute / 60) / 24*16) -4, 16);
            //$row2 = (floor(($hour + $minute / 60) / 24*16) -4) %16;
            echo "row" . $row;
            //echo "row2" . $row2;

            $space = 8 - fmod($row,8);
            echo "space" . $space;

            $offset = fmod(floor($minute / 60 * 16) , 8);

            if ($offset > $space) {
                $offset = fmod(floor($minute / 60 * 16) , 8) - 7;
            }

            echo "offset" . $offset;
            $rowtrue = $row + $offset;
            echo "rowtrue" . $rowtrue;
        }

        if (empty($date)){
            $day = null;
            $noday = null;
        } else {
            $timestamp = strtotime($date);
            $key1 = date('w', $timestamp);
            $day = date('D', $timestamp);
        }

        $key2 = $grandtable[$rowtrue][$key1];
        echo "key2" . $key2;

        //key1
        if ($key1 == 0) {
            $arrmaha1 = array(1,2,3,4,7,5,8,6);
        }
        if ($key1 == 1) {
            $arrmaha1 = array(2,3,4,7,5,8,6,1);
        }
        if ($key1 == 2) {
            $arrmaha1 = array(3,4,7,5,8,6,1,2);
        }
        if ($key1 == 3) {
            $arrmaha1 = array(4,7,5,8,6,1,2,3);
        }
        if ($key1 == 4) {
            $arrmaha1 = array(5,8,6,1,2,3,4,7);
        }
        if ($key1 == 5) {
            $arrmaha1 = array(6,1,2,3,4,7,5,8);
        }
        if ($key1 == 6) {
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
                       array(0,0,0,0,0,0,0,0,0,0),
                       array(0,0,0,0,0,0,0,0,0,0),
                       array(0,0,0,0,0,0,0,0,0,0),
                       array(0,0,0,0,0,0,0,0,0,0),
                       array(0,0,0,0,0,0,0,0,0,0),
                       array(0,0,0,0,0,0,0,0,0,0),
                      );

        //สำเร็จ
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

        //วินาศ
        if ($destroy == $array[3]){
            $rgbtb[1][3] = -1;
        }
        if ($destroy == $array[5]){
            $rgbtb[1][5] = -1;
        }
        if ($destroy == $array[6]){
            $rgbtb[1][6] = -1;
        }
        if ($destroy == $array[7]){
            $rgbtb[1][7] = -1;
        }
        if ($destroy == $array[8]){
            $rgbtb[1][8] = -1;
        }
        if ($destroy == $array[9]){
            $rgbtb[1][9] = -1;
        }

        //อุปสรรค
        if ($oppo == $array[3]){
            $rgbtb[2][3] = -1;
        }
        if ($oppo == $array[5]){
            $rgbtb[2][5] = -1;
        }
        if ($oppo == $array[6]){
            $rgbtb[2][6] = -1;
        }
        if ($oppo == $array[7]){
            $rgbtb[2][7] = -1;
        }
        if ($oppo == $array[8]){
            $rgbtb[2][8] = -1;
        }
        if ($oppo == $array[9]){
            $rgbtb[2][9] = -1;
        }

        //จับคู่ key1
        $k1duo1 = $key1 . $array[3];
        $k1duo2 = $key1 . $array[5];
        $k1duo3 = $key1 . $array[6];
        $k1duo4 = $key1 . $array[7];
        $k1duo5 = $key1 . $array[8];
        $k1duo6 = $key1 . $array[9];

        //จับคู่ key2
        $k2duo1 = $key2 . $array[3];
        $k2duo2 = $key2 . $array[5];
        $k2duo3 = $key2 . $array[6];
        $k2duo4 = $key2 . $array[7];
        $k2duo5 = $key2 . $array[8];
        $k2duo6 = $key2 . $array[9];

        //rgb1 good
        if (in_array($k1duo1,$goodarr)) {
            $rgbtb[3][3] = 1;
        }
        if (in_array($k1duo2,$goodarr)) {
            $rgbtb[3][5] = 1;
        }
        if (in_array($k1duo3,$goodarr)) {
            $rgbtb[3][6] = 1;
        }
        if (in_array($k1duo4,$goodarr)) {
            $rgbtb[3][7] = 1;
        }
        if (in_array($k1duo5,$goodarr)) {
            $rgbtb[3][8] = 1;
        }
        if (in_array($k1duo6,$goodarr)) {
            $rgbtb[3][9] = 1;
        }

        //rgb1 bad
        if (in_array($k1duo1,$badarr)) {
            $rgbtb[3][3] = -1;
        }
        if (in_array($k1duo2,$badarr)) {
            $rgbtb[3][5] = -1;
        }
        if (in_array($k1duo3,$badarr)) {
            $rgbtb[3][6] = -1;
        }
        if (in_array($k1duo4,$badarr)) {
            $rgbtb[3][7] = -1;
        }
        if (in_array($k1duo5,$badarr)) {
            $rgbtb[3][8] = -1;
        }
        if (in_array($k1duo6,$badarr)) {
            $rgbtb[3][9] = -1;
        }

        //rgb2 good
        if (in_array($k2duo1,$goodarr)) {
            $rgbtb[4][3] = 1;
        }
        if (in_array($k2duo2,$goodarr)) {
            $rgbtb[4][5] = 1;
        }
        if (in_array($k2duo3,$goodarr)) {
            $rgbtb[4][6] = 1;
        }
        if (in_array($k2duo4,$goodarr)) {
            $rgbtb[4][7] = 1;
        }
        if (in_array($k2duo5,$goodarr)) {
            $rgbtb[4][8] = 1;
        }
        if (in_array($k2duo6,$goodarr)) {
            $rgbtb[4][9] = 1;
        }

        //rgb2 bad
        if (in_array($k2duo1,$badarr)) {
            $rgbtb[4][3] = -1;
        }
        if (in_array($k2duo2,$badarr)) {
            $rgbtb[4][5] = -1;
        }
        if (in_array($k2duo3,$badarr)) {
            $rgbtb[4][6] = -1;
        }
        if (in_array($k2duo4,$badarr)) {
            $rgbtb[4][7] = -1;
        }
        if (in_array($k2duo5,$badarr)) {
            $rgbtb[4][8] = -1;
        }
        if (in_array($k2duo6,$badarr)) {
            $rgbtb[4][9] = -1;
        }

        //กาลี
        if ($arrmaha1[7] == $array[3]) {
            $rgbtb[5][3] = -1;
        }
        if ($arrmaha1[7] == $array[5]) {
            $rgbtb[5][5] = -1;
        }
        if ($arrmaha1[7] == $array[6]) {
            $rgbtb[5][6] = -1;
        }
        if ($arrmaha1[7] == $array[7]) {
            $rgbtb[5][7] = -1;
        }
        if ($arrmaha1[7] == $array[8]) {
            $rgbtb[5][8] = -1;
        }
        if ($arrmaha1[7] == $array[9]) {
            $rgbtb[5][9] = -1;
        }

        if ($arrmaha2[7] == $array[3]) {
            $rgbtb[5][3] = -1;
        }
        if ($arrmaha2[7] == $array[5]) {
            $rgbtb[5][5] = -1;
        }
        if ($arrmaha2[7] == $array[6]) {
            $rgbtb[5][6] = -1;
        }
        if ($arrmaha2[7] == $array[7]) {
            $rgbtb[5][7] = -1;
        }
        if ($arrmaha2[7] == $array[8]) {
            $rgbtb[5][8] = -1;
        }
        if ($arrmaha2[7] == $array[9]) {
            $rgbtb[5][9] = -1;
        }

        //อายุ
        if ($arrmaha1[1] == $array[9]) {
            $rgbtb[6][9] = 1;
        }
        if ($arrmaha2[1] == $array[9]) {
            $rgbtb[6][9] = 1;
        }

        //ศรี
        if ($arrmaha1[3] == $array[3]) {
            $rgbtb[7][3] = 1;
        }
        if ($arrmaha1[3] == $array[5]) {
            $rgbtb[7][5] = 1;
        }
        if ($arrmaha1[3] == $array[6]) {
            $rgbtb[7][6] = 1;
        }
        if ($arrmaha1[3] == $array[7]) {
            $rgbtb[7][7] = 1;
        }
        if ($arrmaha1[3] == $array[8]) {
            $rgbtb[7][8] = 1;
        }

        if ($arrmaha2[3] == $array[3]) {
            $rgbtb[7][3] = 1;
        }
        if ($arrmaha2[3] == $array[5]) {
            $rgbtb[7][5] = 1;
        }
        if ($arrmaha2[3] == $array[6]) {
            $rgbtb[7][6] = 1;
        }
        if ($arrmaha2[3] == $array[7]) {
            $rgbtb[7][7] = 1;
        }
        if ($arrmaha2[3] == $array[8]) {
            $rgbtb[7][8] = 1;
        }

        //มูละ
        if ($arrmaha1[4] == $array[5]) {
            $rgbtb[8][5] = 1;
        }
        if ($arrmaha1[4] == $array[8]) {
            $rgbtb[8][8] = 1;
        }

        if ($arrmaha2[4] == $array[5]) {
            $rgbtb[8][5] = 1;
        }
        if ($arrmaha2[4] == $array[8]) {
            $rgbtb[8][8] = 1;
        }

        //บริวาร R
        if ($arrmaha1[0] == $array[2]) {
            $rgbtb[9][3] = -1;
            $rgbtb[9][6] = -1;
            $rgbtb[9][7] = -1;
        }
        if ($arrmaha1[0] == $array[4]) {
            $rgbtb[9][3] = -1;
            $rgbtb[9][6] = -1;
            $rgbtb[9][7] = -1;
        }

        if ($arrmaha2[0] == $array[2]) {
            $rgbtb[9][3] = -1;
            $rgbtb[9][6] = -1;
            $rgbtb[9][7] = -1;
        }
        if ($arrmaha2[0] == $array[4]) {
            $rgbtb[9][3] = -1;
            $rgbtb[9][6] = -1;
            $rgbtb[9][7] = -1;
        }

        //อายุ R
        if ($arrmaha1[1] == $array[2]) {
            $rgbtb[10][9] = -1;
        }
        if ($arrmaha1[1] == $array[4]) {
            $rgbtb[10][9] = -1;
        }

        if ($arrmaha2[1] == $array[2]) {
            $rgbtb[10][9] = -1;
        }
        if ($arrmaha2[1] == $array[4]) {
            $rgbtb[10][9] = -1;
        }

        //ศรี R
        if ($arrmaha1[3] == $array[2]) {
            $rgbtb[11][5] = -1;
        }
        if ($arrmaha1[3] == $array[4]) {
            $rgbtb[11][5] = -1;
        }

        if ($arrmaha2[3] == $array[2]) {
            $rgbtb[11][5] = -1;
        }
        if ($arrmaha2[3] == $array[4]) {
            $rgbtb[11][5] = -1;
        }

        //มูละ R
        if ($arrmaha1[4] == $array[2]) {
            $rgbtb[12][8] = -1;
        }
        if ($arrmaha1[4] == $array[4]) {
            $rgbtb[12][8] = -1;
        }

        if ($arrmaha2[4] == $array[2]) {
            $rgbtb[12][8] = -1;
        }
        if ($arrmaha2[4] == $array[4]) {
            $rgbtb[12][8] = -1;
        }

        //ผลรวม
        $love = $rgbtb[0][3]+$rgbtb[1][3]+$rgbtb[2][3]+$rgbtb[3][3]+$rgbtb[4][3]+$rgbtb[5][3]+$rgbtb[6][3]+$rgbtb[7][3]+$rgbtb[8][3]+$rgbtb[9][3]+$rgbtb[10][3]+$rgbtb[11][3]+$rgbtb[12][3];
        $bet = $rgbtb[0][5]+$rgbtb[1][5]+$rgbtb[2][5]+$rgbtb[3][5]+$rgbtb[4][5]+$rgbtb[5][5]+$rgbtb[6][5]+$rgbtb[7][5]+$rgbtb[8][5]+$rgbtb[9][5]+$rgbtb[10][5]+$rgbtb[11][5]+$rgbtb[12][5];
        $family = $rgbtb[0][6]+$rgbtb[1][6]+$rgbtb[2][6]+$rgbtb[3][6]+$rgbtb[4][6]+$rgbtb[5][6]+$rgbtb[6][6]+$rgbtb[7][6]+$rgbtb[8][6]+$rgbtb[9][6]+$rgbtb[10][6]+$rgbtb[11][6]+$rgbtb[12][6];
        $commu = $rgbtb[0][7]+$rgbtb[1][7]+$rgbtb[2][7]+$rgbtb[3][7]+$rgbtb[4][7]+$rgbtb[5][7]+$rgbtb[6][7]+$rgbtb[7][7]+$rgbtb[8][7]+$rgbtb[9][7]+$rgbtb[10][7]+$rgbtb[11][7]+$rgbtb[12][7];
        $money = $rgbtb[0][8]+$rgbtb[1][8]+$rgbtb[2][8]+$rgbtb[3][8]+$rgbtb[4][8]+$rgbtb[5][8]+$rgbtb[6][8]+$rgbtb[7][8]+$rgbtb[8][8]+$rgbtb[9][8]+$rgbtb[10][8]+$rgbtb[11][8]+$rgbtb[12][8];
        $health = $rgbtb[0][9]+$rgbtb[1][9]+$rgbtb[2][9]+$rgbtb[3][9]+$rgbtb[4][9]+$rgbtb[5][9]+$rgbtb[6][9]+$rgbtb[7][9]+$rgbtb[8][9]+$rgbtb[9][9]+$rgbtb[10][9]+$rgbtb[11][9]+$rgbtb[12][9];

        //mid
        $middle = 5;

        //คะแนนที่ได้
        $love_true = $love + $middle;
        $bet_true = $bet + $middle;
        $family_true = $family + $middle;
        $commu_true = $commu + $middle;
        $money_true = $money + $middle;
        $health_true = $health + $middle;

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

        return view('forecast.index', compact('forecast','plotchart','mean1','mean2','mean3','mean4'));
    }
}

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
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $operator = $request->get('operator');
        $total = $request->get('total');
        $price = $request->get('price');
        $sort = $request->get('sort','number');
        $numbers = $request->get('numbers');
        $birthday = $request->get('birthday');
        $whitelist = $request->get('whitelist');
        $blacklist = $request->get('blacklist');
        $tags = [];
        $perPage = 20;
        
        
        $filter_number_string = "__________";
        if( is_array($numbers) ){
            for($i=0; $i<count($numbers); $i++){
                if( !empty($numbers[$i]) ){
                    $filter_number_string[$i] = $numbers[$i];
                }
            }
        }
        


        $needFilter = !empty($keyword) || !empty($operator) || !empty($birthday) || !empty($sum)  || !empty($price) || !empty($numbers)  || !empty($whitelist)   || !empty($blacklist)  ;
        if ($needFilter) {
            //http://localhost/simsaifah/public/number?search=chavalit.kow%40gmail.com&operator=&total=&price=1000000&sort=number&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&whitelist=1+%2C+2+%2C+3+%2C+4&blacklist=4+%2C+5+%2C+6+%2C+7
            $whitelist = explode(",", $whitelist);
            $blacklist = explode(",", $blacklist);

            
            $whitelist_sum = array_sum($whitelist);  
            if($whitelist[0]!=""){
                $tags[] = $this->getTag($whitelist_sum);
            }
             
            
            $tags[] = strtoupper($operator);

            $price = empty($price) ? 1000000 : $price;
            // print_r($whitelist);
            // echo "<br>";
            // print_r($blacklist) ;
            // exit();
            //FILTER
            $query = Number::where('operator', 'LIKE', "%$operator%")
                ->where('price', '<', $price)
                ->where('total', 'LIKE', "%$total%")
                ->where('number', 'LIKE', $filter_number_string)
                ->where('number', 'LIKE', "%$keyword%");
            //WHITELIST
            $query = $query->where(function ($query) use ($whitelist) {
                for($i=0; $i<count($whitelist); $i++){
                    if($i==0){
                        $query = $query->where('number', 'LIKE', "%{$whitelist[$i]}%");
                    }else{
                        $query = $query->orWhere('number', 'LIKE', "%{$whitelist[$i]}%");
                    }
                }
            });
            //BLACKLIST
            $query = $query->where(function ($query) use ($blacklist) {
                for($i=0; $i<count($blacklist); $i++){
                    if($blacklist[$i]==""){
                        continue;
                    }
                    if($i==0){
                        $query = $query->where('number', 'NOT LIKE', "%{$blacklist[$i]}%");
                    }else{
                        $query = $query->where('number', 'NOT LIKE', "%{$blacklist[$i]}%");
                    }
                }
            });
            //BIRTHDAY
            if(!empty($birthday)){
                $birthday_indexes = [
                    "sun" => [3,6],
                    "mon" => [1,5],
                    "tue" => [1,2],
                    "wed" => [3,8],
                    "thu" => [2,7],
                    "fri" => [7,8],
                    "saa" => [4,6],
                ];
                $blacklist_birthday = $birthday_indexes[$birthday];
                           
                $blacklist_square = array_map(function ($n) { return($n*$n);},$blacklist_birthday) ;  
                $blacklist_sum = array_sum($blacklist_square);
                $tags[] = $this->getTag($blacklist_sum);
                
                $query = $query->where(function ($query) use ($blacklist_birthday) {
                    for($i=0; $i<count($blacklist_birthday); $i++){
                        if($blacklist_birthday[$i]==""){
                            continue;
                        }
                        if($i==0){
                            $query = $query->where('number', 'NOT LIKE', "%{$blacklist_birthday[$i]}%");
                        }else{
                            $query = $query->where('number', 'NOT LIKE', "%{$blacklist_birthday[$i]}%");
                        }
                    }
                });
            }
            
            //SORT
            switch($sort){
                case "asc" :
                case "desc" :                    
                    $number = $query->orderBy('price', $sort)->latest()->limit($perPage)->get();
                    break; 
                default : 
                    $number = $query->orderBy('number', 'asc')->latest()->limit($perPage)->get();
            }
                
        } else {
            $number = Number::orderBy('number', 'asc')->limit($perPage)->inRandomOrder()->get();
        }        

        // return view('number.index', compact('number','total_array','operator_array','tags'));
        return $number;
    }

    public function temp()
    {
        $limit = 7;
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

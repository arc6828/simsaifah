<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $sort = $request->get('sort','number');
        $numbers = $request->get('numbers');
        $whitelist = $request->get('whitelist');
        $blacklist = $request->get('blacklist');
        
        $perPage = 100;
        
        
        $filter_number_string = "__________";
        if( is_array($numbers) ){
            for($i=0; $i<count($numbers); $i++){
                if( !empty($numbers[$i]) ){
                    $filter_number_string[$i] = $numbers[$i];
                }
            }
        }
        


        $needFilter = !empty($keyword) || !empty($operator) || !empty($sum)  || !empty($price) || !empty($numbers)  || !empty($whitelist)   || !empty($blacklist)  ;
        if ($needFilter) {
            //http://localhost/simsaifah/public/number?search=chavalit.kow%40gmail.com&operator=&total=&price=1000000&sort=number&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&whitelist=1+%2C+2+%2C+3+%2C+4&blacklist=4+%2C+5+%2C+6+%2C+7
            $whitelist = explode(",", $whitelist);
            $blacklist = explode(",", $blacklist);
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
                        $query = $query->orWhere('number', 'NOT LIKE', "%{$blacklist[$i]}%");
                    }
                }
            });
            //SORT
            switch($sort){
                case "asc" :
                case "desc" :                    
                    $number = $query->orderBy('price', $sort)->latest()->paginate($perPage);
                    break; 
                default : 
                    $number = $query->orderBy('number', 'asc')->latest()->paginate($perPage);
            }
                
        } else {
            $number = Number::orderBy('number', 'asc')->latest()->paginate($perPage);
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

    public function destroyAll()
    {
        //Number::delete();
        
        DB::statement('TRUNCATE TABLE numbers');

        return redirect('number')->with('flash_message', 'Number deleted!');
    }

    public function importAll(Request $request)
    {
        
        $requestData = $request->all();
        $long_sql = trim($request['sql']);

        $commands = explode(";",$long_sql);
        foreach($commands as $sql){
            //echo "<p>$sql<p>";
            $sql = trim($sql);
            if($sql != ""){
                DB::statement($sql);
            }
        }
        
        //Number::create($requestData);

        return redirect('number')->with('flash_message', 'Number added!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
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
        //1. แสดง Order ที่มีสถานะ “Checking”

        switch(Auth::user()->role){
            case "admin" : //แอดมินจะเห็นทั้งหมด
                if (!empty($keyword)) {
                    $address = Address::where('name', 'LIKE', "%$keyword%")
                        ->orWhere('address', 'LIKE', "%$keyword%")
                        ->orWhere('company', 'LIKE', "%$keyword%")
                        ->orWhere('parish', 'LIKE', "%$keyword%")
                        ->orWhere('district', 'LIKE', "%$keyword%")
                        ->orWhere('province', 'LIKE', "%$keyword%")
                        ->orWhere('postal', 'LIKE', "%$keyword%")
                        ->orWhere('contact', 'LIKE', "%$keyword%")
                        ->orWhere('remake', 'LIKE', "%$keyword%")
                        ->orWhere('user_id', 'LIKE', "%$keyword%")
                        ->latest()->paginate($perPage);
                } else {
                    $address = Address::latest()->paginate($perPage);
                }
                break;

            default : // guest ผู้ใช้เห็นแค่ของตนเอง                
                if (!empty($keyword)) {
                    $address = Address::where('user_id', Auth::user()->id)
                        ->where(function($query) use ($keyword){
                            $query
                                ->where('name', 'LIKE', "%$keyword%")
                                ->orWhere('address', 'LIKE', "%$keyword%")
                                ->orWhere('company', 'LIKE', "%$keyword%")
                                ->orWhere('parish', 'LIKE', "%$keyword%")
                                ->orWhere('district', 'LIKE', "%$keyword%")
                                ->orWhere('province', 'LIKE', "%$keyword%")
                                ->orWhere('postal', 'LIKE', "%$keyword%")
                                ->orWhere('contact', 'LIKE', "%$keyword%")
                                ->orWhere('remake', 'LIKE', "%$keyword%")
                                ->orWhere('user_id', 'LIKE', "%$keyword%");
                        
                        })
                        ->latest()->paginate($perPage); 
                } else {
                    $address = Address::where('user_id' , Auth::user()->id)->latest()->paginate($perPage);
                }
        }

        

        return view('address.index', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('address.create');
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
        
        Address::create($requestData);

        return redirect('address')->with('flash_message', 'Address added!');
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
        $address = Address::findOrFail($id);

        return view('address.show', compact('address'));
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
        $address = Address::findOrFail($id);

        return view('address.edit', compact('address'));
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
        
        $address = Address::findOrFail($id);
        $address->update($requestData);

        return redirect('address')->with('flash_message', 'Address updated!');
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
        Address::destroy($id);

        return redirect('address')->with('flash_message', 'Address deleted!');
    }
}

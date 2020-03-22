<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $users = User::firstOrCreate(
            ['user_id' => Auth::id()],
            ['role' => 'guest']
        );

        if(Auth::user()->users->role == "admin"){
            return redirect("/order");
        }else if(Auth::user()->users->role == "guest"){
            return redirect("/number");
        }

        return redirect('/');
    }
}

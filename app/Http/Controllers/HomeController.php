<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function login()
    {
        if (Auth::user()) {   // Check is user logged in
            if(Auth::user()->user_type=="customer"){
                return redirect()->route('order.index');
            }else{
                return redirect()->route('delivery_home');
            }  
        }
        return view('auth.login');
    }
}

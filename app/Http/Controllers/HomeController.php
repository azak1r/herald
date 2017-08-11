<?php

namespace nullx27\Herald\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect()->route('events.index');
        } else {
            return view('auth.login');
        }
    }
}

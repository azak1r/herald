<?php

namespace nullx27\Herald\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('events.index');
    }
}

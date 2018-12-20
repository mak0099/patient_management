<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    public function getIndex(){
        return redirect()->route('dashboard');
    }
    public function getDashboard(){
        Session::put('menu', 'dashboard');
        return view('dashboard');
    }
}

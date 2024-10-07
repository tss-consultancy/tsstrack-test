<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index(Request $request){
      
         //  session()->forget('login');
        
            return view('master.dashboard');
     
        
    }
}

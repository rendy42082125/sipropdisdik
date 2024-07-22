<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesiController extends Controller
{
    function index(){
        return view('index');
     }
     function admin()
     {
         return view('admin.dashboard');
     }
     function pengguna()
     {
         return view('pengguna.dashboard');
     }
     function operator()
     {
         return view('operator.dashboard');
     }
     function staff()
     {
         return view('staff.dashboard');
     }

     function kadisdashboard()
     {
         return view('kadis.dashboard');
     }
}

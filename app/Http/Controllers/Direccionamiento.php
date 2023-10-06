<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Direccionamiento extends Controller
{
    function index(){
        if (Auth::check()) {
            //return Inertia::render('Dashboard');
            return Redirect::route('dashboard');
        } else {
            return Inertia::render('Auth/Login');
            //return Redirect::route('Auth.Login');
        }
    }
}

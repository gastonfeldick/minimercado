<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
class ProductoController extends Controller
{
    function index(){
        return Inertia::render('Productos/index');
    }
}

<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\ValidationException;
use App\Models\Producto;

class ProductoController extends Controller
{
    function index(){
        $productos= array(
            'nuevo'=>'hola'
        );
        $productos2= Producto::all();
        return Inertia::render('Productos/index',['productos'=>$productos2]);
    }

    function create(){
        return Inertia::render('Productos/create');
    }
    
    function store(Request $request){


        $request->validate([
            'nombre' => 'required|max:200',
            'codigo' => 'required|integer|max:99999999999999',
            'precio' => 'required|integer',
        ]);

        //'codigo' => 'required|integer|max:99999999999999',
        

        $producto = new Producto();

        $producto->nombre_producto = $request->nombre;
        $producto->codigo = $request->codigo;
        $producto->precio = $request->precio;
        $producto->save();

        

        
        return $request;

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}

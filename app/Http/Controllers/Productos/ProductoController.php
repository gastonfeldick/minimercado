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
        //$productos2= Producto::all();
        //return Inertia::render('Productos/index',['productos'=>$productos2]);
        return Inertia::render('Productos/index');

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

    function edit(Request $request){
        $producto=Producto::find($request->id);
        return Inertia::render('Productos/edit',['producto'=>$producto]);
    }

    function update(Request $request){

        $request->validate([
            'nombre_producto' => 'required|max:200',
            'codigo' => 'required|integer|max:99999999999999',
            'precio' => 'required|integer',
        ]);

        //'codigo' => 'required|integer|max:99999999999999',
        

        $producto = Producto::find($request->id);

        $producto->nombre_producto = $request->nombre_producto;
        $producto->codigo = $request->codigo;
        $producto->precio = $request->precio;
        $producto->fecha_actualizacion=date('Y-m-d H:i:s');
        $producto->save();

        
        return $request;

        throw ValidationException::withMessages([
            'error' => 'error',
        ]);
    }

    function delete(Request $request){

        $request->validate([
            'id' => 'required|integer',
        ]);

        $res=Producto::where('id',$request->id)->delete();

        if ($res) {
            return response()->json([
                'status' => 1,
                'msg' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'msg' => 'fail'
            ]);
        }

    }

    function getProductos(Request $request){
        $query = Producto::query();

        if ($request->filled('nombre')) {
            $query->where('nombre_producto', 'like', '%' . $request->input('nombre') . '%');
        }
        if ($request->filled('codigo')) {
            $query->where('codigo',  $request->input('codigo'));
        }

        $productos= $query->paginate(7);
        return $productos;
    }
}

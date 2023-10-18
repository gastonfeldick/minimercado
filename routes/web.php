<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Direccionamiento;
use App\Http\Controllers\Productos\ProductoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/',[Direccionamiento::class, 'index']);
//Route::fallback([Direccionamiento::class,'index']);

Route::prefix('productos')->group(function(){
    Route::get('lista',[ProductoController::class,'index'])->name('productos.index');
    Route::get('crear',[ProductoController::class,'create'])->name('productos.create');
    Route::get('editar/{id}',[ProductoController::class,'edit'])->name('productos.edit');
    Route::post('guardar',[ProductoController::class,'store'])->name('productos.store');
    Route::post('actualizar',[ProductoController::class,'update'])->name('productos.update');
    Route::post('eliminar',[ProductoController::class,'delete'])->name('productos.delete');

    Route::prefix('ajax')->group(function(){
        Route::get('get',[ProductoController::class,'getProductos'])->name('productos.get');
    });


})->middleware(['auth','verified']);


require __DIR__.'/auth.php';

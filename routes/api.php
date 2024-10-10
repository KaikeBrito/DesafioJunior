<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


//Rotas para registro
Route::prefix('users')->group(function () {
    Route::get('/profiles', [UserController::class, 'profiles'])->middleware('auth:sanctum');
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/loginApi', [UserController::class, 'loginApi']);
});

//Rota para produtos
Route::prefix('produtos')->group(function () {
    Route::get('/', [ProdutosController::class, 'index']);
    Route::post('/', [ProdutosController::class, 'store']);
    Route::put('/{produtos}', [ProdutosController::class, 'update']);
    Route::delete('/{produtos}', [ProdutosController::class, 'destroy']);
});

//Rota para categorias
Route::prefix('categorias')->group(function () {
    Route::get('/', [CategoriasController::class, 'getCategorias']);
    Route::post('/', [CategoriasController::class, 'store']);
    Route::put('/{categorias}', [CategoriasController::class, 'update']);
    Route::delete('/{categorias}', [CategoriasController::class, 'destroy']);
});


// Rotas para Images
Route::prefix('images')->group(function () {
    Route::get('/', [ImageController::class, 'getImages']);
    Route::post('/', [ImageController::class, 'store']);
    Route::put('/{image}', [ImageController::class, 'update']);
    Route::delete('/{image}', [ImageController::class, 'destroy']);
});

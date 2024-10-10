<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProdutosController;

//Rota tela de welcome
Route::get('/', function () {
    return view('welcome');
});

// Rota para exibir o formulário de registro
Route::get('/register', function () {
    return view('register');
})->name('register.form');

// Rota para exibir o formulário de login
Route::get('/login', function () {
    return view('login');
})->name('login.form');

// Rota para processar o formulário de registro
Route::post('/register', [UserController::class, 'register'])->name('register');

// Rota para processar o formulário de login
Route::post('/login', [UserController::class, 'login'])->name('login');

// Rota para processar a saida do usuário ao clicar o botão sair
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Rota para processar dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


//Rota para categorias
Route::prefix('categorias')->group(function () {
    Route::get('/', [CategoriasController::class, 'index'])->name('categorias.index');;
    Route::get('/json', [CategoriasController::class, 'getCategorias'])->name('categorias.getCategorias');
    Route::post('/', [CategoriasController::class, 'store'])->name('categorias.store');
    Route::put('/{categorias}', [CategoriasController::class, 'update'])->name('categorias.update');
    Route::delete('/{categorias}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
});

//Rota para Produtos
Route::prefix('produtos')->group(function () {
    Route::get('/', [ProdutosController::class, 'index'])->name('produtos.index');;
    Route::get('/json', [ProdutosController::class, 'getProdutos'])->name('produtos.getProdutos');
    Route::post('/', [ProdutosController::class, 'store'])->name('produtos.store');
    Route::put('/{produtos}', [ProdutosController::class, 'update'])->name('produtos.update');
    Route::delete('/{produtos}', [ProdutosController::class, 'destroy'])->name('produtos.destroy');
});

//Rota para images
Route::prefix('images')->group(function () {
    Route::get('/', [ImageController::class, 'index'])->name('images.index');
    Route::get('/get', [ImageController::class, 'getImages'])->name('images.getImages');
    Route::post('/', [ImageController::class, 'store'])->name('images.store');
    Route::put('/{id}', [ImageController::class, 'update'])->name('images.update');
    Route::delete('/{id}', [ImageController::class, 'destroy'])->name('images.destroy');
});

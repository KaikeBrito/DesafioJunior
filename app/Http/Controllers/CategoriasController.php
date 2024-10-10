<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();
        return view('categorias', compact('categorias'));
    }

    public function getCategorias()
    {
        $categorias = Categorias::all();
        return response()->json(['categorias' => $categorias], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $categoria = Categorias::create($request->all());

        return response()->json(['message' => 'Categoria criada com sucesso', 'categoria' => $categoria], 201);
    }


    public function update(Request $request, Categorias $categorias)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $categorias->update($request->all());

        return response()->json(['message' => 'Categoria atualizada com sucesso', 'categoria' => $categorias], 200);
    }

    public function destroy(Categorias $categorias)
    {
        $categorias->delete();

        return response()->json(['message' => 'Categoria deletada com sucesso', 'categoria' => $categorias], 200);
    }
}

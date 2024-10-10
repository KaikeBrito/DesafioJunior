<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProdutosController extends Controller
{
    // Método para listar todos os produtos
    public function index()
    {
        $produtos = Produtos::all();
        return view('produtos', compact('produtos'));
    }

    // Método para retornar produtos em formato JSON
    public function getProdutos()
    {
        $produtos = Produtos::all();
        return response()->json(['produtos' => $produtos], Response::HTTP_OK);
    }

    // Método para adicionar um novo produto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $produto = Produtos::create($request->all());

        return response()->json(['message' => 'Produto criado com sucesso!', 'produto' => $produto], Response::HTTP_CREATED);
    }

    // Método para atualizar um produto existente
    public function update(Request $request, Produtos $produtos)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $produtos->update($request->all());

        return response()->json(['message' => 'Produto atualizado com sucesso!', 'produto' => $produtos], Response::HTTP_OK);
    }

    // Método para deletar um produto
    public function destroy(Produtos $produtos)
    {
        $produtos->delete();

        return response()->json(['message' => 'Produto deletado com sucesso!'], Response::HTTP_OK);
    }
}

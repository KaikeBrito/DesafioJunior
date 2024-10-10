<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('images', compact('images'));
    }

    public function getImages()
    {
        $images = Image::all();
        return response()->json(['images' => $images], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'imageable_id' => 'required|integer',
            'imageable_type' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        $image = Image::create([
            'imageable_id' => $request->input('imageable_id'),
            'imageable_type' => $request->input('imageable_type'),
            'filename' => $request->file('image')->getClientOriginalName(),
            'url' => Storage::url($path),
        ]);

        return response()->json(['message' => 'Imagem criada com sucesso', 'image' => $image], 201);
    }

    public function update(Request $request, Image $image)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imageable_id' => 'nullable|integer',
            'imageable_type' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            // Remover imagem anterior
            Storage::disk('public')->delete(str_replace('/storage/', '', $image->url));

            // Armazenar nova imagem
            $path = $request->file('image')->store('images', 'public');
            $image->filename = $request->file('image')->getClientOriginalName();
            $image->url = Storage::url($path);
        }

        // Atualizar ID e Tipo se fornecidos
        if ($request->filled('imageable_id')) {
            $image->imageable_id = $request->imageable_id;
        }
        if ($request->filled('imageable_type')) {
            $image->imageable_type = $request->imageable_type;
        }

        $image->save(); // Salva as alterações

        return response()->json(['message' => 'Imagem atualizada com sucesso', 'image' => $image], 200);
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        Storage::disk('public')->delete(str_replace('/storage/', '', $image->url));
        $image->delete();

        return response()->json(['message' => 'Imagem deletada com sucesso'], 200);
    }
}

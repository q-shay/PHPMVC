<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('created_at', 'desc')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string'
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.'
        ]);

        Categoria::create($validated);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria cadastrada com sucesso!');
    }
}


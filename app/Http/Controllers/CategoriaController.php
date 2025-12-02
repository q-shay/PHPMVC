<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::withCount('produtos')->orderBy('created_at', 'desc')->get();
        $ultimaCategoria = $request->cookie('ultima_categoria_visitada');
        
        return view('categorias.index', compact('categorias', 'ultimaCategoria'));
    }

    public function create()
    {
        return view('categorias.create');
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

    public function show(Request $request, Categoria $categoria)
    {
        $categoria->load('produtos');
        
        $response = response()->view('categorias.show', compact('categoria'));
        $response->cookie('ultima_categoria_visitada', $categoria->nome, 60 * 24 * 7);
        
        return $response;
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string'
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.'
        ]);

        $categoria->update($validated);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->produtos()->count() > 0) {
            return redirect()->route('categorias.index')
                ->with('error', 'Não é possível excluir esta categoria pois há produtos vinculados.');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }
}

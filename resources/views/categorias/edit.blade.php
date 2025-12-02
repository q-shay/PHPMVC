@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">✏️ Editar Categoria</h1>
            <p class="page-subtitle">Atualize os dados da categoria: {{ $categoria->nome }}</p>
        </div>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
            ← Voltar
        </a>
    </div>

    <div class="card" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('categorias.update', $categoria) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="nome">
                        Nome da Categoria <span class="required">*</span>
                    </label>
                    <input type="text" id="nome" name="nome" class="form-control" 
                           value="{{ old('nome', $categoria->nome) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" class="form-control">{{ old('descricao', $categoria->descricao) }}</textarea>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        💾 Salvar Alterações
                    </button>
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection


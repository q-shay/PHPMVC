@extends('layouts.app')

@section('title', 'Nova Categoria')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">🏷️ Nova Categoria</h1>
            <p class="page-subtitle">Crie uma nova categoria para organizar seus produtos</p>
        </div>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
            ← Voltar
        </a>
    </div>

    <div class="card" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="nome">
                        Nome da Categoria <span class="required">*</span>
                    </label>
                    <input type="text" id="nome" name="nome" class="form-control" 
                           value="{{ old('nome') }}" placeholder="Ex: Eletrônicos" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label" for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" class="form-control" 
                              placeholder="Descreva esta categoria...">{{ old('descricao') }}</textarea>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        💾 Cadastrar Categoria
                    </button>
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection


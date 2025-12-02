@extends('layouts.app')

@section('title', 'Novo Produto')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">📦 Novo Produto</h1>
            <p class="page-subtitle">Preencha os dados para cadastrar um novo produto</p>
        </div>
        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">
            ← Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="nome">
                            Nome do Produto <span class="required">*</span>
                        </label>
                        <input type="text" id="nome" name="nome" class="form-control" 
                               value="{{ old('nome') }}" placeholder="Ex: Notebook Dell Inspiron" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="categoria_id">Categoria</label>
                        <select id="categoria_id" name="categoria_id" class="form-control">
                            <option value="">Selecione uma categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" class="form-control" 
                              placeholder="Descreva o produto...">{{ old('descricao') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="preco">
                            Preço (R$) <span class="required">*</span>
                        </label>
                        <input type="number" id="preco" name="preco" class="form-control" 
                               step="0.01" min="0" value="{{ old('preco') }}" placeholder="0,00" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="estoque">
                            Estoque <span class="required">*</span>
                        </label>
                        <input type="number" id="estoque" name="estoque" class="form-control" 
                               min="0" value="{{ old('estoque', 0) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Imagem do Produto (PNG ou JPG)</label>
                    <label class="file-upload">
                        <input type="file" name="imagem" accept="image/png,image/jpeg,image/jpg" onchange="handleFileUpload(this)">
                        <div class="file-upload-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="48" height="48">
                                <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                            </svg>
                        </div>
                        <p class="file-upload-text">Clique para selecionar uma imagem</p>
                        <p class="file-upload-hint">Apenas PNG ou JPG • Máximo 2MB</p>
                        <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 200px; margin-top: 1rem; border-radius: 8px;">
                    </label>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        💾 Cadastrar Produto
                    </button>
                    <a href="{{ route('produtos.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection


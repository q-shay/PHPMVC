@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">✏️ Editar Produto</h1>
            <p class="page-subtitle">Atualize os dados do produto: {{ $produto->nome }}</p>
        </div>
        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">
            ← Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('produtos.update', $produto) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="nome">
                            Nome do Produto <span class="required">*</span>
                        </label>
                        <input type="text" id="nome" name="nome" class="form-control" 
                               value="{{ old('nome', $produto->nome) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="categoria_id">Categoria</label>
                        <select id="categoria_id" name="categoria_id" class="form-control">
                            <option value="">Selecione uma categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id', $produto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" class="form-control">{{ old('descricao', $produto->descricao) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="preco">
                            Preço (R$) <span class="required">*</span>
                        </label>
                        <input type="number" id="preco" name="preco" class="form-control" 
                               step="0.01" min="0" value="{{ old('preco', $produto->preco) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="estoque">
                            Estoque <span class="required">*</span>
                        </label>
                        <input type="number" id="estoque" name="estoque" class="form-control" 
                               min="0" value="{{ old('estoque', $produto->estoque) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Imagem do Produto (PNG ou JPG)</label>
                    
                    @if($produto->imagem)
                        <div style="margin-bottom: 1rem; padding: 1rem; background: var(--bg-tertiary); border-radius: 12px; display: inline-block;">
                            <p style="margin-bottom: 0.5rem; font-weight: 600; color: var(--text-secondary);">Imagem atual:</p>
                            <img src="{{ asset('storage/produtos/' . $produto->imagem) }}" 
                                 alt="{{ $produto->nome }}" 
                                 style="max-width: 200px; border-radius: 8px; border: 2px solid var(--border);">
                        </div>
                    @endif

                    <label class="file-upload">
                        <input type="file" name="imagem" accept="image/png,image/jpeg,image/jpg" onchange="handleFileUpload(this)">
                        <div class="file-upload-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="48" height="48">
                                <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                            </svg>
                        </div>
                        <p class="file-upload-text">{{ $produto->imagem ? 'Clique para trocar a imagem' : 'Clique para selecionar uma imagem' }}</p>
                        <p class="file-upload-hint">Apenas PNG ou JPG • Máximo 2MB</p>
                        <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 200px; margin-top: 1rem; border-radius: 8px;">
                    </label>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        💾 Salvar Alterações
                    </button>
                    <a href="{{ route('produtos.index') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection


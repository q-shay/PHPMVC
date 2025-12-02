@extends('layouts.app')

@section('title', $produto->nome)

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">📦 {{ $produto->nome }}</h1>
            <p class="page-subtitle">Detalhes do produto</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-primary">
                ✏️ Editar
            </a>
            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">
                ← Voltar
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
        <!-- Imagem -->
        <div class="card">
            <div class="card-body" style="text-align: center;">
                @if($produto->imagem)
                    <img src="{{ asset('storage/produtos/' . $produto->imagem) }}" 
                         alt="{{ $produto->nome }}" 
                         style="max-width: 100%; border-radius: 12px; box-shadow: 0 4px 20px var(--shadow);">
                @else
                    <div style="padding: 4rem; background: var(--bg-tertiary); border-radius: 12px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 80px; height: 80px; color: var(--text-muted); opacity: 0.5;">
                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                        </svg>
                        <p style="color: var(--text-muted); margin-top: 1rem;">Sem imagem</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Detalhes -->
        <div class="card">
            <div class="card-header">
                <h2>Informações do Produto</h2>
            </div>
            <div class="card-body">
                <div style="display: grid; gap: 1.5rem;">
                    <div>
                        <label style="font-weight: 600; color: var(--text-muted); font-size: 0.875rem; display: block; margin-bottom: 0.25rem;">Nome</label>
                        <p style="font-size: 1.25rem; color: var(--text-primary); font-weight: 600;">{{ $produto->nome }}</p>
                    </div>

                    <div>
                        <label style="font-weight: 600; color: var(--text-muted); font-size: 0.875rem; display: block; margin-bottom: 0.25rem;">Categoria</label>
                        @if($produto->categoria)
                            <span class="badge badge-primary">{{ $produto->categoria->nome }}</span>
                        @else
                            <span style="color: var(--text-muted);">Sem categoria</span>
                        @endif
                    </div>

                    <div>
                        <label style="font-weight: 600; color: var(--text-muted); font-size: 0.875rem; display: block; margin-bottom: 0.25rem;">Descrição</label>
                        <p style="color: var(--text-secondary); line-height: 1.6;">{{ $produto->descricao ?: 'Sem descrição' }}</p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div style="background: var(--bg-tertiary); padding: 1.5rem; border-radius: 12px; text-align: center;">
                            <label style="font-weight: 600; color: var(--text-muted); font-size: 0.875rem; display: block; margin-bottom: 0.5rem;">Preço</label>
                            <p style="font-size: 2rem; color: var(--success); font-weight: 700;">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                        </div>

                        <div style="background: var(--bg-tertiary); padding: 1.5rem; border-radius: 12px; text-align: center;">
                            <label style="font-weight: 600; color: var(--text-muted); font-size: 0.875rem; display: block; margin-bottom: 0.5rem;">Estoque</label>
                            <p style="font-size: 2rem; color: var(--text-primary); font-weight: 700;">{{ $produto->estoque }} <small style="font-size: 1rem;">unidades</small></p>
                        </div>
                    </div>

                    <div style="border-top: 1px solid var(--border); padding-top: 1.5rem; display: flex; justify-content: space-between; color: var(--text-muted); font-size: 0.875rem;">
                        <span>📅 Cadastrado em: {{ $produto->created_at->format('d/m/Y H:i') }}</span>
                        <span>🔄 Atualizado em: {{ $produto->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ações -->
    <div class="card mt-2">
        <div class="card-body">
            <div class="flex items-center justify-between">
                <div>
                    <h3 style="color: var(--text-primary); margin-bottom: 0.25rem;">Ações</h3>
                    <p style="color: var(--text-muted); font-size: 0.875rem;">Gerencie este produto</p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-primary">
                        ✏️ Editar Produto
                    </a>
                    <form action="{{ route('produtos.destroy', $produto) }}" method="POST" style="display: inline;" 
                          onsubmit="return confirm('Tem certeza que deseja excluir este produto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            🗑️ Excluir Produto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


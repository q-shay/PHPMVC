@extends('layouts.app')

@section('title', $categoria->nome)

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">🏷️ {{ $categoria->nome }}</h1>
            <p class="page-subtitle">Detalhes da categoria e produtos vinculados</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-primary">
                ✏️ Editar
            </a>
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                ← Voltar
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
        <!-- Informações da Categoria -->
        <div class="card">
            <div class="card-header">
                <h2>Informações</h2>
            </div>
            <div class="card-body">
                <div style="display: grid; gap: 1.5rem;">
                    <div>
                        <label style="font-weight: 600; color: var(--text-muted); font-size: 0.875rem; display: block; margin-bottom: 0.25rem;">Nome</label>
                        <p style="font-size: 1.25rem; color: var(--text-primary); font-weight: 600;">{{ $categoria->nome }}</p>
                    </div>

                    <div>
                        <label style="font-weight: 600; color: var(--text-muted); font-size: 0.875rem; display: block; margin-bottom: 0.25rem;">Descrição</label>
                        <p style="color: var(--text-secondary); line-height: 1.6;">{{ $categoria->descricao ?: 'Sem descrição' }}</p>
                    </div>

                    <div style="background: var(--bg-tertiary); padding: 1.5rem; border-radius: 12px; text-align: center;">
                        <label style="font-weight: 600; color: var(--text-muted); font-size: 0.875rem; display: block; margin-bottom: 0.5rem;">Produtos Vinculados</label>
                        <p style="font-size: 2.5rem; color: var(--accent); font-weight: 700;">{{ $categoria->produtos->count() }}</p>
                    </div>

                    <div style="border-top: 1px solid var(--border); padding-top: 1rem; color: var(--text-muted); font-size: 0.875rem;">
                        <p>📅 Criada em: {{ $categoria->created_at->format('d/m/Y H:i') }}</p>
                        <p>🔄 Atualizada em: {{ $categoria->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produtos da Categoria -->
        <div class="card">
            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h2>Produtos desta Categoria</h2>
                <a href="{{ route('produtos.create') }}" class="btn btn-sm btn-primary">+ Novo Produto</a>
            </div>
            
            @if($categoria->produtos->count() > 0)
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Estoque</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categoria->produtos as $produto)
                                <tr>
                                    <td>
                                        @if($produto->imagem)
                                            <img src="{{ asset('storage/produtos/' . $produto->imagem) }}" 
                                                 alt="{{ $produto->nome }}" 
                                                 class="product-image">
                                        @else
                                            <div class="product-image-placeholder">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong style="color: var(--text-primary)">{{ $produto->nome }}</strong>
                                    </td>
                                    <td>
                                        <strong style="color: var(--success)">R$ {{ number_format($produto->preco, 2, ',', '.') }}</strong>
                                    </td>
                                    <td>{{ $produto->estoque }} un.</td>
                                    <td>
                                        <a href="{{ route('produtos.show', $produto) }}" class="btn btn-sm btn-secondary">
                                            Ver
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="card-body">
                    <div class="empty-state" style="padding: 2rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 48px; height: 48px;">
                            <path d="M20 2H4c-1 0-2 .9-2 2v3.01c0 .72.43 1.34 1 1.69V20c0 1.1 1.1 2 2 2h14c.9 0 2-.9 2-2V8.7c.57-.35 1-.97 1-1.69V4c0-1.1-1-2-2-2zm-5 12H9v-2h6v2zm5-7H4V4h16v3z"/>
                        </svg>
                        <h3>Nenhum produto nesta categoria</h3>
                        <p>Adicione produtos a esta categoria.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Ações -->
    <div class="card mt-2">
        <div class="card-body">
            <div class="flex items-center justify-between">
                <div>
                    <h3 style="color: var(--text-primary); margin-bottom: 0.25rem;">Ações</h3>
                    <p style="color: var(--text-muted); font-size: 0.875rem;">Gerencie esta categoria</p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-primary">
                        ✏️ Editar Categoria
                    </a>
                    @if($categoria->produtos->count() == 0)
                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display: inline;" 
                              onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                🗑️ Excluir Categoria
                            </button>
                        </form>
                    @else
                        <button class="btn btn-danger" disabled title="Não é possível excluir categorias com produtos vinculados">
                            🗑️ Excluir Categoria
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


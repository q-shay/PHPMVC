@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">📦 Produtos</h1>
            <p class="page-subtitle">Gerencie o catálogo de produtos do sistema</p>
        </div>
        <a href="{{ route('produtos.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
            </svg>
            Novo Produto
        </a>
    </div>

    @if($produtos->count() > 0)
        <div class="card">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Cadastrado em</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td>
                                    @if($produto->imagem)
                                        <img src="{{ asset('storage/produtos/' . $produto->imagem) }}" 
                                             alt="{{ $produto->nome }}" 
                                             class="product-image">
                                    @else
                                        <div class="product-image-placeholder">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong style="color: var(--text-primary)">{{ $produto->nome }}</strong>
                                    @if($produto->descricao)
                                        <br><small style="color: var(--text-muted)">{{ Str::limit($produto->descricao, 50) }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($produto->categoria)
                                        <span class="badge badge-primary">{{ $produto->categoria->nome }}</span>
                                    @else
                                        <span style="color: var(--text-muted)">—</span>
                                    @endif
                                </td>
                                <td>
                                    <strong style="color: var(--success)">R$ {{ number_format($produto->preco, 2, ',', '.') }}</strong>
                                </td>
                                <td>
                                    @if($produto->estoque > 10)
                                        <span class="badge badge-success">{{ $produto->estoque }} un.</span>
                                    @elseif($produto->estoque > 0)
                                        <span class="badge" style="background: #fef3c7; color: #d97706;">{{ $produto->estoque }} un.</span>
                                    @else
                                        <span class="badge" style="background: var(--error-bg); color: var(--error);">Esgotado</span>
                                    @endif
                                </td>
                                <td>{{ $produto->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" style="justify-content: center;">
                                        <a href="{{ route('produtos.show', $produto) }}" class="btn btn-sm btn-secondary" title="Visualizar">
                                            👁️
                                        </a>
                                        <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-sm btn-secondary" title="Editar">
                                            ✏️
                                        </a>
                                        <form action="{{ route('produtos.destroy', $produto) }}" method="POST" style="display: inline;" 
                                              onsubmit="return confirm('Tem certeza que deseja excluir este produto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="card">
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20 2H4c-1 0-2 .9-2 2v3.01c0 .72.43 1.34 1 1.69V20c0 1.1 1.1 2 2 2h14c.9 0 2-.9 2-2V8.7c.57-.35 1-.97 1-1.69V4c0-1.1-1-2-2-2zm-5 12H9v-2h6v2zm5-7H4V4h16v3z"/>
                </svg>
                <h3>Nenhum produto cadastrado</h3>
                <p>Comece adicionando seu primeiro produto ao catálogo.</p>
                <a href="{{ route('produtos.create') }}" class="btn btn-primary mt-2">
                    Cadastrar Produto
                </a>
            </div>
        </div>
    @endif
@endsection

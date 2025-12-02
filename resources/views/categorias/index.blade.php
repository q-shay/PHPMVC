@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">🏷️ Categorias</h1>
            <p class="page-subtitle">Organize seus produtos em categorias</p>
        </div>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
            </svg>
            Nova Categoria
        </a>
    </div>

    @if($categorias->count() > 0)
        <div class="card">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Produtos</th>
                            <th>Cadastrado em</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                            <tr>
                                <td>
                                    <span class="badge badge-primary">#{{ $categoria->id }}</span>
                                </td>
                                <td>
                                    <strong style="color: var(--text-primary)">{{ $categoria->nome }}</strong>
                                </td>
                                <td>
                                    <span style="color: var(--text-secondary)">{{ $categoria->descricao ? Str::limit($categoria->descricao, 60) : '—' }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">{{ $categoria->produtos_count }} produtos</span>
                                </td>
                                <td>{{ $categoria->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" style="justify-content: center;">
                                        <a href="{{ route('categorias.show', $categoria) }}" class="btn btn-sm btn-secondary" title="Visualizar">
                                            👁️
                                        </a>
                                        <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-secondary" title="Editar">
                                            ✏️
                                        </a>
                                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display: inline;" 
                                              onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Excluir" 
                                                    {{ $categoria->produtos_count > 0 ? 'disabled' : '' }}>
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
                    <path d="M17.63 5.84C17.27 5.33 16.67 5 16 5L5 5.01C3.9 5.01 3 5.9 3 7v10c0 1.1.9 1.99 2 1.99L16 19c.67 0 1.27-.33 1.63-.84L22 12l-4.37-6.16z"/>
                </svg>
                <h3>Nenhuma categoria cadastrada</h3>
                <p>Crie categorias para organizar seus produtos.</p>
                <a href="{{ route('categorias.create') }}" class="btn btn-primary mt-2">
                    Cadastrar Categoria
                </a>
            </div>
        </div>
    @endif
@endsection

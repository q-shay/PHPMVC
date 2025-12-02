@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">🏠 Dashboard</h1>
            <p class="page-subtitle">Bem-vindo ao Sistema de Gestão MVC Laravel</p>
        </div>
    </div>

    <!-- Cards de Estatísticas -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <!-- Total de Produtos -->
        <div class="card" style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
            <div class="card-body" style="color: white;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="opacity: 0.9; font-size: 0.875rem; margin-bottom: 0.5rem;">Total de Produtos</p>
                        <h2 style="font-size: 2.5rem; font-weight: 700;">{{ \App\Models\Produto::count() }}</h2>
                    </div>
                    <div style="background: rgba(255,255,255,0.2); padding: 1rem; border-radius: 12px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 2H4c-1 0-2 .9-2 2v3.01c0 .72.43 1.34 1 1.69V20c0 1.1 1.1 2 2 2h14c.9 0 2-.9 2-2V8.7c.57-.35 1-.97 1-1.69V4c0-1.1-1-2-2-2zm-5 12H9v-2h6v2zm5-7H4V4h16v3z"/>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('produtos.index') }}" style="color: white; opacity: 0.9; font-size: 0.875rem; text-decoration: none; display: inline-block; margin-top: 1rem;">
                    Ver todos →
                </a>
            </div>
        </div>

        <!-- Total de Categorias -->
        <div class="card" style="background: linear-gradient(135deg, #10b981, #059669);">
            <div class="card-body" style="color: white;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="opacity: 0.9; font-size: 0.875rem; margin-bottom: 0.5rem;">Total de Categorias</p>
                        <h2 style="font-size: 2.5rem; font-weight: 700;">{{ \App\Models\Categoria::count() }}</h2>
                    </div>
                    <div style="background: rgba(255,255,255,0.2); padding: 1rem; border-radius: 12px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.63 5.84C17.27 5.33 16.67 5 16 5L5 5.01C3.9 5.01 3 5.9 3 7v10c0 1.1.9 1.99 2 1.99L16 19c.67 0 1.27-.33 1.63-.84L22 12l-4.37-6.16z"/>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('categorias.index') }}" style="color: white; opacity: 0.9; font-size: 0.875rem; text-decoration: none; display: inline-block; margin-top: 1rem;">
                    Ver todas →
                </a>
            </div>
        </div>

        <!-- Usuário Logado -->
        <div class="card" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
            <div class="card-body" style="color: white;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="opacity: 0.9; font-size: 0.875rem; margin-bottom: 0.5rem;">Logado como</p>
                        <h2 style="font-size: 1.5rem; font-weight: 700;">{{ session('user_nome', 'Visitante') }}</h2>
                        <p style="opacity: 0.8; font-size: 0.75rem; margin-top: 0.25rem;">{{ session('user_email', '') }}</p>
                    </div>
                    <div style="background: rgba(255,255,255,0.2); padding: 1rem; border-radius: 12px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                        </svg>
                    </div>
                </div>
                <p style="opacity: 0.9; font-size: 0.875rem; margin-top: 1rem;">
                    🔐 Sessão ativa
                </p>
            </div>
        </div>
    </div>

    <!-- Seção de Informações do Sistema -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
        <!-- Últimos Produtos -->
        <div class="card">
            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h2>📦 Últimos Produtos Cadastrados</h2>
                <a href="{{ route('produtos.create') }}" class="btn btn-sm btn-primary">+ Novo</a>
            </div>
            @php $ultimosProdutos = \App\Models\Produto::with('categoria')->latest()->take(5)->get(); @endphp
            @if($ultimosProdutos->count() > 0)
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Categoria</th>
                                <th>Preço</th>
                                <th>Estoque</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ultimosProdutos as $produto)
                                <tr>
                                    <td>
                                        <a href="{{ route('produtos.show', $produto) }}" style="color: var(--text-primary); text-decoration: none; font-weight: 600;">
                                            {{ $produto->nome }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($produto->categoria)
                                            <span class="badge badge-primary">{{ $produto->categoria->nome }}</span>
                                        @else
                                            <span style="color: var(--text-muted);">—</span>
                                        @endif
                                    </td>
                                    <td style="color: var(--success); font-weight: 600;">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                    <td>{{ $produto->estoque }} un.</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="card-body">
                    <div class="empty-state" style="padding: 2rem;">
                        <p>Nenhum produto cadastrado ainda.</p>
                        <a href="{{ route('produtos.create') }}" class="btn btn-primary mt-1">Cadastrar Produto</a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Requisitos do Trabalho -->
        <div class="card">
            <div class="card-header">
                <h2>📋 Funcionalidades</h2>
            </div>
            <div class="card-body">
                <ul style="list-style: none; display: grid; gap: 0.75rem;">
                    <li style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: var(--bg-tertiary); border-radius: 8px;">
                        <span style="color: var(--success); font-size: 1.25rem;">✅</span>
                        <span>CRUD Completo (Produtos/Categorias)</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: var(--bg-tertiary); border-radius: 8px;">
                        <span style="color: var(--success); font-size: 1.25rem;">✅</span>
                        <span>Banco de Dados MySQL</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: var(--bg-tertiary); border-radius: 8px;">
                        <span style="color: var(--success); font-size: 1.25rem;">✅</span>
                        <span>Sessões (Login/Logout)</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: var(--bg-tertiary); border-radius: 8px;">
                        <span style="color: var(--success); font-size: 1.25rem;">✅</span>
                        <span>Upload de Arquivos (PNG/JPG)</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: var(--bg-tertiary); border-radius: 8px;">
                        <span style="color: var(--success); font-size: 1.25rem;">✅</span>
                        <span>Cookies (Tema + Última Categoria)</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: var(--bg-tertiary); border-radius: 8px;">
                        <span style="color: var(--success); font-size: 1.25rem;">✅</span>
                        <span>Validação de Dados</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: var(--bg-tertiary); border-radius: 8px;">
                        <span style="color: var(--success); font-size: 1.25rem;">✅</span>
                        <span>Arquitetura MVC</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Ações Rápidas -->
    <div class="card mt-2">
        <div class="card-header">
            <h2>⚡ Ações Rápidas</h2>
        </div>
        <div class="card-body">
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('produtos.create') }}" class="btn btn-primary">
                    📦 Novo Produto
                </a>
                <a href="{{ route('categorias.create') }}" class="btn btn-success">
                    🏷️ Nova Categoria
                </a>
                <button class="btn btn-secondary" onclick="toggleTheme()">
                    🌙 Alternar Tema
                </button>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
    <h1>Gerenciamento de Produtos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <ul style="margin-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2>Cadastrar Novo Produto</h2>
    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome do Produto *</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao">{{ old('descricao') }}</textarea>
        </div>

        <div class="form-group">
            <label for="preco">Preço (R$) *</label>
            <input type="number" id="preco" name="preco" step="0.01" min="0" value="{{ old('preco') }}" required>
        </div>

        <div class="form-group">
            <label for="estoque">Estoque *</label>
            <input type="number" id="estoque" name="estoque" min="0" value="{{ old('estoque') }}" required>
        </div>

        <button type="submit">Cadastrar Produto</button>
    </form>

    <h2>Lista de Produtos</h2>
    @if($produtos->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Cadastrado em</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produtos as $produto)
                    <tr>
                        <td>{{ $produto->id }}</td>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->descricao ?? 'N/A' }}</td>
                        <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                        <td>{{ $produto->estoque }}</td>
                        <td>{{ $produto->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <p>Nenhum produto cadastrado ainda.</p>
        </div>
    @endif
@endsection


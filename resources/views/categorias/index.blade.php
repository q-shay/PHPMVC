@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
    <h1>Gerenciamento de Categorias</h1>

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

    <h2>Cadastrar Nova Categoria</h2>
    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome da Categoria *</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao">{{ old('descricao') }}</textarea>
        </div>

        <button type="submit">Cadastrar Categoria</button>
    </form>

    <h2>Lista de Categorias</h2>
    @if($categorias->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Cadastrado em</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nome }}</td>
                        <td>{{ $categoria->descricao ?? 'N/A' }}</td>
                        <td>{{ $categoria->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <p>Nenhuma categoria cadastrada ainda.</p>
        </div>
    @endif
@endsection


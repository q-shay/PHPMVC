@extends('layouts.app')

@section('title', 'Home - Laravel MVC')

@section('content')
    <h1>Bem-vindo ao Sistema Laravel MVC</h1>
    
    <div style="margin-top: 30px;">
        <p style="font-size: 18px; color: #555; margin-bottom: 30px;">
            Sistema de gerenciamento de produtos e categorias construído com Laravel MVC.
        </p>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 40px;">
            <div style="padding: 30px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #007bff;">
                <h2 style="color: #007bff; margin-bottom: 15px;">📦 Produtos</h2>
                <p style="color: #666; margin-bottom: 20px;">
                    Gerencie seus produtos com informações de nome, descrição, preço e estoque.
                </p>
                <a href="{{ route('produtos.index') }}" style="display: inline-block; background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                    Acessar Produtos
                </a>
            </div>

            <div style="padding: 30px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #28a745;">
                <h2 style="color: #28a745; margin-bottom: 15px;">🏷️ Categorias</h2>
                <p style="color: #666; margin-bottom: 20px;">
                    Organize seus produtos em categorias com nome e descrição personalizados.
                </p>
                <a href="{{ route('categorias.index') }}" style="display: inline-block; background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                    Acessar Categorias
                </a>
            </div>
        </div>

        <div style="margin-top: 50px; padding: 25px; background: #e9ecef; border-radius: 8px;">
            <h3 style="color: #333; margin-bottom: 15px;">✅ Recursos Implementados</h3>
            <ul style="color: #555; line-height: 2; margin-left: 20px;">
                <li>2 Controllers (ProdutoController e CategoriaController)</li>
                <li>2 Models com Migrations (Produto e Categoria)</li>
                <li>2 Views usando Blade (produtos/index e categorias/index)</li>
                <li>Rotas GET e POST configuradas</li>
                <li>Métodos index() e store() em cada controller</li>
                <li>Formulários de cadastro</li>
                <li>Listagem de dados do banco</li>
                <li>Validação de dados</li>
                <li>Mensagens de sucesso/erro</li>
                <li>Layout responsivo e organizado</li>
            </ul>
        </div>
    </div>
@endsection


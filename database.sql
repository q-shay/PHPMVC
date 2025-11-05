
CREATE DATABASE IF NOT EXISTS laravel_mvc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE laravel_mvc;
CREATE TABLE IF NOT EXISTS migrations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    batch INT NOT NULL
);


CREATE TABLE IF NOT EXISTS produtos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    estoque INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);


CREATE TABLE IF NOT EXISTS categorias (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

INSERT INTO categorias (nome, descricao, created_at, updated_at) VALUES
('Eletrônicos', 'Produtos eletrônicos e tecnologia', NOW(), NOW()),
('Informática', 'Computadores e acessórios', NOW(), NOW()),
('Móveis', 'Móveis para escritório e casa', NOW(), NOW()),
('Livros', 'Livros técnicos e literários', NOW(), NOW());

INSERT INTO produtos (nome, descricao, preco, estoque, created_at, updated_at) VALUES
('Notebook Dell', 'Notebook Dell Inspiron 15, 8GB RAM, 256GB SSD', 3500.00, 10, NOW(), NOW()),
('Mouse Logitech', 'Mouse sem fio Logitech MX Master 3', 450.00, 25, NOW(), NOW()),
('Teclado Mecânico', 'Teclado mecânico RGB com switches blue', 350.00, 15, NOW(), NOW()),
('Monitor LG 24"', 'Monitor LG 24 polegadas Full HD IPS', 800.00, 8, NOW(), NOW()),
('Webcam HD', 'Webcam Full HD 1080p com microfone', 250.00, 20, NOW(), NOW()),
('Headset Gamer', 'Headset gamer 7.1 surround sound', 300.00, 12, NOW(), NOW()),
('HD Externo 1TB', 'HD Externo portátil 1TB USB 3.0', 350.00, 18, NOW(), NOW()),
('Pen Drive 64GB', 'Pen Drive USB 3.0 64GB', 45.00, 50, NOW(), NOW());

SELECT 'Produtos cadastrados:' AS info;
SELECT * FROM produtos;

SELECT 'Categorias cadastradas:' AS info;
SELECT * FROM categorias;

/*os dados foram gerados por IA (:*/
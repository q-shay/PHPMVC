CREATE DATABASE IF NOT EXISTS laravel_mvc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE laravel_mvc;

CREATE TABLE IF NOT EXISTS migrations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    batch INT NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

INSERT INTO users (nome, email, password, created_at, updated_at) VALUES
('Administrador', 'admin@admin.com', '$2y$12$rHQf8CsJgqpGQg6ZrGvdnOJGQFYPQn8RJ0gGKZ5eA6VVyU4.qx3Gu', NOW(), NOW());

CREATE TABLE IF NOT EXISTS categorias (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS produtos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    estoque INT NOT NULL DEFAULT 0,
    imagem VARCHAR(255) NULL,
    categoria_id BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX sessions_user_id_index (user_id),
    INDEX sessions_last_activity_index (last_activity)
);

INSERT INTO categorias (nome, descricao, created_at, updated_at) VALUES
('Eletrônicos', 'Produtos eletrônicos e tecnologia', NOW(), NOW()),
('Informática', 'Computadores, notebooks e acessórios', NOW(), NOW()),
('Móveis', 'Móveis para escritório e casa', NOW(), NOW()),
('Livros', 'Livros técnicos e literários', NOW(), NOW()),
('Games', 'Jogos e consoles', NOW(), NOW());

INSERT INTO produtos (nome, descricao, preco, estoque, categoria_id, created_at, updated_at) VALUES
('Notebook Dell Inspiron', 'Notebook Dell Inspiron 15, 8GB RAM, 256GB SSD', 3500.00, 10, 2, NOW(), NOW()),
('Mouse Logitech MX Master', 'Mouse sem fio ergonômico com precisão profissional', 450.00, 25, 2, NOW(), NOW()),
('Teclado Mecânico RGB', 'Teclado mecânico com switches blue e iluminação RGB', 350.00, 15, 2, NOW(), NOW()),
('Monitor LG 24"', 'Monitor LG 24 polegadas Full HD IPS', 800.00, 8, 1, NOW(), NOW()),
('Webcam HD 1080p', 'Webcam Full HD 1080p com microfone integrado', 250.00, 20, 1, NOW(), NOW()),
('Headset Gamer 7.1', 'Headset gamer com som surround 7.1', 300.00, 12, 5, NOW(), NOW()),
('HD Externo 1TB', 'HD Externo portátil 1TB USB 3.0', 350.00, 18, 2, NOW(), NOW()),
('Pen Drive 64GB', 'Pen Drive USB 3.0 de alta velocidade', 45.00, 50, 2, NOW(), NOW()),
('Cadeira Gamer', 'Cadeira gamer ergonômica com apoio lombar', 1200.00, 5, 3, NOW(), NOW()),
('Mesa para Escritório', 'Mesa em L para escritório com gavetas', 850.00, 3, 3, NOW(), NOW());

/*os dados foram gerados por IA (:*/

-- 3.1 Criação do Banco de Dados
CREATE DATABASE saep_db;
\c saep_db; -- Para PostgreSQL (Use 'USE saep_db;' se estiver no MySQL)

-- Tabela de Usuários
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Tabela de Produtos
CREATE TABLE produtos (
    id SERIAL PRIMARY KEY,
    codigo VARCHAR(20) UNIQUE NOT NULL,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    especificacoes TEXT, -- Ex: "Cabeça em Aço, Cabo em Madeira" ou "Ponta Imantada"
    tamanho VARCHAR(30),
    peso NUMERIC(8,2), -- em gramas ou kg
    quantidade_atual INT NOT NULL DEFAULT 0,
    quantidade_minima INT NOT NULL DEFAULT 0
);

-- Tabela de Movimentações (Histórico e Rastreabilidade)
CREATE TABLE movimentacoes (
    id SERIAL PRIMARY KEY,
    usuario_id INT NOT NULL REFERENCES usuarios(id),
    produto_id INT NOT NULL REFERENCES produtos(id) ON DELETE CASCADE,
    tipo VARCHAR(10) CHECK (tipo IN ('ENTRADA', 'SAIDA')) NOT NULL,
    quantidade INT NOT NULL,
    data_movimentacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- 3.2 População Inicial com 3 registros por tabela
INSERT INTO usuarios (nome, email, senha) VALUES
('Carlos Almoxarife', 'carlos@empresa.com', '123456'),
('Ana Gestora', 'ana@empresa.com', '123456'),
('João Operador', 'joao@empresa.com', '123456');

INSERT INTO produtos (codigo, nome, categoria, especificacoes, tamanho, peso, quantidade_atual, quantidade_minima) VALUES
('MRT-001', 'Martelo Unha 27mm', 'Martelos', 'Cabeça de Aço Forjado, Cabo de Fibra de Vidro Emborrachado', '27mm / 32cm', 0.65, 15, 5),
('CFD-002', 'Chave de Fenda Isolada 1,000V', 'Chaves', 'Haste em Aço Cromo Vanádio, Cabo Isolado VDE, Ponta Imantada', '1/4" x 6"', 0.12, 4, 10),
('ALN-003', 'Jogo de Chaves Allen', 'Chaves', 'Aço Carbono, Acabamento Fosfatizado, Acompanha Suporte', '1.5mm a 10mm', 0.45, 8, 3);

INSERT INTO movimentacoes (usuario_id, produto_id, tipo, quantidade, data_movimentacao) VALUES
(1, 1, 'ENTRADA', 15, '2026-07-20 08:30:00'),
(2, 2, 'ENTRADA', 10, '2026-07-21 09:15:00'),
(3, 2, 'SAIDA', 6, '2026-07-22 14:00:00');
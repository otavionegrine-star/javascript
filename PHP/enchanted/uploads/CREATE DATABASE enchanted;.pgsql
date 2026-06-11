CREATE DATABASE enchanted;

--Tabela de Funcionários (Staff)
CREATE TABLE funcionario (
    id serial PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);

--Tabela de Clientes
CREATE TABLE cliente (
    id serial PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);

--Tabela de Personagens (Vitrine e Cadastro)
CREATE TABLE personagem (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    descricao TEXT,
    imagem_url VARCHAR(500) DEFAULT 'assets/default-avatar.png',
    cadastrado_por_id INT REFERENCES funcionario(id) ON DELETE SET NULL
);

--Tabela de Agendamentos/Aluguel (Booking)
CREATE TABLE alugar_personagem (
    id SERIAL PRIMARY KEY,
    cliente_id INT NOT NULL REFERENCES cliente(id) ON DELETE CASCADE,
    personagem_id INT NOT NULL REFERENCES personagem(id) ON DELETE CASCADE,
    local_festa VARCHAR(255) NOT NULL,
    data_festa DATE NOT NULL,
    horario_inicio TIME NOT NULL,
    horario_termino TIME NOT NULL,
    status VARCHAR(50) DEFAULT 'Ativo',
    experiencia VARCHAR(100) DEFAULT 'Conto de Fadas'
);
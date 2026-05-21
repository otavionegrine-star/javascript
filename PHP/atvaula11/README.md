# Criando o arquivo README.md com uma estrutura profissional e estilizada para o desafio de banco de dados do aluno.

readme_content = """# 🐾 Mini Desafio: Sistema de Empresa Pet

Este repositório contém a resolução do **Desafio Profissional Inicial (Autonomia Assistida)**, que consiste na criação e manipulação da estrutura de base de dados para o sistema de uma empresa pet, integrado com uma interface em PHP.

---

## 🚀 Requisitos do Projeto

O projeto cumpre todos os requisitos mínimos exigidos:
1. **Criação de tabela:** Tabela `cachorros` estruturada no PostgreSQL.
2. **Inserção de dados:** Inserção de 3 registos iniciais.
3. **Consulta de dados:** Execução de comando `SELECT` para listagem.
4. **Atualização de dados:** Execução de comando `UPDATE` utilizando a Chave Primária (`id`).
5. **Interface Web:** Ficheiro `index.php` para conexão e exibição dos dados em tempo real.
6. **Autoavaliação:** Respostas teóricas sobre o funcionamento dos dados.

---

## 🛠️ Tecnologias Utilizadas

* **PHP 8.x** (Utilizando PDO para conexão segura)
* **PostgreSQL** (Sistema Gerenciador de Base de Dados)
* **HTML5 / CSS3** (Para renderização e estilização da tabela)
* **Visual Studio Code** (Ambiente de Desenvolvimento)

---

## 📂 Estrutura do Ficheiro `index.php`

O código PHP utiliza o **PDO (PHP Data Objects)** ligado ao driver `pgsql`. Ele executa automaticamente os seguintes passos ao ser carregado:
1. Conecta-se ao servidor local do PostgreSQL.
2. Cria a tabela `cachorros` caso esta ainda não exista (`CREATE TABLE IF NOT EXISTS`).
3. Verifica se a tabela está vazia para evitar duplicados e insere os cães: *Rex*, *Mel* e *Thor*.
4. Executa o comando `UPDATE` para alterar a idade do cão *Rex* de 3 para 4 anos de forma segura, filtrando pelo `id = 1`.
5. Realiza um `SELECT * FROM cachorros ORDER BY id ASC` e popula a tabela HTML.

---

## 📝 Respostas da Autoavaliação do Aluno

### 1. Entendo onde os dados ficam armazenados?
**Sim.** Os dados ficam armazenados de forma persistente e estruturada em tabelas dentro de um Sistema Gerenciador de Base de Dados (SGBD), neste caso, o PostgreSQL. As tabelas organizam as informações em linhas (registos) e colunas (atributos/campos).

### 2. Sei a diferença entre INSERT e SELECT?
**Sim.** O `INSERT` é um comando do grupo DML (Data Manipulation Language) utilizado para **gravar/inserir** novos registos na base de dados. O `SELECT` é um comando utilizado para **consultar/procurar** e ler dados que já existem no banco, sem alterá-los.

### 3. Consigo explicar a estrutura da tabela?
**Sim.** A tabela `cachorros` possui a seguinte estrutura:
* `id`: Chave Primária (`PRIMARY KEY`), do tipo numérico auto-incrementado (`SERIAL`), garantindo que cada cão tenha um identificador único.
* `nome`: Tipo texto (`VARCHAR(50)`), obrigatório (`NOT NULL`).
* `raca`: Tipo texto (`VARCHAR(50)`), para armazenar a raça.
* `idade`: Tipo numérico inteiro (`INT`), para armazenar os anos de vida.

---

## 💾 Script de Dump para Testes

Caso queira recriar a estrutura diretamente no seu PostgreSQL, utilize o script abaixo:

```sql
-- Criação da tabela
CREATE TABLE IF NOT EXISTS cachorros (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    raca VARCHAR(50),
    idade INT
);

-- Inserção dos dados originais e atualizados
INSERT INTO cachorros (id, nome, raca, idade) VALUES (1, 'Rex', 'Labrador', 4);
INSERT INTO cachorros (id, nome, raca, idade) VALUES (2, 'Mel', 'Poodle', 5);
INSERT INTO cachorros (id, nome, raca, idade) VALUES (3, 'Thor', 'Vira-lata', 2);
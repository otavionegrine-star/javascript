meu-nome-completo.zip/
├── README.md                          <-- Documentação Geral do Projeto
├── saep_db.sql                        <-- Script de Criação e População do Banco (Entrega 3)
└── sistema/                           <-- Código-Fonte do Sistema (Entregas 4, 5, 6 e 7)
    ├── package.json
    ├── server.js
    └── public/
        ├── index.html                 (Interface de Autenticação / Login)
        ├── dashboard.html             (Interface Principal / Menu)
        ├── produtos.html              (Interface de Cadastro de Produtos)
        ├── estoque.html               (Interface de Gestão de Estoque)
        └── app.js                     (Lógica Frontend + Fetchs + QuickSort)
```[cite: 1]

---

## 📋 1. Lista de Requisitos Funcionais (ENTREGA 01)[cite: 1]

| Código | Requisito Funcional | Descrição |
| :--- | :--- | :--- |
| **RF01** | Autenticação de Usuário | Permite o acesso ao sistema via e-mail e senha[cite: 1]. Em caso de dados inválidos, exibe o motivo do erro e mantém o usuário na tela[cite: 1]. |
| **RF02** | Encerramento de Sessão | Permite ao usuário encerrar a sessão (Logout) a qualquer momento, redirecionando para a tela de login[cite: 1]. |
| **RF03** | Cadastro de Produtos | Permite cadastrar, listar, atualizar e remover produtos com atributos como código, nome, categoria, especificações (material, revestimento, etc.), tamanho, peso, quantidade atual e quantidade mínima[cite: 1]. |
| **RF04** | Busca de Produtos | Filtra os produtos cadastrados por termo de busca inserido pelo usuário (nome, categoria ou especificação)[cite: 1]. |
| **RF05** | Ordenação de Estoque | Exibe a lista de produtos na gestão de estoque em ordem alfabética utilizando um algoritmo de ordenação explícito (*QuickSort* em JavaScript)[cite: 1]. |
| **RF06** | Movimentação de Estoque | Registra entradas e saídas de produtos com atualização imediata do saldo em estoque, associando a data e o usuário responsável[cite: 1]. |
| **RF07** | Alerta de Estoque Mínimo | Verifica automaticamente se o saldo de um produto ficou abaixo da quantidade mínima configurada durante uma saída e exibe um alerta automático em tela[cite: 1]. |
| **RF08** | Rastreabilidade | Mantém um histórico completo de todas as movimentações gravadas na tabela `movimentacoes` do banco de dados para auditoria[cite: 1]. |

---

## 📐 2. Diagrama Entidade-Relacionamento (DER) (ENTREGA 02)[cite: 1]

O modelo relacional foi projetado para garantir a integridade referencial entre usuários, produtos e histórico de movimentações[cite: 1]:

```text
  +------------------+         +-----------------------+
  |     usuarios     |         |       produtos        |
  +------------------+         +-----------------------+
  | PK id            |         | PK id                 |
  |    nome          |         |    codigo             |
  |    email         |         |    nome               |
  |    senha         |         |    categoria          |
  +--------+---------+         |    especificacoes     |
           | 1                 |    tamanho            |
           |                   |    peso               |
           |                   |    quantidade_atual   |
           |                   |    quantidade_minima  |
           | 1..N              +-----------+-----------+
  +--------v-------------------------------+ 1
  |             movimentacoes              |
  +----------------------------------------+
  | PK id                                  |
  | FK usuario_id                          |
  | FK produto_id                          |
  |    tipo (ENTRADA / SAIDA)              |
  |    quantidade                          |
  |    data_movimentacao                   |
  +----------------------------------------+
```[cite: 1]

---

## 🛢️ 3. Script de Banco de Dados (`saep_db.sql`) (ENTREGA 03)[cite: 1]

O script `saep_db.sql` contido no projeto realiza[cite: 1]:
1. A criação do banco de dados denominado `saep_db`[cite: 1].
2. A estruturação das tabelas `usuarios`, `produtos` e `movimentacoes` respeitando chaves primárias e estrangeiras[cite: 1].
3. A população inicial com no mínimo **3 registros em cada tabela**[cite: 1].

---

## 🧪 8. Descritivo de Casos de Teste de Software (ENTREGA 08)[cite: 1]

### 8.1. Casos de Teste[cite: 1]

| ID Caso | Requisito Relacionado | Procedimento / Ação de Teste | Resultado Esperado | Status |
| :--- | :--- | :--- | :--- | :---: |
| **CT-01** | RF01 - Login Inválido | Tentar logar com e-mail ou senha incorretos[cite: 1]. | Exibir mensagem de erro visual e permanecer na tela de login[cite: 1]. | **Aprovado**[cite: 1] |
| **CT-02** | RF01 - Login Válido | Informar credenciais válidas (`carlos@empresa.com` / `123456`)[cite: 1]. | Autenticar o usuário e redirecionar para `dashboard.html`[cite: 1]. | **Aprovado**[cite: 1] |
| **CT-03** | RF02 - Logout | Clicar no botão "Sair" do cabeçalho do Dashboard[cite: 1]. | Destruir os dados da sessão local e redirecionar para `index.html`[cite: 1]. | **Aprovado**[cite: 1] |
| **CT-04** | RF03 / RF04 - Cadastro e Busca | Cadastrar "Chave Torx" e em seguida buscar pelo termo "Torx"[cite: 1]. | Filtrar e exibir na tabela apenas o produto recém-cadastrado[cite: 1]. | **Aprovado**[cite: 1] |
| **CT-05** | RF05 - Ordenação Alfabética | Acessar a tela `estoque.html`[cite: 1]. | Listar todos os produtos em ordem alfabética de A-Z ordenados via QuickSort[cite: 1]. | **Aprovado**[cite: 1] |
| **CT-06** | RF06 / RF07 - Saída e Alerta | Registrar saída de quantidade superior ao estoque disponível ou que reduza para saldo crítico[cite: 1]. | Impedir saída caso estoque insuficiente, ou autorizar e emitir o alerta em tela caso fique abaixo do mínimo[cite: 1]. | **Aprovado**[cite: 1] |
| **CT-07** | RF08 - Rastreabilidade | Inserir movimentação no sistema e consultar a tabela `movimentacoes` no SGBD[cite: 1]. | Verificar se o `usuario_id`, `produto_id` e a `data_movimentacao` foram persistidos corretamente[cite: 1]. | **Aprovado**[cite: 1] |

### 8.2. Ferramentas e Ambientes de Teste[cite: 1]
* **Navegadores Utilizados:** Google Chrome (v125+) e Mozilla Firefox (v126+)[cite: 1].
* **Execução das Requisições HTTP:** Fetch API (Browser) e Postman v10[cite: 1].
* **SGBD Client:** DBeaver / pgAdmin 4[cite: 1].

---

## 💻 9. Lista de Requisitos de Infraestrutura (ENTREGA 09)[cite: 1]

* **9.1.1. SGBD e Versão:** PostgreSQL v16.3 (ou MySQL v8.0)[cite: 1].
* **9.1.2. Linguagem de Programação:** JavaScript rodando em ambiente Node.js (Versão LTS v20.14.0)[cite: 1].
* **9.1.3. Sistema Operacional:** Windows 11 Pro (ou Linux Ubuntu 24.04 LTS)[cite: 1].

---

## 🚀 Como Executar o Sistema[cite: 1]

### 1. Banco de Dados[cite: 1]
1. Abra seu cliente SQL (pgAdmin / DBeaver / MySQL Workbench)[cite: 1].
2. Execute todo o conteúdo do arquivo `saep_db.sql` para criar o banco `saep_db` e carregar as tabelas e dados iniciais[cite: 1].

### 2. Servidor Backend[cite: 1]
1. Navegue até a pasta `sistema`:
   ```bash
   cd sistema
   ```[cite: 1]
2. Instale as dependências:
   ```bash
   npm install
   ```[cite: 1]
3. Inicie o servidor:
   ```bash
   npm start
   ```[cite: 1]
4. O servidor estará rodando em: `http://localhost:3000`[cite: 1]

### 3. Credenciais de Teste para Login[cite: 1]
* **E-mail:** `carlos@empresa.com`[cite: 1]
* **Senha:** `123456`[cite: 1]
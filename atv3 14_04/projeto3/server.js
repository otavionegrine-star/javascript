const express = require('express');
const path = require('path');
const db = require('./db');

const app = express();
const PORT = 3000;

// Configuração para receber JSON no corpo da requisição (req.body)
app.use(express.json());

// Exercício 5: Servir arquivos estáticos da pasta 'public'
app.use(express.static('public'));

// Exercício 3: Middleware Global de Registro (Log)
app.use((req, res, next) => {
    const data = new Date().toISOString();
    console.log(`[${data}] Método: ${req.method} | URL: ${req.url}`);
    next();
});

// Variável para Exercício 2
let tarefas = [];

// --- ROTAS DE TAREFAS (Exercício 2) ---
app.get('/tarefas', (req, res) => {
    res.json(tarefas);
});

app.post('/tarefas', (req, res) => {
    const { nome } = req.body;
    if (!nome) return res.status(400).json({ erro: "Nome da tarefa é obrigatório" });
    
    const novaTarefa = { id: Date.now(), nome };
    tarefas.push(novaTarefa);
    res.status(201).json(novaTarefa);
});

app.delete('/tarefas/:id', (req, res, next) => {
    const { id } = req.params;
    const index = tarefas.findIndex(t => t.id == id);
    
    if (index === -1) {
        const erro = new Error("Tarefa não encontrada para o ID fornecido.");
        erro.status = 404;
        return next(erro); // Exercício 4: Chama o middleware de erro
    }
    
    tarefas.splice(index, 1);
    res.status(204).send();
});

// --- ROTAS DE USUÁRIOS (Exercício 7 - CRUD Completo) ---
app.get('/usuarios', (req, res) => {
    res.json(db.buscarTodos());
});

app.get('/usuarios/:id', (req, res) => {
    const usuario = db.buscarPorId(req.params.id);
    if (!usuario) return res.status(404).json({ erro: "Usuário não encontrado" });
    res.json(usuario);
});

app.post('/usuarios', (req, res) => {
    const { nome } = req.body;
    if (!nome) return res.status(400).json({ erro: "Nome é obrigatório" });
    const novo = db.adicionar(nome);
    res.status(201).json(novo);
});

app.put('/usuarios/:id', (req, res) => {
    const atualizado = db.atualizar(req.params.id, req.body.nome);
    if (!atualizado) return res.status(404).json({ erro: "Usuário não encontrado" });
    res.json(atualizado);
});

app.delete('/usuarios/:id', (req, res) => {
    const sucesso = db.deletar(req.params.id);
    if (!sucesso) return res.status(404).json({ erro: "Não foi possível deletar: ID inexistente" });
    res.status(204).send();
});

// Exercício 5: Rota raiz que serve o index.html
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

// Exercício 1: Rota /hello
app.get('/hello', (req, res) => {
    res.send("Olá, Mundo!");
});

// Exercício 4: Middleware de Tratamento de Erros Centralizado
app.use((err, req, res, next) => {
    console.error(err.stack);
    const status = err.status || 500;
    res.status(status).json({
        status: "erro",
        mensagem: err.message || "Erro interno no servidor"
    });
});

// Inicialização do servidor
app.listen(PORT, () => {
    console.log(`==========================================`);
    console.log(`Servidor rodando na porta ${PORT}`);
    console.log(`Acesse: http://localhost:${PORT}/hello`);
    console.log(`==========================================`);
});
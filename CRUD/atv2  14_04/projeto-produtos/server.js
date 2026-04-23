const express = require('express');
const app = express();
const PORT = 3002;

app.get('/', (req, res) => {
    res.send('API de Produtos Rodando');
});

app.listen(PORT, () => {
    console.log(`[PROJETO 2 - SERVIDOR DE PRODUTOS]`);
    console.log(`Servidor executando na porta ${PORT}`);
});
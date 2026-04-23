const express = require('express');
const app = express();
const PORT = 3001;

app.get('/', (req, res) => {
    res.send('API de Usuários Rodando');
});

app.listen(PORT, () => {
    console.log(`[PROJETO 1 - SERVIDOR DE USUÁRIOS]`);
    console.log(`Servidor executando na porta ${PORT}`);
});
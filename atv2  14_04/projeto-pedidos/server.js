const express = require('express');
const app = express();
const PORT = 3003;

app.get('/', (req, res) => {
    res.send('API de Pedidos Rodando');
});

app.listen(PORT, () => {
    console.log(`[PROJETO 3 - SERVIDOR DE PEDIDOS]`);
    console.log(`Servidor executando na porta ${PORT}`);
});
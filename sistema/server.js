require('dotenv').config();
const express = require('express');
const { Pool } = require('pg');
const path = require('path');

const app = express();
app.use(express.json());
app.use(express.static(path.join(__dirname, 'public')));

// Configuração do Banco de Dados
const pool = new Pool({
  user: process.env.DB_USER || 'postgres',
  host: process.env.DB_HOST || 'localhost',
  database: process.env.DB_DATABASE || 'saep_db',
  password: process.env.DB_PASSWORD || 'postgres',
  port: parseInt(process.env.DB_PORT, 10) || 5432,
});

// Item 4: Autenticação
app.post('/api/login', async (req, res) => {
  const { email, senha } = req.body;
  try {
    const result = await pool.query('SELECT id, nome, email FROM usuarios WHERE email = $1 AND senha = $2', [email, senha]);
    if (result.rows.length === 0) {
      return res.status(401).json({ error: 'Credenciais inválidas! Verifique e-mail e senha.' });
    }
    res.json({ usuario: result.rows[0] });
  } catch (err) {
    res.status(500).json({ error: 'Erro interno no servidor.' });
  }
});

// Item 6: CRUD de Produtos
app.get('/api/produtos', async (req, res) => {
  const { busca } = req.query;
  try {
    let query = 'SELECT * FROM produtos';
    let params = [];
    if (busca) {
      query += ' WHERE nome ILIKE $1 OR categoria ILIKE $1 OR especificacoes ILIKE $1';
      params.push(`%${busca}%`);
    }
    const result = await pool.query(query, params);
    res.json(result.rows);
  } catch (err) {
    res.status(500).json({ error: 'Erro ao buscar produtos.' });
  }
});

app.post('/api/produtos', async (req, res) => {
  const { codigo, nome, categoria, especificacoes, tamanho, peso, quantidade_atual, quantidade_minima } = req.body;
  if (!codigo || !nome || !categoria || quantidade_atual === undefined || quantidade_minima === undefined) {
    return res.status(400).json({ error: 'Preencha todos os campos obrigatórios!' });
  }
  try {
    const result = await pool.query(
      `INSERT INTO produtos (codigo, nome, categoria, especificacoes, tamanho, peso, quantidade_atual, quantidade_minima) 
       VALUES ($1, $2, $3, $4, $5, $6, $7, $8) RETURNING *`,
      [codigo, nome, categoria, especificacoes, tamanho, peso || 0, quantidade_atual, quantidade_minima]
    );
    res.status(201).json(result.rows[0]);
  } catch (err) {
    res.status(500).json({ error: 'Erro ao cadastrar produto.' });
  }
});

app.put('/api/produtos/:id', async (req, res) => {
  const { id } = req.params;
  const { codigo, nome, categoria, especificacoes, tamanho, peso, quantidade_atual, quantidade_minima } = req.body;
  try {
    const result = await pool.query(
      `UPDATE produtos SET codigo=$1, nome=$2, categoria=$3, especificacoes=$4, tamanho=$5, peso=$6, 
       quantidade_atual=$7, quantidade_minima=$8 WHERE id=$9 RETURNING *`,
      [codigo, nome, categoria, especificacoes, tamanho, peso, quantidade_atual, quantidade_minima, id]
    );
    res.json(result.rows[0]);
  } catch (err) {
    res.status(500).json({ error: 'Erro ao atualizar produto.' });
  }
});

app.delete('/api/produtos/:id', async (req, res) => {
  const { id } = req.params;
  try {
    await pool.query('DELETE FROM produtos WHERE id = $1', [id]);
    res.json({ message: 'Produto removido com sucesso.' });
  } catch (err) {
    res.status(500).json({ error: 'Erro ao excluir produto.' });
  }
});

// Item 7: Gestão de Estoque e Movimentação
app.post('/api/movimentacoes', async (req, res) => {
  const { usuario_id, produto_id, tipo, quantidade, data_movimentacao } = req.body;
  const client = await pool.connect();

  try {
    await client.query('BEGIN');

    // Busca produto
    const prodRes = await client.query('SELECT * FROM produtos WHERE id = $1', [produto_id]);
    if (prodRes.rows.length === 0) throw new Error('Produto não encontrado');
    const produto = prodRes.rows[0];

    let novaQtd = produto.quantidade_atual;
    if (tipo === 'ENTRADA') {
      novaQtd += parseInt(quantidade);
    } else if (tipo === 'SAIDA') {
      if (produto.quantidade_atual < quantidade) {
        throw new Error('Estoque insuficiente para realizar esta saída!');
      }
      novaQtd -= parseInt(quantidade);
    }

    // Atualiza estoque do produto
    await client.query('UPDATE produtos SET quantidade_atual = $1 WHERE id = $2', [novaQtd, produto_id]);

    // Registra histórico
    await client.query(
      'INSERT INTO movimentacoes (usuario_id, produto_id, tipo, quantidade, data_movimentacao) VALUES ($1, $2, $3, $4, $5)',
      [usuario_id, produto_id, tipo, quantidade, data_movimentacao]
    );

    await client.query('COMMIT');

    // Item 7.1.4: Verificação de Estoque Mínimo
    let alertaEstoque = false;
    if (tipo === 'SAIDA' && novaQtd < produto.quantidade_minima) {
      alertaEstoque = true;
    }

    res.json({ 
      success: true, 
      novaQuantidade: novaQtd, 
      alertaEstoque, 
      mensagemAlerta: alertaEstoque ? `ALERTA: O estoque do produto "${produto.nome}" está abaixo do mínimo! (Atual: ${novaQtd} | Mínimo: ${produto.quantidade_minima})` : null
    });

  } catch (err) {
    await client.query('ROLLBACK');
    res.status(400).json({ error: err.message || 'Erro ao processar movimentação.' });
  } finally {
    client.release();
  }
});

app.listen(3000, () => console.log('Servidor rodando em http://localhost:3000'));
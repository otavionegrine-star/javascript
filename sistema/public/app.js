/* ============================================================
   APP.JS - LÓGICA DE FRONTEND (ALMOXARIFADO SAEP)
   ============================================================ */

const API_BASE = '/api';
const produtosCache = {};

// ------------------------------------------------------------
// 1. GERENCIAMENTO DE SESSÃO E AUTENTICAÇÃO
// ------------------------------------------------------------

// Obter dados do usuário logado no localStorage
function getUsuarioLogado() {
    const user = localStorage.getItem('usuario');
    return user ? JSON.parse(user) : null;
}

// Validar se o usuário está autenticado nas telas protegidas
function verificarAutenticacao() {
    const usuario = getUsuarioLogado();
    if (!usuario) {
        window.location.href = 'index.html';
    }
    return usuario;
}

// Exibir nome do usuário na tela (Requisito 5.1.1)
function carregarInfoUsuario() {
    const usuario = getUsuarioLogado();
    const elemGreeting = document.getElementById('userGreeting');
    if (elemGreeting && usuario) {
        elemGreeting.innerText = `Olá, ${usuario.nome}`;
    }
}

// Encerrar sessão (Requisito 5.1.2)
function logout() {
    localStorage.removeItem('usuario');
    window.location.href = 'index.html';
}

// Lógica da Tela de Login (Requisito 4)
async function efetuarLogin(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;
    const alertDiv = document.getElementById('alert');

    if (alertDiv) alertDiv.style.display = 'none';

    try {
        const response = await fetch(`${API_BASE}/login`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, senha })
        });

        const data = await response.json();

        if (!response.ok) {
            // Requisito 4.1: Exibe mensagem de erro e permanece na tela
            if (alertDiv) {
                alertDiv.innerText = data.error || 'Falha na autenticação';
                alertDiv.style.display = 'block';
            }
        } else {
            // Salva dados e redireciona para a tela principal
            localStorage.setItem('usuario', JSON.stringify(data.usuario));
            window.location.href = 'dashboard.html';
        }
    } catch (err) {
        if (alertDiv) {
            alertDiv.innerText = 'Erro ao conectar com o servidor.';
            alertDiv.style.display = 'block';
        }
    }
}

// ------------------------------------------------------------
// 2. CADASTRO E BUSCA DE PRODUTOS (Requisito 6)
// ------------------------------------------------------------

// Carregar e listar produtos (Requisito 6.1.1 e 6.1.2)
async function carregarProdutos() {
    const searchInput = document.getElementById('searchTerm');
    const busca = searchInput ? searchInput.value : '';

    try {
        const response = await fetch(`${API_BASE}/produtos?busca=${encodeURIComponent(busca)}`);
        const produtos = await response.json();

        const tbody = document.getElementById('tabelaProdutos');
        if (!tbody) return;

        tbody.innerHTML = '';
        produtos.forEach(p => {
            produtosCache[p.id] = p;
            tbody.innerHTML += `
                <tr>
                    <td>${p.codigo}</td>
                    <td>${p.nome}</td>
                    <td>${p.categoria}</td>
                    <td>${p.especificacoes || '-'}</td>
                    <td>${p.quantidade_atual}</td>
                    <td>${p.quantidade_minima}</td>
                    <td>
                        <button onclick='editarProduto(${p.id})'>Editar</button>
                        <button onclick='deletarProduto(${p.id})' style="color:red;">Excluir</button>
                    </td>
                </tr>
            `;
        });
    } catch (err) {
        console.error('Erro ao carregar produtos:', err);
    }
}

// Salvar ou Atualizar Produto com validação (Requisito 6.1.3, 6.1.4, 6.1.6)
async function salvarProduto(event) {
    event.preventDefault();

    const id = document.getElementById('prodId').value;
    const payload = {
        codigo: document.getElementById('codigo').value.trim(),
        nome: document.getElementById('nome').value.trim(),
        categoria: document.getElementById('categoria').value.trim(),
        especificacoes: document.getElementById('especificacoes').value.trim(),
        tamanho: document.getElementById('tamanho').value.trim(),
        peso: parseFloat(document.getElementById('peso').value) || 0,
        quantidade_atual: parseInt(document.getElementById('quantidade_atual').value),
        quantidade_minima: parseInt(document.getElementById('quantidade_minima').value)
    };

    // Validações básicas de dados (Requisito 6.1.6)
    if (!payload.codigo || !payload.nome || !payload.categoria) {
        alert('Por favor, preencha todos os campos obrigatórios (Código, Nome e Categoria)!');
        return;
    }

    if (isNaN(payload.quantidade_atual) || isNaN(payload.quantidade_minima) || payload.quantidade_atual < 0 || payload.quantidade_minima < 0) {
        alert('As quantidades não podem ser valores negativos ou vazios!');
        return;
    }

    const method = id ? 'PUT' : 'POST';
    const url = id ? `${API_BASE}/produtos/${id}` : `${API_BASE}/produtos`;

    try {
        const res = await fetch(url, {
            method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        if (res.ok) {
            alert('Produto salvo com sucesso!');
            resetarFormularioProduto();
            carregarProdutos();
        } else {
            const data = await res.json();
            alert(`Erro: ${data.error || 'Não foi possível salvar o produto.'}`);
        }
    } catch (err) {
        alert('Erro de conexão ao salvar produto.');
    }
}

// Preencher formulário para Edição (Requisito 6.1.4)
function editarProduto(p) {
    if (typeof p === 'number' || typeof p === 'string') {
        p = produtosCache[p];
    }
    if (!p) return;

    document.getElementById('prodId').value = p.id;
    document.getElementById('codigo').value = p.codigo;
    document.getElementById('nome').value = p.nome;
    document.getElementById('categoria').value = p.categoria;
    document.getElementById('especificacoes').value = p.especificacoes || '';
    document.getElementById('tamanho').value = p.tamanho || '';
    document.getElementById('peso').value = p.peso || '';
    document.getElementById('quantidade_atual').value = p.quantidade_atual;
    document.getElementById('quantidade_minima').value = p.quantidade_minima;

    const titleElem = document.getElementById('formTitle');
    if (titleElem) titleElem.innerText = 'Editar Produto';
}

// Excluir Produto (Requisito 6.1.5)
async function deletarProduto(id) {
    if (confirm('Deseja realmente excluir este produto?')) {
        try {
            const res = await fetch(`${API_BASE}/produtos/${id}`, { method: 'DELETE' });
            if (res.ok) {
                carregarProdutos();
            } else {
                alert('Erro ao excluir produto.');
            }
        } catch (err) {
            alert('Erro ao conectar com o servidor.');
        }
    }
}

// Limpar Formulário de Cadastro
function resetarFormularioProduto() {
    const form = document.getElementById('produtoForm');
    if (form) form.reset();
    document.getElementById('prodId').value = '';
    const titleElem = document.getElementById('formTitle');
    if (titleElem) titleElem.innerText = 'Novo Produto';
}

// Algoritmo de Ordenação QuickSort para ordenar produtos alfabeticamente (Requisito 7.1.1)
function quickSortProdutos(arr) {
    if (arr.length <= 1) return arr;

    const pivot = arr[arr.length - 1];
    const left = [];
    const right = [];

    for (let i = 0; i < arr.length - 1; i++) {
        if (arr[i].nome.localeCompare(pivot.nome, 'pt-BR', { sensitivity: 'base' }) < 0) {
            left.push(arr[i]);
        } else {
            right.push(arr[i]);
        }
    }

    return [...quickSortProdutos(left), pivot, ...quickSortProdutos(right)];
}

// Carregar dados de Estoque com ordenação alfabética
async function carregarGestaoEstoque() {
    try {
        const response = await fetch(`${API_BASE}/produtos`);
        const produtos = await response.json();

        // Aplicando a ordenação via algoritmo customizado QuickSort
        const produtosOrdenados = quickSortProdutos(produtos);

        // Preencher o select de seleção do produto (Requisito 7.1.2)
        const select = document.getElementById('produtoSelect');
        if (select) {
            select.innerHTML = '<option value="">Selecione um produto...</option>';
            produtosOrdenados.forEach(p => {
                select.innerHTML += `<option value="${p.id}">${p.nome} (Estoque atual: ${p.quantidade_atual})</option>`;
            });
        }

        // Preencher a tabela de estoque
        const tbody = document.getElementById('tabelaEstoque');
        if (tbody) {
            tbody.innerHTML = '';
            produtosOrdenados.forEach(p => {
                const abaixoDoMinimo = p.quantidade_atual < p.quantidade_minima;
                tbody.innerHTML += `
                    <tr style="${abaixoDoMinimo ? 'background-color: #ffd1d1;' : ''}">
                        <td>${p.nome}</td>
                        <td>${p.categoria}</td>
                        <td>${p.quantidade_atual}</td>
                        <td>${p.quantidade_minima}</td>
                        <td>${abaixoDoMinimo ? '⚠️ ESTOQUE ABAIXO DO MÍNIMO' : 'OK'}</td>
                    </tr>
                `;
            });
        }
    } catch (err) {
        console.error('Erro ao carregar gestão de estoque:', err);
    }
}

// Registrar Entrada/Saída de Estoque (Requisito 7.1.2, 7.1.3, 7.1.4)
async function registrarMovimentacao(event) {
    event.preventDefault();

    const usuario = getUsuarioLogado();
    const payload = {
        usuario_id: usuario.id,
        produto_id: parseInt(document.getElementById('produtoSelect').value),
        tipo: document.getElementById('tipo').value,
        quantidade: parseInt(document.getElementById('quantidade').value),
        data_movimentacao: document.getElementById('dataMovimentacao').value
    };

    if (!payload.produto_id || !payload.quantidade || !payload.data_movimentacao) {
        alert('Preencha todos os campos da movimentação!');
        return;
    }

    try {
        const res = await fetch(`${API_BASE}/movimentacoes`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });

        const data = await res.json();

        if (!res.ok) {
            alert(data.error || 'Erro ao registrar movimentação.');
        } else {
            // Requisito 7.1.4: Emissão de Alerta Automático em caso de estoque mínimo
            if (data.alertaEstoque) {
                const alertDiv = document.getElementById('alertaEstoque');
                if (alertDiv) {
                    alertDiv.innerText = data.mensagemAlerta;
                    alertDiv.style.display = 'block';
                }
                alert(data.mensagemAlerta); // Exibe alerta pop-up em tela
            } else {
                const alertDiv = document.getElementById('alertaEstoque');
                if (alertDiv) alertDiv.style.display = 'none';
                alert('Movimentação registrada com sucesso!');
            }

            // Recarrega os dados na tela
            carregarGestaoEstoque();
            document.getElementById('movimentacaoForm').reset();
            
            // Re-insere a data atual padrão
            const dataInput = document.getElementById('dataMovimentacao');
            if (dataInput) dataInput.value = new Date().toISOString().slice(0, 16);
        }
    } catch (err) {
        alert('Erro ao conectar com o servidor.');
    }
}
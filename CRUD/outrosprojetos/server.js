//importar o Express
const express = require("express");
//importar o fs para leitura e escrira de arquivos
const fs = require("fs");
//cria uma aplicação Express
const app = express();

//DEFINIR PORTA PARA O SEVIDOR
const PORTA = 3000;
//permite o servidor enterder jsn enviado no body
//sem isso, req.body = underfinrd
app.use(express.json());
//caminhi arquivo
const ARQUIVO = "./contatos.json";

//inicio das finções
function lerDados(){
    const dados = fs.readFileSync(ARQUIVO, "utf-8");
    return JSON.parse(dados);
}

function salvarDados(dados){
    fs.writeFileSync(ARQUIVO, JSON.stringify(dados, null, 2));
}

//ROTA GET para listar os contt
app.get("/contatos/:grupo", (req, res) => {
    const grupo = req.params.grupo;
    const dados = lerDados();

    //verificar se o grupo existe
    if(!dados[grupo]){
        return res.status(404).json({erro: "Grupo não encontrado"});
    }

    res.json(dados[grupo]);

});

//rota post adiciona um contato
app.post("/contatos/:grupo", (req, res) => {
  const grupo = req.params.grupo;
  const { nome, telefone } = req.body;

  const dados = lerDados();
  //Verificar se o grupo existe
  if (!dados[grupo]) {
    return res.status(404).json({ erro: "Grupo não encontrado!. " });
  }

  //Criando obrigatoriedade para nome e telefone
  if (!nome || !telefone) {
    return res.status(400).json({
      erro: "Nome e telefone são obrigatórios",
    });
  }

  //adiciona o contato
  dados[grupo].push({ nome, telefone });
  // Salva no JSON
  salvarDados(dados);

  res.status(201).json({
    mensagem: "Contato adicionado com sucesso",
    contato: { nome, telefone },
  });
});

//rota put - atualiza um contato
app.put("/contatos/:grupo/:nome", (req, res) => {
  const grupo = req.params.grupo;
  const nome = req.params.nome;
  const { telefone } = req.body;

    const dados = lerDados();

    //Verifica se existe o grupo
  if (!dados[grupo]) {
    return res.status(404).json({ erro: "Grupo não encontrado!. " });
  }

  const index = dados[grupo].findIndex(contato => contato.nome === nome);

  if (index < 0 || index >= dados[grupo].length) {
    return res.status(404).json({ erro: "Contato não encontrado" });
  }

  //Atualiza o contato
  dados[grupo][index].telefone = telefone;
  salvarDados(dados);

  res.json({
    mensagem: "Contato atualizado com sucesso",
    contato: dados[grupo][index],
  });
}); 

app.listen(PORTA, () => {
  console.log(`Servidor rodando na porta ${PORTA}`);
});

//Rota DELETE
app.delete("/contatos/:grupo/:index", (req, res) => {
  const grupo = req.params.grupo;
  const index = parseInt(req.params.index);

  const dados = lerDados();
  if (!dados[grupo]) {
    return res.status(404).json({ erro: "Grupo não encontrado!. " });
  }

  if (index < 0 || index >= dados[grupo].length) {
    return res.status(404).json({ erro: "Contato não encontrado" });
  }

  const removido = dados[grupo].splice(index, 1);
  salvarDados(dados);

  res.json({
    mensagem: "Contato excluído com sucesso!",
    contato: removido[0]
  });

});

//iniciar o servidor
app.listen(PORTA, () => {
  console.log(`Servidor rodando na porta http://localhost:${PORTA}`);
});
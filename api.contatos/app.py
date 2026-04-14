#Importa o flask para criar APIs
from flask import Flask, request, jsonify
#Importar json
import json

app = Flask(__name__)

#caminho para o arquivo
ARQUIVO = "contatos.json"

#Ler dados
def ler_dados():
    #Abrir o arquivo contatos.json, ler o conteúdo e converter para um dicionário python
    with open(ARQUIVO, "r", encoding="utf-8") as arquivo:
        return json.load(arquivo)
    
def salvar_dados(dados):
    #Recebe um dicionário Python e grava os arquivos no contatos.json
    with open(ARQUIVO, "w", encoding="utf-8") as arquivo:
        json.dump(
            dados,
            arquivo,
            ensure_ascii=False, #mantém acentos
            indent=2 #identação
        )
#Listas contatos (GET - READ)
@app.route("/contatos/<grupo>", methods=["GET"])
def listar_contatos(grupo):
    dados = ler_dados()
    #Verificar se o grupo existe
    if grupo not in dados:
        return jsonify({"erro": "Grupo não encontrado"}), 404
    return jsonify(dados[grupo])

#Adicionar um contato (POST-Create)
@app.route("/contatos/<grupo>", methods=["POST"])
def adicionar_contatos(grupo):
    dados = ler_dados()
    if grupo not in dados:
        return jsonify({"erro": "Grupo não encontrado"}), 404
    #Obter o JSON do body
    corpo = request.json

    if not corpo or "nome" not in corpo or "telefone" not in corpo:
        return jsonify({"erro": "Campos 'nome' e 'telefone' são obrigatórios"}), 400
    
    novo_contato = {
        "nome": corpo["nome"],
        "telefone": corpo["telefone"]
    }

    #Adiciona novo contato ao grupo
    dados[grupo].append(novo_contato)

    salvar_dados(dados)

    return jsonify({
        "mensagem": "Contato adicionado com sucesso",
        "contato": novo_contato
    }), 201

#Atualiza um contato (PUT-Update)
@app.route("/contatos/<grupo>/<int:index>", methods=["PUT"])
def atualizar_contato(grupo, index):
    dados = ler_dados()

    if grupo not in dados:
        return jsonify({"erro": "Grupo não encontado"}), 404
    
    corpo = request.json

    if not corpo or "nome" not in corpo or "telefone" not in corpo:
        return jsonify({
            "erro": "Campos 'nome' e ' telefone' são obrigatórios"
        }), 400
    
    #atualiza o contato
    dados[grupo][index] = {
        "nome": corpo["nome"],
        "telefone": corpo["telefone"]
    }

    salvar_dados(dados)

    return jsonify({
        "mensagem": "Contato atualizado com sucesso",
        "contato": dados[grupo][index]
    }),

#Deletar um contato (Delete)
@app.route("/contatos/<grupo>/<int:index>", methods=["DELETE"])
def deletar_contato(grupo, index):
    dados = ler_dados()

    if grupo not in dados:
        return jsonify({"erro": "Grupo não encontrado"}), 404
    
    if index < 0 or index >= len(dados[grupo]):
        return jsonify({"erro": "Contato não encontrado"}), 404
    
    contato_removido = dados[grupo].pop(index)

    salvar_dados(dados)

    return jsonify({
        "mensagem": "Contato deletado com sucesso",
        "contato": contato_removido
    }),

#iniciar o servidor
if __name__ == "__main__":
    print("API rodando em http://localhost:3000/contatos/")
    app.run(host="127.0.0.1", port=3000)
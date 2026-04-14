# 📚 API de Gestão Escolar

Esta API fornece uma interface simples para gerir e listar membros da comunidade escolar, divididos entre **Alunos** e **Professores**.

---

## 🚀 Como Visualizar no VS Code
Para ver esta documentação formatada dentro do VS Code:
1. Abra o ficheiro `README.md`.
2. Pressione `Ctrl + Shift + V` (Windows/Linux) ou `Cmd + Shift + V` (Mac).

---

## 📋 Estrutura da Resposta (JSON)

A API retorna um objeto JSON contendo duas coleções principais. Abaixo está a definição técnica de cada campo.

### 1. Objeto `alunos`
Contém a lista de estudantes matriculados.

| Campo | Tipo | Descrição | Exemplo |
| :--- | :--- | :--- | :--- |
| `nome` | String | Nome completo do aluno. | "Maria Silva" |
| `telefone` | String | Contacto telefónico com DDD. | "19982643333" |

### 2. Objeto `professores`
Contém a lista de docentes da instituição.

| Campo | Tipo | Descrição | Exemplo |
| :--- | :--- | :--- | :--- |
| `nome` | String | Nome completo do professor. | "Jorge Carneiro" |
| `telefone` | String | Contacto telefónico. | "199999999" |

---

## 🛠️ Exemplo de Payload

Abaixo está o exemplo do retorno padrão da API:

```json
{
  "alunos": [
    {
      "nome": "Maria Silva",
      "telefone": "19982643333"
    },
    {
      "nome": "Carlos Pereira",
      "telefone": "19982633333"
    }
  ],
  "professores": [
    {
      "nome": "Jorge Carneiro",
      "telefone": "199999999"
    }
  ]
}
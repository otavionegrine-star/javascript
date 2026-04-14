// Importa o módulo 'readline' para permitir a entrada de dados pelo teclado no terminal
const readline = require("readline").createInterface({
  input: process.stdin,
  output: process.stdout,
});

/**
 * Função principal assíncrona para gerenciar a aplicação.
 * Usamos 'async' para poder esperar a resposta da API com 'await'.
 */
async function iniciarApp() {
  // URL da API pública de Harry Potter
  const url = "https://hp-api.onrender.com/api/characters";

  try {
    console.log("Conectando ao mundo bruxo... Aguarde.");

    // Faz a requisição para a API
    const resposta = await fetch(url);
    // Converte a resposta bruta em um objeto JSON (lista de personagens)
    const personagens = await resposta.json();

    /**
     * Função que solicita o nome do personagem ao usuário
     */
    const realizarBusca = () => {
      console.log("\n-----------------🌟🌟------------------------");
      readline.question(
        "Digite o nome do personagem para buscar: ",
        (nomeBusca) => {
          // Converte a busca para minúsculo para facilitar a comparação
          const termo = nomeBusca.toLowerCase();

          // Filtra a lista de personagens procurando pelo nome digitado
          const resultados = personagens.filter((p) =>
            p.name.toLowerCase().includes(termo),
          );

          // Verifica se encontrou algum resultado
          if (resultados.length > 0) {
            console.log(`\nEncontramos ${resultados.length} personagem(ns):`);
            resultados.forEach((p) => {
              // Exibe o nome e a casa (ou 'N/A' se estiver vazio)
              console.log(`- ${p.name} | Casa: ${p.house || "Não informada"}`);
            });
          } else {
            console.log("\nNenhum personagem encontrado com esse nome 🧌🧌.");
          }

          // Após mostrar os resultados, chama a pergunta de saída
          perguntarSair();
        },
      );
    };

    /**
     * Função que pergunta se o usuário deseja continuar ou fechar o programa
     */
    const perguntarSair = () => {
      console.log("\n-----------------🌟🌟------------------------");
      readline.question(
        "Deseja fazer outra busca? (S para sim / SAIR para encerrar): ",
        (escolha) => {
          // Se o usuário digitar 'sair' (independente de maiúsculas/minúsculas)
          if (escolha.toLowerCase() === "sair") {
            console.log("Encerrando o programa... Até logo!");
            readline.close(); // Fecha a interface do terminal
          } else {
            // Se digitar qualquer outra coisa (como 's'), volta para a busca
            realizarBusca();
          }
        },
      );
    };

    // Inicia a primeira busca assim que os dados são carregados
    realizarBusca();
  } catch (erro) {
    // Caso ocorra algum erro de rede ou na API
    console.error("Erro ao carregar dados da API:", erro.message);
    readline.close();
  }
}

// Executa a aplicação
iniciarApp();

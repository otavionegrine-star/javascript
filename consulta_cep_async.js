//Importa o prompt-sync para receber input do usuário
const prompt = require("prompt-sync")();

//Menu principal
async function consultaCEP() {
    /*
    1. Solicita o CEP
    2. Monta URL
    3. Faz a requisição HTTP (GET)
    4. Retorna a resposta
    */

    //recebe o cep do usuário
    let cep = prompt("Digite o CEP (somente numeros): ");
    //retira os espaços do input
    cep = cep.trim();

    const url = `https://viacep.com.br/ws/${cep}/json`;

    try {
        const resposta = await fetch(url);
        const dados = await resposta.json();

        if(dados.erro) {
            console.log("CEP não encontrado");
            return;
        }

        //Exibe os dados do CEP
        console.log("Dados do CEP: ")
        console.log("CEP: ", dados.cep);
        console.log("Logradouro: ", dados.logradouro);
        console.log("Bairro: ", dados.bairro);
        console.log("Cidade: ", dados.localidade);
        console.log("UF: ", dados.uf);
    } catch (erro) {
        console.log("Erro ao acessar a API");
        console.log(erro.message);
    };

consultaCEP();
}

const prompt = require('prompt-sync')();

function consultaCEP() {
    let cep = prompt('Digite o CEP (somente numero): ');
    cep = cep.trim();

    const url = `https://viacep.com.br/ws/${cep}/json/`;

    fetch(url)  
        .then(response => {
        return response.json();
    })
        .then(dados => {
        if (dados.erro) {
            console.log('CEP não encontrado.');
            return;
        }
        console.log("dados do CEP: ");
        console.log(`CEP: ${dados.cep}`);
        console.log(`Logradouro: ${dados.logradouro}`);
        console.log(`Bairro: ${dados.bairro}`);
        console.log(`Cidade: ${dados.localidade}`);
        console.log(`Estado: ${dados.uf}`);
    })
        .catch(error => {
        console.log('Erro ao consultar o CEP:');
        console.log(error.message);
    });
}
consultaCEP();
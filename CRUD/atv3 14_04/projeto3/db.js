// Exercício 6: Simulação de Banco de Dados
let usuarios = [
    { id: 1, nome: "Ana Silva" },
    { id: 2, nome: "Bruno Costa" }
];

const db = {
    buscarTodos: () => usuarios,
    buscarPorId: (id) => usuarios.find(u => u.id === parseInt(id)),
    adicionar: (nome) => {
        const novoUsuario = { id: usuarios.length + 1, nome };
        usuarios.push(novoUsuario);
        return novoUsuario;
    },
    atualizar: (id, nome) => {
        const index = usuarios.findIndex(u => u.id === parseInt(id));
        if (index !== -1) {
            usuarios[index].nome = nome;
            return usuarios[index];
        }
        return null;
    },
    deletar: (id) => {
        const inicialLen = usuarios.length;
        usuarios = usuarios.filter(u => u.id !== parseInt(id));
        return usuarios.length < inicialLen;
    }
};

module.exports = db;
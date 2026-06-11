# Enchanted - Sistema de Reserva de Personagens Mágicos

O **Enchanted** é um sistema web desenvolvido em PHP para a gestão e reserva de personagens temáticos (como heróis, princesas e figuras de desenhos animados) para festas e eventos. 

O projeto conta com uma identidade visual imersiva e mágica através de um design estilizado e efeitos interativos.

---

## Como Funciona o Sistema

O ecossistema é dividido em dois papéis fundamentais de acesso:

### 1. Visão do Cliente 

 **Autenticação:** O cliente pode criar uma conta (`registro.php`) e fazer login (`index.php`) no reino.

 **Vitrine Mágica (`vitrine.php`):** Uma tela centralizada onde o cliente visualiza todos os personagens disponíveis no sistema. É possível fazer buscas dinâmicas em tempo real por nome e filtrar por categorias mágicas específicas.

 **Agendamento de Contos de Fada (`reservar.php`):** O cliente escolhe seu personagem favorito e preenche um pergaminho digital (formulário) contendo a data, o horário de início/término e o endereço completo da celebração (cidade, bairro, rua e número limitado a 4 dígitos).

 **Desejo Concedido (`sucesso.php`):** Ao concluir um agendamento, o cliente é direcionado para uma página de sucesso comemorativa equipada com um efeito mágico de chuva de confetes coloridos e o resumo da sua reserva real.

###  Visão do Funcionário 

 **Controle de Acesso:** Áreas administrativas são estritamente bloqueadas para clientes comuns, garantindo a integridade dos dados.

 **Cadastro de Personagens (`cadastrar.php`):** Permite a inclusão de novas entidades informando o nome, categoria, descrição das atividades e o upload físico de uma foto mágica.

 **Painel de Reservas (`reservas.php`):** Uma central onde a equipe administrativa consegue visualizar todas as reservas solicitadas no reino, os dados de contato do cliente (nome e e-mail) e tem o poder de cancelar agendamentos se necessário.

---

## Tecnologias Utilizadas

 **Backend:** PHP (Gerenciamento de sessões, upload de arquivos e arquitetura procedural)
 **Banco de Dados:** PostgreSQL / MySQL (utilizando a camada de abordagem segura `PDO`)
 **Frontend:** HTML5, CSS3 personalizado (Variáveis nativas, animações e fontes estilizadas)
 **Interações:** JavaScript (Filtros assíncronos na vitrine e biblioteca `canvas-confetti` via CDN na tela de sucesso)

---

## Estrutura de Arquivos

 `index.php` - Tela de login unificada com seleção de papel (Cliente/Funcionário).
 `registro.php` - Criação de novas contas para usuários do sistema.
 `logout.php` - Encerramento seguro da sessão atual.
 `vitrine.php` - O coração do sistema, catálogo interativo de personagens.
 `reservar.php` - Formulário detalhado para agendamento de eventos por parte do cliente.
 `sucesso.php` - Tela de confirmação estilizada com animação de confetes.
 `cadastrar.php` - Painel do funcionário para upload e registro de novas atrações.
 `reservas.php` - Painel de controle e listagem de agendamentos para a administração.
 `setup.php` - Script utilitário automático para rodar migrações estruturais.
 `migration.sql` - Arquivo de comandos SQL para atualização ou criação das tabelas do banco de dados.
 `css/style.css` - Folha de estilos unificada contendo a identidade visual mágica do projeto.
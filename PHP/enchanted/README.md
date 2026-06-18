# Enchanted - Sistema de Reserva de Personagens Mágicos

O **Enchanted** é um sistema web desenvolvido em PHP para a gestão e reserva de personagens temáticos (como heróis, princesas e personagem de desenhos) para festas e eventos. 

---

# Executar projeto

### 1. Clonagem do repositório
```bash
**git clone** <https://github.com/otavionegrine-star/javascript/tree/main/PHP/enchanted>
```
### 2. Iniciar o php
```bash
php -S 0.0.0.0:7654
```

### 3. Para acessar
```bash
http://localhost:7654/
```
---
# Restaurando o Banco

Para importar o banco através do arquivo de backup:

```bash
psql -U postgres -d enchanted -f backup.sql
```



## Como Funciona o Sistema

O sistema é dividido em dois papéis fundamentais de acesso:

### 1. Visão do Cliente 

 **Autenticação:** O cliente pode criar uma conta (`registro.php`) e fazer login (`index.php`) na página.

 **Vitrine Mágica (`vitrine.php`):** Uma tela centralizada onde o cliente visualiza todos os personagens disponíveis no sistema. É possível fazer buscas dinâmicas em tempo real por nome e filtrar por categorias mágicas específicas.

 **Agendamento de Contos de Fada (`reservar.php`):** O cliente escolhe seu personagem favorito e preenche um pergaminho digital (formulário) contendo a data, o horário de início/término e o endereço completo da festa ou evento (cidade, bairro, rua e número limitado a 4 dígitos).

 **Desejo Concedido (`sucesso.php`):** Ao concluir um agendamento, o cliente é direcionado para uma página de sucesso comemorativa equipada com um efeito mágico de chuva de confetes coloridos e o resumo da sua reserva.

 **Minhas reservas (`minhas_reservas.php`):** Ná página inicial o cliente pode ver suas reservas

###  Visão do Funcionário 

 **Controle de Acesso:** Áreas administrativas são estritamente bloqueadas para clientes comuns, garantindo a integridade dos dados.

 **Cadastro de Personagens (`cadastrar.php`):** Permite a inclusão de novas entidades informando o nome, categoria, descrição das atividades e o upload físico de uma foto mágica.

 **Painel de Reservas (`reservas.php`):** Uma central onde a equipe administrativa consegue visualizar todas as reservas solicitadas no reino, os dados de contato do cliente (nome e e-mail) e tem o poder de cancelar agendamentos se necessário.

**Editar (`editar.php`):** Um botão que te lev á página paraeditar o persomagem já adicionado
---

## Tecnologias Utilizadas

 **Backend:** PHP (Gerenciamento de sessões, upload de arquivos e arquitetura procedural)
 **Banco de Dados:** PostgreSQL (utilizando a camada de abordagem segura `PDO`)
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

 `minhas_reservas` - Tela para o cliente ver suas próprias reservas.

 `cadastrar.php` - Painel do funcionário para upload e registro de novos personagens.

 `editar.php` - Edita personagens já cadastrado

 `reservas.php` - Painel de controle e listagem de agendamentos para a administração.

 `setup.php` - Script utilitário automático para rodar migrações estruturais.

 `beckup.sql` - Arquivo de comandos SQL para atualização ou criação das tabelas do banco de dados.

 `css/style.css` - Folha de estilos unificada contendo a identidade visual mágica do projeto.

---


 ## Como entrar
  **Cliente:** crie uma conta caso não tenha uma, após isso você já sera encaminhado direto para a página `vitrine.php`.

 **Funcionário:**

  **e-mail:** `bia@gmail`

  **senha:** `123456`

 Esse funcionário está cadastrado direto no banco de dados para uma maior segurança.
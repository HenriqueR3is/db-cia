# 📋 Sistema de Apontamento de Produção - Backend PHP

Este projeto é um sistema de backend em PHP com banco de dados MySQL, desenvolvido para centralizar e automatizar o processo de apontamento de produção no campo.

> Projeto em transição: anteriormente desenvolvido em Python/Flask, agora migrado para PHP + MySQL, com foco em performance, escalabilidade e melhores práticas.

---

## 📁 Estrutura de Pastas
/app
├── /config # Arquivo de conexão com o banco de dados
├── /controllers # Lógica de controle (CRUD, autenticação, etc)
├── /models # Funções de acesso e manipulação do banco
├── /views # Telas do sistema (login, dashboard, admin, etc)

/public
├── /css # Estilos personalizados
├── /js # Scripts JS se necessário
├── index.php # Arquivo inicial do sistema

/routes
├── web.php # Arquivo com rotas do sistema (emulação de rotas estilo Laravel)

README.md # Este arquivo
.env.example # Exemplo de configuração do ambiente

---

## ⚙️ Funcionalidades

- Login e logout com sessão PHP
- Painel de administração para cadastro de:
  - Usuários (Admin, Coordenador, Operador)
  - Frentes de trabalho
  - Equipamentos
  - Implementos
- Apontamento de produção diário
- Controle de permissões por tipo de usuário
- Organização em MVC simples com PHP puro

---

## 🚀 Como Rodar Localmente

### 1. Pré-requisitos

- PHP 8.x+
- MySQL 5.7+ ou superior
- [XAMPP](https://www.apachefriends.org/) ou similar
- Composer (opcional, se quiser evoluir para Laravel)

### 2. Clone o projeto

```bash
git clone https://github.com/seu-usuario/db-cia.git
cd db-cia

3. Configure o banco de dados

Importe o arquivo database.sql (ou o script de criação de tabelas)
Atualize os dados de conexão no arquivo:
/app/config/db.php

Exemplo:
$host = 'localhost';
$dbname = 'nome_do_banco';
$user = 'root';
$pass = '';

4. Suba o servidor
Se estiver usando XAMPP, coloque o projeto em:
C:\xampp\htdocs\db-cia

E acesse no navegador:
http://localhost/db-cia/public/index.php

🔐 Tipos de Usuário
Tipo	Permissões
admin	Acesso total (CRUD completo)
coordenador	Cadastro de produção e equipamentos
operador	Apenas preenchimento de produção

🛠️ Em breve...
API RESTful
Dashboard com gráficos
Versão mobile/responsiva
Migração para Laravel

🤝 Contribuição
Este projeto é de uso interno, mas caso tenha sugestões ou melhorias, sinta-se à vontade para abrir uma issue ou pull request!

🧑‍💻 Desenvolvido por
Henrique Hiroshi Koshiba Reis && Bruno Carmo Pereira
Projeto interno do CIA - UST 🚜🌱
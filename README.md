# 🚜 Sistema de Apontamento de Produção - Backend em PHP + MySQL

[![Status](https://img.shields.io/badge/status-em%20desenvolvimento-yellow)](https://github.com/seu-usuario/db-cia)
[![Feito com PHP](https://img.shields.io/badge/PHP-8.x-blue?logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-blue?logo=mysql)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/license-MIT-green)](./LICENSE)

> 🎯 Projeto interno do CIA - UST para modernizar o processo de **apontamento de produção em campo**.  
> Projeto em transição: anteriormente desenvolvido em Python/Flask, agora migrado para PHP + MySQL, com foco em performance, escalabilidade e melhores práticas.

---

## 🗂️ Organização de Pastas

/app
├── /config # Conexão com o banco de dados
├── /controllers # Lógica (CRUD, login, validações)
├── /models # Funções que interagem com o banco
├── /views # Telas (Login, Admin, Produção)

/public
├── /css # Estilos personalizados
├── /js # Scripts JS (se houver)
├── index.php # Ponto de entrada do sistema

/routes
├── web.php # Simulação de rotas tipo Laravel

.env.example # Exemplo de configuração
README.md # Este arquivo


---

## ⚙️ Funcionalidades

✔️ Login e logout com controle de sessão PHP
✔️ Painel de administração para cadastro de:
  - Usuários (Admin, Coordenador, Operador)
  - Frentes de trabalho
  - Equipamentos
  - Implementos
✔️ Registro de produção diária  
✔️ Controle de permissões por nível de usuário  
✔️ Estrutura tipo MVC (sem framework)

---

## 🧪 Como Rodar Localmente

### 1. Pré-requisitos

- ✅ PHP 8.x ou superior  
- ✅ MySQL 5.7+  
- ✅ XAMPP, WAMP ou similar  
- (🔄 Opcional) Composer se quiser futuramente usar Laravel

### 2. Clonando o projeto

```bash
git clone https://github.com/seu-usuario/db-cia.git
cd db-cia

3. Configurando o banco de dados
Importe o arquivo .sql com a estrutura do banco

Edite o arquivo:

/app/config/db.php

Exemplo:
$host = 'localhost';
$dbname = 'sua_base';
$user = 'root';
$pass = '';

4. Iniciando com XAMPP

Coloque a pasta do projeto dentro de htdocs:
C:\xampp\htdocs\db-cia

Abra o navegador e acesse:
http://localhost/db-cia/public/index.php

| Tipo          | Acesso                                     |
| ------------- | ------------------------------------------ |
| `admin`       | Acesso total (CRUD + controle de usuários) |
| `coordenador` | Registro de produção, equipamentos etc     |
| `operador`    | Apenas preenchimento de produção           |

📌 Próximos Passos
 Autenticação com tokens (JWT ou sessões mais seguras)
 Dashboard com relatórios e gráficos
 API RESTful para integração com frontend
 Migração para Laravel com Blade ou Inertia.js
 Responsividade para celular

🤝 Contribuindo
Este é um projeto interno. Mas se tiver sugestões ou quiser contribuir com melhorias, sinta-se à vontade para abrir uma Issue ou Pull Request.

👨‍💻 Desenvolvedores
Henrique Hiroshi Koshiba Reis && Bruno Carmo Pereira
Projeto interno do CIA - UST 🚜🌱

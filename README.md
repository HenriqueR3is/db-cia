FROM php:8.2-apache

# Copia os arquivos do projeto para o container
COPY . /var/www/html/

# Habilita mod_rewrite (caso use URL amigável)
RUN a2enmod rewrite

# Dá permissão aos arquivos
RUN chown -R www-data:www-data /var/www/html

# Define a porta que será exposta
EXPOSE 80
/db-cia
│
├── conexao/ # Conexão com banco de dados
│ └── db.php
├── dashboard.php # Página principal após login
├── login.php # Tela de login
├── register.php # Tela de cadastro de usuários
├── logout.php # Encerramento de sessão
├── usuarios/ # CRUD de usuários
│
├── Dockerfile # Para deploy via Docker no Railway
├── .gitignore
└── README.md

---

## 🧪 Funcionalidades

- Login de usuários com hash seguro (`password_hash`)
- Cadastro de novos usuários (admin)
- Registro de produção com validação
- Tabelas relacionadas:
  - `usuarios`
  - `unidades`, `frentes`, `equipamentos`, `implementos`
  - `usuario_unidade`, `usuario_operacao`

---

## 🚀 Deploy

### 💻 Backend (PHP + MySQL)

O backend está preparado para deploy via **Docker** no Railway:

```bash
# Build local (opcional)
docker build -t db-cia .

# Rodar localmente
docker run -p 8080:80 db-cia

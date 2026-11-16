# 📦 Sistema de Gerenciamento de Produtos com Auditoria

Sistema Web completo para cadastro, consulta, alteração e exclusão de produtos (CRUD) desenvolvido em **PHP** utilizando **PDO** e **MySQL**, com interface moderna em **Bootstrap 5.3** e rastreamento automático de alterações via **Trigger**.

---

## 🌟 Principais Funcionalidades

* **Cadastro de Produtos**: Registro com validações de Nome, Descrição, Preço unitário e Quantidade em estoque.
* **Consulta e Listagem**: Tabela responsiva com busca por nome, formatação de moeda (R$) e indicadores visuais de nível de estoque.
* **Edição de Dados**: Formulário pré-carregado para alteração de informações cadastrais.
* **Exclusão Segura**: Remoção de itens com diálogo de confirmação em JavaScript.
* **Auditoria Automática por Trigger**: Monitoramento automático no MySQL (`trg_produto_update`) que detecta quais campos foram modificados e registra o valor anterior e o novo valor na tabela de histórico.
* **Painel de Histórico**: Interface dedicada para visualização em tempo real das alterações gravadas pela trigger.

---

## 🏗️ Arquitetura do Sistema

O projeto adota o padrão **MVC (Model-View-Controller)** com **Front Controller** para simplificar a navegação e a separação de responsabilidades:

```text
php-store/
│
├── config/
│   └── database.php           # Conexão PDO segura com o MySQL (UTF-8, prepared statements)
│
├── model/
│   └── product.php            # Regras de persistência e operações de CRUD no banco de dados
│
├── controller/
│   └── productController.php  # Controle do fluxo, validação de requisições e redirecionamentos
│
├── view/
│   ├── layout/
│   │   ├── header.php         # Barra de navegação e inclusão do Bootstrap 5.3
│   │   └── footer.php         # Rodapé e scripts do Bootstrap
│   ├── home.php               # Dashboard inicial do sistema
│   ├── listProducts.php       # Listagem com pesquisa e ações
│   ├── addNewProduct.php      # Formulário de criação de produto
│   ├── editProduct.php        # Formulário de edição de produto
│   └── history.php            # Visualização do log da Trigger de auditoria
│
├── index.php                  # Ponto único de entrada e roteador da aplicação
├── schema.sql                 # Script SQL de criação do banco, tabelas e Trigger
└── README.md                  # Documentação do projeto
```

---

## 🛠️ Tecnologias Utilizadas

* **Linguagem**: PHP 8.x
* **Driver de Banco**: PDO (*PHP Data Objects*) com *Prepared Statements*
* **Banco de Dados**: MySQL 5.7+ / 8.x ou MariaDB 10.3+
* **Frontend**: HTML5, CSS3, [Bootstrap 5.3](https://getbootstrap.com/) e [Bootstrap Icons](https://icons.getbootstrap.com/)

---

## ⚡ Como Funciona a Trigger de Auditoria

A trigger `trg_produto_update` é acionada automaticamente **após cada atualização (`AFTER UPDATE`)** na tabela `produtos`:

1. Compara campo a campo os valores antigos (`OLD`) com os novos (`NEW`).
2. Utiliza comparação segura contra nulos para evitar falhas em campos opcionais.
3. Insere uma nova linha na tabela `historico_alteracoes` **somente para os campos que de fato sofreram alteração**, guardando:
   * ID do produto relacionado.
   * Data e hora da modificação (`NOW()`).
   * Nome do campo alterado.
   * Valor antigo e valor novo.

---

## 🚀 Como Executar o Projeto

### 1. Clonar ou Baixar o Repositório
Abra a pasta do projeto no seu terminal:
```bash
cd c:\Users\Admin\development\php-store
```

### 2. Configurar o Banco de Dados
Importe o arquivo [`schema.sql`](file:///c:/Users/Admin/development/php-store/schema.sql) no seu servidor MySQL (via phpMyAdmin, MySQL Workbench ou linha de comando):
```bash
mysql -u root -p < schema.sql
```

### 3. Ajustar as Credenciais (se necessário)
Caso seu ambiente utilize senha ou nome de banco diferente, edite o arquivo [`config/database.php`](file:///c:/Users/Admin/development/php-store/config/database.php):
```php
$server   = 'localhost';
$user     = 'root';
$password = '';
$db       = 'estoque_db'; // ou o nome configurado no seu MySQL
```

### 4. Iniciar o Servidor Embutido do PHP
Execute na raiz do projeto:
```bash
php -S localhost:8000
```

### 5. Acessar a Aplicação
Abra no navegador:
```text
http://localhost:8000
```

---

## 🔒 Segurança

* **Prevenção de SQL Injection**: Todas as operações de leitura, escrita e exclusão utilizam parâmetros vinculados (*Prepared Statements*).
* **Prevenção de XSS**: Todas as informações exibidas nas views passam por tratamento com `htmlspecialchars`.
* **Integridade Referencial**: Chave estrangeira (`FOREIGN KEY`) com `ON DELETE CASCADE` entre `produtos` e `historico_alteracoes`.

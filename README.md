# 🗺️ Roadmap de Desenvolvimento: CRUD de Produtos em PHP (PDO + MVC)

Roadmap do sistema de gerenciamento de produtos com rastreamento automático de auditoria via Trigger no MySQL.

---

## 🧭 Visão Geral do Projeto

* **Arquitetura**: MVC simplificado (Model-View-Controller) com roteamento via Front Controller.
* **Tecnologias**: PHP 8.x + PDO, MySQL, HTML5 / CSS3 (Bootstrap 5.3 + Bootstrap Icons).
* **Banco de Dados**: Configurado no arquivo [`schema.sql`](file:///c:/Users/Admin/development/php-store/schema.sql) (tabelas `produtos`, `historico_alteracoes` e trigger `trg_produto_update`).
* **Status do Projeto**: 🚀 **Desenvolvimento Concluído (Fases 1 a 5 finalizadas; Pronto para Testes/Validação)**

---

## 📁 Estrutura de Pastas e Arquivos

O projeto está estruturado no padrão MVC da seguinte forma:

```text
php-store/
│
├── config/
│   └── database.php           # Configuração da conexão PDO com o MySQL
│
├── model/
│   └── product.php            # Funções de persistência no banco (Prepared Statements e CRUD)
│
├── controller/
│   └── productController.php  # Lógica de controle, validações e alertas via JavaScript
│
├── view/
│   ├── layout/
│   │   ├── header.php         # Cabeçalho global, Bootstrap 5.3 e Navbar
│   │   └── footer.php         # Rodapé global e scripts JS do Bootstrap
│   ├── home.php               # Dashboard / Apresentação inicial
│   ├── listProducts.php       # Tabela de listagem com busca e botões Editar e Excluir
│   ├── addNewProduct.php      # Formulário de cadastro de novo produto
│   ├── editProduct.php        # Formulário preenchido para edição
│   └── history.php            # Tela de visualização do log gravado pela Trigger
│
├── index.php                  # Front Controller (ponto de entrada e roteamento)
├── schema.sql                 # DDL do banco, tabelas e trigger
└── README.md                  # Roadmap e documentação do projeto
```

---

## 📍 Progresso do Roadmap

```
  [x] Fase 1: Conexão PDO (config)
           │
           ▼
  [x] Fase 2: Modelo de Dados (model)
           │
           ▼
  [x] Fase 3: Roteamento (index.php)
           │
           ▼
  [x] Fase 4: Controlador (controller)
           │
           ▼
  [x] Fase 5: Interface do Usuário (view)
           │
           ▼
  [ ] Fase 6: Testes & Validação da Trigger
```

---

### ✅ Fase 1: Configuração da Conexão PDO
**Arquivo**: [`config/database.php`](file:///c:/Users/Admin/development/php-store/config/database.php)

* [x] DSN configurado com `charset=utf8mb4`.
* [x] Atributos do PDO definidos:
  * [x] `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION`.
  * [x] `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC`.
  * [x] `PDO::ATTR_EMULATE_PREPARES => false`.
* [x] Conexão PDO instanciada na variável `$connection`.
* [x] Tratamento de exceções com `try/catch` para `PDOException`.

---

### ✅ Fase 2: Camada de Dados (Model)
**Arquivo**: [`model/product.php`](file:///c:/Users/Admin/development/php-store/model/product.php)

* [x] Tabela e campos padronizados (`produtos`: `nome`, `descricao`, `preco`, `quantidade`).
* [x] Funções implementadas com *Prepared Statements* seguros:
  * [x] `create_product($nome, $descricao, $preco, $quantidade)`: Insere produto via `INSERT INTO produtos (...)`.
  * [x] `find_all_products($termo = '')`: Consulta produtos ordenados por ID decrescente com suporte a busca `LIKE :termo`.
  * [x] `find_product_by_id($id)`: Retorna os dados de um produto pelo ID via `fetch()`.
  * [x] `update_product($id, $nome, $descricao, $preco, $quantidade)`: Atualiza produto (aciona a Trigger de auditoria no MySQL).
  * [x] `delete_product($id)`: Remove produto via `DELETE FROM produtos WHERE id = :id`.
  * [x] `get_product_history($id = null)`: Consulta o log da tabela `historico_alteracoes` com JOIN em `produtos`.

---

### ✅ Fase 3: Roteamento Principal (Front Controller)
**Arquivo**: [`index.php`](file:///c:/Users/Admin/development/php-store/index.php)

* [x] `index.php` configurado como ponto único de entrada da aplicação.
* [x] Captura da ação solicitada via parâmetro `action` (`GET`) e validação de `id`:
  * [x] `action=home` (padrão): Carrega `controller_home()`.
  * [x] `action=list`: Carrega `controller_find_all()`.
  * [x] `action=create`: Carrega `controller_create()`.
  * [x] `action=edit`: Carrega `controller_edit($id)`.
  * [x] `action=delete`: Carrega `controller_delete($id)`.
  * [x] `action=history`: Carrega `controller_history($id)`.

---

### ✅ Fase 4: Lógica de Controle (Controller)
**Arquivo**: [`controller/productController.php`](file:///c:/Users/Admin/development/php-store/controller/productController.php)

* [x] Importação do Model correto ([`model/product.php`](file:///c:/Users/Admin/development/php-store/model/product.php)).
* [x] Ações implementadas sem acoplamento a sessões:
  * [x] `controller_home()`: Renderiza a página inicial/dashboard.
  * [x] `controller_find_all()`: Recebe filtro de busca e renderiza `listProducts.php`.
  * [x] `controller_create()`: Valida submissão via `POST`, chama `create_product()` e redireciona via JavaScript.
  * [x] `controller_edit($id)`: Busca os dados atuais do produto via `find_product_by_id($id)`, processa alteração `POST` e redireciona.
  * [x] `controller_delete($id)`: Executa `delete_product($id)` e redireciona para a listagem.
  * [x] `controller_history($id)`: Consulta o histórico da Trigger e renderiza `history.php`.

---

### ✅ Fase 5: Interface do Usuário (Views com Bootstrap 5.3)
**Diretório**: `view/`

* [x] **`view/layout/header.php` & `footer.php`**: Cabeçalho com navbar responsiva, Bootstrap 5.3 CDN, Bootstrap Icons e rodapé padronizado.
* [x] **`view/home.php`**: Dashboard inicial com cartões de acesso rápido e destaques sobre a Trigger.
* [x] **`view/listProducts.php`**:
  * [x] Tabela de listagem com ID, Nome, Descrição, Preço formatado em R$ e estoque com badges dinâmicos.
  * [x] Campo de pesquisa por nome do produto.
  * [x] Botões de ação com ícones (Editar e Excluir com `confirm(...)`).
* [x] **`view/addNewProduct.php`**: Formulário de cadastro com validações HTML5 para Nome, Descrição, Preço e Estoque.
* [x] **`view/editProduct.php`**: Formulário pré-preenchido com dados existentes, ID oculto e aviso informativo sobre a Trigger.
* [x] **`view/history.php`**: Tabela de auditoria exibindo data/hora, produto, campo modificado, valor anterior e valor novo gerados pela Trigger.

---

### ⏳ Fase 6: Testes e Validação da Trigger

Roteiro para validação final do sistema:

* [ ] **1. Importação do Banco de Dados**:
  * Executar o script [`schema.sql`](file:///c:/Users/Admin/development/php-store/schema.sql) no MySQL para criar o banco `estoque_db` (ou ajustar o nome do banco em [`config/database.php`](file:///c:/Users/Admin/development/php-store/config/database.php)).
* [ ] **2. Iniciar Servidor Local**:
  ```bash
  php -S localhost:8000
  ```
* [ ] **3. Teste de Inserção (Create)**:
  * Acessar `http://localhost:8000/index.php?action=create` e cadastrar um produto (ex: Nome: `Mouse Gamer`, Preço: `150.00`, Quantidade: `20`).
  * Verificar se o produto aparece na listagem (`index.php?action=list`).
* [ ] **4. Teste de Alteração e Disparo da Trigger (Update)**:
  * Clicar em "Editar" no produto cadastrado.
  * Alterar o Preço para `130.00` e a Quantidade para `18` (mantendo nome e descrição inalterados).
  * Salvar e acessar `index.php?action=history`.
  * **Verificação**: Confirmar se foram gerados **exatamente dois registros** no histórico (um para `preco` e um para `quantidade`).
* [ ] **5. Teste de Exclusão (Delete)**:
  * Clicar em "Excluir" em um produto e confirmar a exclusão.

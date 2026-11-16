# 🗺️ Roadmap de Desenvolvimento: CRUD de Produtos em PHP (PDO + MVC)

Roadmap prático para guiar a continuidade do desenvolvimento do sistema de gerenciamento de produtos com rastreamento automático de auditoria via Trigger no MySQL.

---

## 🧭 Visão Geral do Projeto

* **Arquitetura**: MVC simplificado (Model-View-Controller) com roteamento via Front Controller.
* **Tecnologias**: PHP 8.x + PDO, MySQL, HTML5 / CSS3 (Bootstrap 5).
* **Banco de Dados**: Configurado no arquivo [`schema.sql`](file:///c:/Users/Admin/development/php-store/schema.sql) (tabelas `produtos`, `historico_alteracoes` e trigger `trg_produto_update`).

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
│   └── product.php            # Funções de persistência no banco (Prepared Statements)
│
├── controller/
│   └── productController.php  # Lógica de controle, validações e redirecionamentos
│
├── view/
│   ├── home.php               # Dashboard / Apresentação inicial
│   ├── listProducts.php       # Tabela de listagem com botões Editar e Excluir
│   ├── addNewProduct.php      # Formulário de cadastro de novo produto
│   ├── editProduct.php        # Formulário preenchido para edição
│   └── history.php            # Tela de visualização do log gravado pela Trigger
│
├── index.php                  # Front Controller (ponto de entrada e roteamento)
├── schema.sql                 # DDL do banco, tabelas e trigger
└── README.md                  # Roadmap e documentação do projeto
```

---

## 📍 Fases do Roadmap

```
  Fase 1: Conexão (config) 
           │
           ▼
  Fase 2: Modelo de Dados (model)
           │
           ▼
  Fase 3: Roteamento (index.php)
           │
           ▼
  Fase 4: Controlador (controller)
           │
           ▼
  Fase 5: Interface do Usuário (view)
           │
           ▼
  Fase 6: Testes & Validação da Trigger
```

---

### 🔹 Fase 1: Configuração da Conexão PDO
**Arquivo alvo**: [`config/database.php`](file:///c:/Users/Admin/development/php-store/config/database.php)

* [ ] Corrigir o DSN e constantes do PDO:
  * Ajustar charset para `utf8mb4` (corrigir typo `urf8mb4`).
  * Corrigir atributo `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION` (corrigir `ATTER_ERRMODE`).
  * Definir `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC`.
  * Definir `PDO::ATTR_EMULATE_PREPARES => false`.
* [ ] Centralizar o retorno de uma instância PDO reutilizável (função `get_connection()` ou variável `$connection`).
* [ ] Tratar exceções (`PDOException`) exibindo mensagens seguras de erro.

---

### 🔹 Fase 2: Camada de Dados (Model)
**Arquivo alvo**: [`model/product.php`](file:///c:/Users/Admin/development/php-store/model/product.php)

* [ ] Ajustar nomes de tabelas e colunas conforme os requisitos (tabela `produtos`, campos `nome`, `descricao`, `preco`, `quantidade`).
* [ ] Implementar funções com *Prepared Statements* seguros:
  * [ ] `create_product($nome, $descricao, $preco, $quantidade)`: Insere produto via `INSERT INTO produtos (...) VALUES (...)`.
  * [ ] `find_all_products($termo = '')`: Consulta produtos ordenados por ID decrescente (corrigir sintaxe do `LIKE` com parâmetros nomeados).
  * [ ] `find_product_by_id($id)`: Retorna os dados de um produto pelo ID.
  * [ ] `update_product($id, $nome, $descricao, $preco, $quantidade)`: Atualiza os dados de um produto existente (operação que aciona a Trigger).
  * [ ] `delete_product($id)`: Remove produto via `DELETE FROM produtos WHERE id = :id` (corrigir sintaxe removendo asterisco).
  * [ ] `get_product_history($id_produto = null)`: Consulta os registros de auditoria em `historico_alteracoes`.

---

### 🔹 Fase 3: Roteamento Principal (Front Controller)
**Arquivo alvo**: [`index.php`](file:///c:/Users/Admin/development/php-store/index.php)

* [ ] Configurar `index.php` como roteador central da aplicação.
* [ ] Capturar a ação solicitada via URL (ex: `index.php?action=create`, `?action=edit&id=1`, `?action=delete&id=1`, `?action=history`).
* [ ] Chamar a respectiva função do `productController.php` com base na rota informada.
* [ ] Definir a listagem de produtos (`list`) ou a home como rota padrão (`default`).

---

### 🔹 Fase 4: Lógica de Controle (Controller)
**Arquivo alvo**: [`controller/productController.php`](file:///c:/Users/Admin/development/php-store/controller/productController.php)

* [ ] Importar o Model correto ([`model/product.php`](file:///c:/Users/Admin/development/php-store/model/product.php)).
* [ ] Implementar as ações do controlador:
  * [ ] `controller_list()`: Busca produtos no Model e inclui `view/listProducts.php`.
  * [ ] `controller_create()`:
    * Se for requisição `GET`: exibe o formulário `view/addNewProduct.php`.
    * Se for requisição `POST`: valida campos obrigatórios, chama `create_product()`, define mensagem flash e redireciona.
  * [ ] `controller_edit($id)`:
    * Se for requisição `GET`: busca produto pelo ID e exibe `view/editProduct.php`.
    * Se for requisição `POST`: valida dados, chama `update_product()`, define mensagem flash e redireciona.
  * [ ] `controller_delete($id)`: Valida ID, executa `delete_product()` e redireciona para a listagem.
  * [ ] `controller_history()`: Busca o histórico de alterações e carrega `view/history.php`.

---

### 🔹 Fase 5: Interface do Usuário (Views)
**Diretório alvo**: `view/`

* [ ] **`view/listProducts.php`**:
  * Tabela responsiva com colunas: ID, Nome, Descrição, Preço (formatado em R$), Quantidade e Ações.
  * Botão de "Novo Produto" apontando para `index.php?action=create`.
  * Botão de "Editar" direcionando para `index.php?action=edit&id={id}`.
  * Botão de "Excluir" com confirmação em JavaScript (`confirm(...)`) direcionando para `index.php?action=delete&id={id}`.
  * Área para exibição de mensagens flash (sucesso/erro).
* [ ] **`view/addNewProduct.php`**:
  * Formulário HTML com método `POST` contendo:
    * Nome (texto, obrigatório)
    * Descrição (área de texto)
    * Preço (número com casas decimais, obrigatório)
    * Quantidade (número inteiro, obrigatório)
  * Botão de "Salvar" e link de "Voltar".
* [ ] **`view/editProduct.php`**:
  * Formulário similar ao de cadastro, porém com campos pré-preenchidos com os valores atuais do produto.
  * Campo oculto (`<input type="hidden" name="id">`) com o ID do produto.
* [ ] **`view/history.php`**:
  * Tabela que exibe as alterações registradas pela Trigger: Data/Hora, Produto, Campo Alterado, Valor Antigo e Valor Novo.

---

### 🔹 Fase 6: Testes e Validação da Trigger

* [ ] **Teste de Inserção**:
  * Cadastrar produto via interface e checar se aparece na listagem.
* [ ] **Teste de Atualização (Disparo da Trigger)**:
  * Alterar apenas o **Preço** de um produto existente.
  * Acessar a tela de histórico e verificar se apenas uma linha para o campo `preco` foi registrada.
  * Alterar **Preço** e **Quantidade** simultaneamente e checar se foram criados exatamente 2 registros no histórico.
* [ ] **Teste de Exclusão**:
  * Excluir um produto e verificar se o registro foi removido com sucesso (e se o histórico relacionado foi mantido ou excluído conforme regra de integridade).

---

## 🔒 Boas Práticas e Segurança

* **Prevenção de SQL Injection**: Utilizar exclusivamente *Prepared Statements* com parâmetros nomeados (`:nome`, `:preco`, etc.) em todas as queries.
* **Prevenção de XSS**: Escapar toda saída de dados vinda do banco ou de entradas do usuário nas views com `htmlspecialchars($valor, ENT_QUOTES, 'UTF-8')`.
* **Sanitização e Validação**: Validar tipos numéricos (`(float)`, `(int)`) e conferir se strings obrigatórias não estão vazias antes de enviar ao Model.


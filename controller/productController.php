<?php
require_once __DIR__ . '/../model/product.php';

function controller_home() {
  require_once __DIR__ . '/../view/home.php';
}

function controller_find_all() {
  $name = $_GET['name'] ?? '';
  $products = find_all_products($name);

  require_once __DIR__ . '/../view/listProducts.php';
}

function controller_create() {
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome       = $_POST["nome"] ?? $_POST["name"] ?? '';
    $descricao  = $_POST["descricao"] ?? $_POST["description"] ?? '';
    $preco      = $_POST["preco"] ?? $_POST["price"] ?? 0;
    $quantidade = $_POST["quantidade"] ?? $_POST["amount"] ?? 0;
    
    if (create_product($nome, $descricao, $preco, $quantidade)) {
      echo "<script>alert('Produto cadastrado com sucesso!'); window.location.href='index.php?action=list';</script>";
      exit;
    } else {
      echo "<script>alert('Erro ao cadastrar o produto!');</script>";
    }
  }

  require_once __DIR__ . '/../view/addNewProduct.php';
}

function controller_edit($id = null) {
  $id = $id ?? $_GET['id'] ?? null;

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome       = $_POST['nome'] ?? $_POST['name'] ?? '';
    $descricao  = $_POST['descricao'] ?? $_POST['description'] ?? '';
    $preco      = $_POST["preco"] ?? $_POST["price"] ?? 0;
    $quantidade = $_POST["quantidade"] ?? $_POST["amount"] ?? 0;

    if (update_product($id, $nome, $descricao, $preco, $quantidade)) {
      echo "<script>alert('Produto atualizado com sucesso!'); window.location.href='index.php?action=list';</script>";
      exit;
    } else {
      echo "<script>alert('Erro ao atualizar o produto!');</script>";
    }
  }

  $product = find_product_by_id($id);
  require_once __DIR__ . '/../view/editProduct.php';
}

function controller_delete($id = null) {
  $id = $id ?? $_GET['id'] ?? null;

  if ($id && delete_product($id)) {
    echo "<script>alert('Produto deletado com sucesso!'); window.location.href='index.php?action=list';</script>";
    exit;
  } else {
    echo "<script>alert('Erro ao deletar o produto!');</script>";
  }

  $products = find_all_products();
  require_once __DIR__ . '/../view/listProducts.php';
}

function controller_history($id = null) {
  $id = $id ?? $_GET['id'] ?? null;
  $history = get_product_history($id);

  require_once __DIR__ . '/../view/history.php';
}

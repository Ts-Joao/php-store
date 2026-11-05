<?php
require_once __DIR__ . '/../model/funcionario.php';

function controller_home() {
  require_once __DIR__ . '/../view/home.php';
}

function controller_create() {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? '';
    $price = $_POST["price"] ?? 0;
    $amount = $_POST["amount"] ?? 0;
    
    if (create_product($name, $price, $amount)) {
      echo "<script>alert('Produto cadastrado com sucesso!')</script>";
    } else {
      echo "<script>alert('Erro ao cadastrar o produto!')</script>";
    }
  }

  require_once __DIR__ . '/../view/addNewProduct.php';
}

function controller_find_all() {
  $name = $_GET['name'] ?? '';
  $products = find_all_products($name);

  require_once __DIR__ . '/../view/listProducts.php';
}

function controller_edit($id) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $price = $_POST["price"] ?? 0;
    $amount = $_POST["amount"] ?? 0;

    if (update_product($id, $name, $price, $amount)) {
      echo "<script>alert('Produto atualizado com sucesso!')</script>";
    } else {
      echo "<script>alert('Erro ao atualizar o produto!')</script>";
    }
  }

  require_once __DIR__ . '/../view/editProduct.php';
}

function controller_delete($id) {
  if (delete_product($id)) {
    echo "<script>alert('Produto deletado com sucesso!')</script>";
  } else {
    echo "<script>alert('Erro ao deletar o produto!')</script>";
  }

  require_once __DIR__ . '/../view/listProducts.php';
}

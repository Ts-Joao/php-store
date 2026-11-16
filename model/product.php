<?php
require_once __DIR__ . "/../config/database.php";

function create_product($nome, $preco, $quantidade) {
  global $connection;

  if (!$connection) {
    return false;
  }

  try {
    $sql = "INSERT INTO produtos (nome, descricao, preco, quantidade) VALUES (:nome, :descricao, :preco, :quantidade)";
    $stmt = $connection->prepare($sql);
  
    $result = $stmt->execute([
      'nome'          => $nome,
      'descricao'     => $descricao,
      'preco'         => $preco,
      'quantidade'    => $quantidade
    ]);
  
    return $result;

  } catch (PDOException $e) {
    return false;
  }
}

function find_all_products($termo = '') {
  global $connection;
  
  if (!$connection) {
    return [];
  }

  try {
    $sql = "SELECT * FROM produtos WHERE nome LIKE :termo ORDER BY id DESC";
    $stmt = $connection->prepare($sql);
    $search = '%' . $termo . '%';
 
    $products = $stmt->execute([
      'termo' => search;
  ]);
  
    return $products;

  } catch (PDOException $e) {
    return [];
  }
}

function find_product_by_id($id) {
  global $connection;

  if (!$connection) {
    return false;
  }

  try {
    $sql = "SELECT * FROM produtos WHERE id = :id";
    $stmt = $connection->prepare($sql);
    $result = $stmt->execute([
      'id' => $id
    ]);

    return $result;
    
  } catch (PDOException $e) {
    return false;
  }
}

function update_product($id, $nome, $descricao, $preco, $quantidade) {
  global $connection;

  if (!$connection) {
    return false;
  }

  try {
    find_product_by_id($id);

    $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, quantidade = :quantidade WHERE id = : id";
    $stmt = $connection->prepare($sql);

    $result = $stmt->execute([
      'id'          => $id,
      'nome'        => $nome,
      'descrao'     => $descricao,
      'preco'       => $preco,
      'quantidade'  => $quantidade,
    ]);

    return $result;
    
  } catch (PDOException $e) {
    return false;
  }
}

function delete_product($id) {
  global $connection;

  if (!$connection) {
    return false;
  }

  try {
    $sql = "DELETE FROM produtos WHERE id = :id";
    $stmt = $connection->prepare($sql);

    $result = $stmt->execute([
      'id' => $id
    ]);
  } catch (PDOException $e) {
    return false;
  }
}

function get_product_history($id = null) {
  global $connection;

  if (!$connection) {
    return [];
  }

  try {
    find_product_by_id($id);

    $sql = "SELECT * FROM historico_alteracoes WHERE id_produto = :id";
    $stmt = $connection->prepare($sql);
    
    $result = $stmt->execute([
      'id' => $id
    ]);

    return $result;
  } catch (PDOException $e) {
    return [];
  }
}

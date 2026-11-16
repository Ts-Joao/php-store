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
  
    return $stmt->execute([
      'nome'        => trim($nome),
      'descricao'   => trim($descricao),
      'preco'       => $preco,
      'quantidade'  => $quantidade
    ]);
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
    if (!empty($termo)) {
      $sql = "SELECT * FROM produtos WHERE nome LIKE :termo ORDER BY id DESC";
      $stmt = $connection->prepare($sql);
      $stmt->execute(['termo' => '%' . trim($termo) . '%']);
    } else {
      $sql = "SELECT * FROM produtos ORDER BY id DESC";
      $stmt = $connection->query($sql);
    }
  
    return $stmt->fetchAll();
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
    $stmt->execute(['id' => $id]);

    return $stmt->fetch();
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
    $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, quantidade = :quantidade WHERE id = :id";
    $stmt = $connection->prepare($sql);

    return $stmt->execute([
      'id'          => $id,
      'nome'        => trim($nome),
      'descricao'   => trim($descricao),
      'preco'       => $preco,
      'quantidade'  => $quantidade,
    ]);
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

    return $stmt->execute(['id' => $id]);
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
    if ($id) {
      $sql = "SELECT h.*, p.nome AS produto_nome 
              FROM historico_alteracoes h 
              JOIN produtos p ON h.id_produto = p.id 
              WHERE h.id_produto = :id 
              ORDER BY h.data_alteracao DESC";
      $stmt = $connection->prepare($sql);
      $stmt->execute(['id' => $id]);
    } else {
      $sql = "SELECT h.*, p.nome AS produto_nome 
              FROM historico_alteracoes h 
              JOIN produtos p ON h.id_produto = p.id 
              ORDER BY h.data_alteracao DESC";
      $stmt = $connection->query($sql);
    }

    return $stmt->fetchAll();
  } catch (PDOException $e) {
    return [];
  }
}

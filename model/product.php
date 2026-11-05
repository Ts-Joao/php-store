<?php
require_once __DIR__ . "/../config/database.php";

function create_product($name, $price, $amount) {
  global $connection;

  if (!$connection) {
    return false;
  }

  try {
    $sql = "INSERT INTO products (name, price, amount) VALUES (:name, :price, :amount)";
    $stmt = $connection->prepare($sql);
  
    $result = $stmt->execute([
      'name'    => $name,
      'price'   => $price,
      'amount'  => $amount
    ]);
  
    return $result;

  } catch (PDOException $e) {
    return false;
  }
}

function find_all_products($name = '') {
  global $connection;
  
  if (!$connection) {
    return [];
  }

  try {
    $sql = "SELECT* FROM products WHERE name LIKE '%:name%'";
    $stmt = $connection->prepare($sql);
  
    $products = $stmt->execute([
      'name' => $name
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
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $connection->prepare($sql);
    $result = $stmt->execute([
      'id' => $id
    ]);

    return $result;
    
  } catch (PDOException $e) {
    return false;
  }
}

function update_product($id, $name, $price, $amount) {
  global $connection;

  if (!$connection) {
    return false;
  }

  try {
    find_product_by_id($id);

    $sql = "UPDATE products SET name = :name, price = :price, amount = :amount WHERE id = : id";
    $stmt = $connection->prepare($sql);

    $result = $stmt->execute([
      'id'      => $id,
      'name'    => $name,
      'price'   => $price,
      'amount'  => $amount,
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
    $sql = "DELETE * FROM products WHERE id = :id";
    $stmt = $connection->prepare($sql);

    $result = $stmt->execute([
      'id' => $id
    ]);
  } catch (PDOException $e) {
    return false;
  }
}

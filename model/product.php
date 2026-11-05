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

  } catch (PDOExecption $e) {
    return false;
  }
}
<?php
$server = 'localhost';
$user = 'root';
$password = '';
$db = 'estoque_db';

$dsn = "mysql:host=$server;dbname=$db;charset=utf8mb4";

$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES    => false,
];

try {
  $connection = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
  $connection = false;
}
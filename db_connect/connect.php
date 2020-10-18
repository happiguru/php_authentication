<?php

$host = 'localhost';
$user = 'root';
$password = '';
$schema = 'mySchema';

$pdo = NULL;

// CONNECTION TO DATABASE

$dsn = 'mysql:host=' . $host . ';dbname=' . $schema;

try {
  $pdo = new PDO($dsn, $user, $password);

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
  echo 'Database connection failed.';
  die();
}

?>
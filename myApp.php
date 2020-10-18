<?php

session_start();

require 'db_connect/connect.php';
require 'classes/account.php';

$account = new Account();

try 
{
  $newId = $account->addAccount('myNewName', 'myPassword');
}
catch (Exception $e)
{
  echo $e->getMessage();
  die();
}

echo 'The new account ID is ' . $newId;
?>
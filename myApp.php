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

// 2. Edit an account. Try passing invalid parameters to test error messages.
/*
$accountId = 1;

try
{
	$account->editAccount($accountId, 'myNewName', 'new password', TRUE);
}
catch (Exception $e)
{
	echo $e->getMessage();
	die();
}

echo 'Account edit successful.';
*/

// 3. Delete an account.
/*
$accountId = 1;

try
{
	$account->deleteAccount($accountId);
}
catch (Exception $e)
{
	echo $e->getMessage();
	die();
}

echo 'Account delete successful.';
*/

// 4. Login with username and password.
/*
$login = FALSE;

try
{
	$login = $account->login('myUserName', 'myPassword');
}
catch (Exception $e)
{
	echo $e->getMessage();
	die();
}

if ($login)
{
	echo 'Authentication successful.';
	echo 'Account ID: ' . $account->getId() . '<br>';
	echo 'Account name: ' . $account->getName() . '<br>';
}
else
{
	echo 'Authentication failed.';
}
*/

// 5. Session login
/*
$login = FALSE;

try
{
	$login = $account->sessionLogin();
}
catch (Exception $e)
{
	echo $e->getMessage();
	die();
}

if ($login)
{
	echo 'Authentication successful.';
	echo 'Account ID: ' . $account->getId() . '<br>';
	echo 'Account name: ' . $account->getName() . '<br>';
}
else
{
	echo 'Authentication failed.';
}
*/

// 6. Logout.
/*
try
{
	$login = $account->login('myUserName', 'myPassword');
	
	if ($login)
	{
		echo 'Authentication successful.';
		echo 'Account ID: ' . $account->getId() . '<br>';
		echo 'Account name: ' . $account->getName() . '<br>';
	}
	else
	{
		echo 'Authentication failed.<br>';
	}
	
	$account->logout();
	
	$login = $account->sessionLogin();
	
	if ($login)
	{
		echo 'Authentication successful.';
		echo 'Account ID: ' . $account->getId() . '<br>';
		echo 'Account name: ' . $account->getName() . '<br>';
	}
	else
	{
		echo 'Authentication failed.<br>';
	}
}
catch (Exception $e)
{
	echo $e->getMessage();
	die();
}

echo 'Logout successful.';
*/

// 7. Close other open Sessions (if any).
/*
try
{
	$login = $account->login('myUserName', 'myPassword');
	
	if ($login)
	{
		echo 'Authentication successful.';
		echo 'Account ID: ' . $account->getId() . '<br>';
		echo 'Account name: ' . $account->getName() . '<br>';
	}
	else
	{
		echo 'Authentication failed.<br>';
	}
	
	$account->closeOtherSessions();
}
catch (Exception $e)
{
	echo $e->getMessage();
	die();
}

echo 'Sessions closed successfully.';
*/
?>
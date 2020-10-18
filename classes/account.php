<?php
class Account
{
  private $id;
  Private $name;
  private $authenticated;

  public function _construct()
  {
    $this->id = NULL;
    $this->name = NULL;
    $this->authenticted = FALSE;
  }

  public function _destruct()
  {

  }

  public function addAccount(string $name, string $password): int
  {
    global $pdo;

    $name = trim($name);
    $password = trim($password);

    if(!this->isNameValid($name))
    {
      throw new Exception('Invalid user name');
    }

    if(!this->isPasswordValid($password)){
      throw new Exception('Invalid password');
    }

    if(!is_null($this->getIdFromName($name))){
      throw new Exception('User name not available');
    }

    $query = 'INSERT INTO myschema.accounts (account_name, account_passwd) VALUES(:name, :password)';
    
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $values = array(':name' => $name, ':password' => $hash);

    try
    {
      $res = $pdo->prepare($query);
      $res->execute($values);
    }
    catch (PDOException $e)
    {
      throw new Exception('Database query error');
    }
    return $pdo->lastInsertId();
  }

  public function isNameValid(string $name): bool
  {
    $valid = TRUE;

    $len = mb_strlen($name);

    if(($len < 8) || ($len > 16))
    {
      $valid = FALSE;
    }
    return $valid;
  }

  public function isPasswordValid(string $password): bool
  {
    $valid = TRUE;

    $len = mb_strlen($password);
    if(($len < 8) || ($len > 16))
    {
      $valid = FALSE;
    }
    return $valid;
  }

  public function getIdFromName(string $name): ?int
  {
    global $pdo;

    if(!$this->isNameValid($name))
    {
      throw new Exception('Invalid user name');
    }
    $id = NULL;

    $query = 'SELECT account_id FROM myschema.accounts WHERE (account_name = :name)';
    $values = array(':name' => $name);

    try
    {
      $res = $pdo->prepare($query);
      $res->execute($values);
    }
    catch (PDOException $e)
    {
      throw new Exception('Database query error');
    }

    $row = $res->fetch(PDO::FETCH_ASSOC);
    if(is_array($row))
    {
      $id = intval($row['account_id']), 10);
    }
    return $id;
  }

  public function editAccount(int $id, string $name, string $password, bool $enabled)
  {
    global $pdo;

    $name = trim($name);
    $password = trim($password);

    if(!$this->isIdValid($id))
    {
      throw new Exception('Invalid account ID');
    }

    if(!$this->isNameValid($name)){
      throw new Exception('Invalid user name');
    }

    if(!$this->isPasswordValid($password))
    {
      throw new Exception('Invalid password');
    }

    $idFromName = $this->getIdFromName($name);

    if(!is_null($idFromName) && ($idFromName != $id))
    {
      throw new Exception('User name already used');
    }

    $query = 'UPDATE myschema.accounts SET account_name = :name, account_passwd, account_enabled = :enabled WHERE account_id = :id';
    $hash = password_hash($passwd, PASSWORD_DEFAULT);
    
    $intEnabled = $enabled ? 1 : 0;
    
    $values = array(':name' => $name, ':passwd' => $hash, ':enabled' => $intEnabled, ':id' => $id);

    try
    {
      $res = $pdo->prepare($query);
      $res->execute($values);
    }
    catch (PDOException $e)
    {
      throw new Exception('Database query error');
    }
  }

  public function isIdValid(int $id): bool
  {
    $valid = TRUE;
    
    if (($id < 1) || ($id > 1000000))
    {
      $valid = FALSE;
    }
    
    return $valid;
  }

  public function deleteAccount(int $id)
  {
    global $pdo;
    
    if (!$this->isIdValid($id))
    {
      throw new Exception('Invalid account ID');
    }
    
    $query = 'DELETE FROM myschema.accounts WHERE account_id = :id';

    $values = array(':id' => $id);

    try
    {
      $res = $pdo->prepare($query);
      $res->execute($values);
    }
    catch (PDOException $e)
    {
      throw new Exception('Database query error');
    }

    $query = 'DELETE FROM myschema.account_sessions WHERE (account_id = :id)';

    $values = array(':id' => $id);

    try
    {
      $res = $pdo->prepare($query);
      $res->execute($values);
    }
    catch (PDOException $e)
    {
      throw new Exception('Database query error');
    }
  }
  }


?>
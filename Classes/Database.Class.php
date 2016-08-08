<?php
class Database
{
  private $con;
  function __construct($dsn, $username, $password)
  {
    try {
         $this->con = new PDO($dsn, $username, $password);
         $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
         echo $e->getMessage();
    }
  }
  public function query($query, $args)
  {
    $res = $this->con->prepare($query);
    $res->execute($args);
    return $res;
  }
}

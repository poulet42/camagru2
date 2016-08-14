<?php
class Authentificator {

  private $_database;
  private $_errors;


  public function __construct(Database $database) {
    $this->_database = $database;
  }

  /**
  ***  Authentification, activation et inscription
  **/

  public function register($login, $email, $password) {
    $hashedpw = hash("whirlpool", $password);
    $hash = hash("whirlpool", rand(1, 2000) . $login);
    $this->_database->query("INSERT INTO users (login, mail, password, activhash) VALUES (?, ?, ?, ?)", [$login, $email, $hashedpw, $hash]);
  }
  public function login($username, $password)
  {
    $credentials = $this->_database->query("SELECT id, activated FROM users WHERE (login = ? OR mail = ?) AND password = ? LIMIT 1", [$username, $username, hash("whirlpool", $password)])->fetch(PDO::FETCH_ASSOC);
    if (empty($credentials))
      $this->addError("Le couple Identifiant / Mot de passe est incorrect");
    elseif ($credentials['activated'] == "0")
      $this->addError("Ce compte n'est pas activé");
    else
    {
      $_SESSION['user'] = $credentials['id'];
    }
    return empty($this->_errors);
  }
  public function activate($user, $hash)
  {
    return ($this->_database->query("UPDATE users SET activated = 1 WHERE activhash = ? AND (login = ? OR mail = ?)", [$hash, $user, $user]));
  }

  /**
  ***  GESTION D'ERREUR
  **/

  public function addError($string) {
    $this->_errors[] = $string;
  }
  public function getErrors() {
    return $this->_errors;
  }
  public function flushErrors() {
    $errors = array();
  }
}
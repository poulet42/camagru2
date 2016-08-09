<?php

class User
{
  private $connexion;
  private $_errors;
  static $activation_needed = true;


  public function __construct(Database $connexion)
  {
    $this->connexion = $connexion;
  }

  public function sendLink($login, $hash, $mail)
  {
    mail($mail, 'Activation du compte - ' . $login, $_SERVER["REQUEST_URI"] . '/login.php?action=activate&hash=' . $hash, "cprune@student.42.fr");
  }

  public function register($login, $password, $email)
  {
    $hashedpw = hash("whirlpol", $password);
    $hash = hash("whirlpool", rand(1, 2000) . $login);
    $this->connexion->query("INSERT INTO users (login, mail, password, activhash) VALUES (?, ?, ?, ?)", [$login, $email, $hashedpw, $hash]);
    if (self::$activation_needed = true)
      $this->sendLink($login, $hash, $email);
    return $this;
  }

  public function exists($login, $mail)
  {
    $stmt = $this->connexion->query("SELECT id FROM users WHERE login = ? OR mail = ?", [$login, $mail]);
    return ($stmt->rowCount() ? 1 : 0);
  }

  public function activate($hash)
  {
    $stmt = $this->connexion->query("UPDATE users SET activated = 1 WHERE activhash = ?", [$hash]);
    return ($stmt);
  }

  public function isActivated($hash)
  {
    $stmt = $this->connexion->query("SELECT activated FROM users WHERE activhash = ?", [$hash]);
    return ($stmt->fetch());
  }

  public function auth($login, $password)
  {
    $stmt = $this->connexion->query("SELECT id, login, mail FROM users WHERE login = ? AND password = ? LIMIT 1", [$login, hash("whirlpool", $password)]);
    if (($ret = $stmt->rowCount()))
      echo "connexion OK";
      //$session->set('user', $stmt->fetch(PDO::FETCH_ASSOC));
    else
      $this->_errors[] = "Le couple Identifiant / Mot de passe est incorrect";
    return !empty($ret);
  }

  public function getErrors()
  {
    return $this->_errors;
  }
  public function redirectTo($path) {
    header('Location: ' . $path);
  }
  public function login() {
    $session['user'] = ['id' => $this->_id, 'username' => $this->_username, 'email' => ''];
  }
}

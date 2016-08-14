<?php

class User
{
  private $connexion;
  private $_errors;
  static $activationNeeded = true;

  private $_id = null;

  public function __construct(Database $connexion)
  {
    $this->connexion = $connexion;
  }

  public function sendLink($login, $hash, $mail)
  {
    mail($mail, 'Activation du compte - ' . $login, $_SERVER["REQUEST_URI"] . '/?action=activate&user=' . $login . '&hash=' . $hash, "cprune@student.42.fr");
  }
/*
  public function register($login, $password, $email)
  {
    $hashedpw = hash("whirlpool", $password);
    $hash = hash("whirlpool", rand(1, 2000) . $login);
    $this->connexion->query("INSERT INTO users (login, mail, password, activhash) VALUES (?, ?, ?, ?)", [$login, $email, $hashedpw, $hash]);
    if (self::$activationNeeded = true)
      $this->sendLink($login, $hash, $email);
    return $this;
  }
*/
  public function exists($login, $mail)
  {
    $stmt = $this->connexion->query("SELECT id FROM users WHERE login = ? OR mail = ?", [$login, $mail]);
    return ($stmt->rowCount() ? 1 : 0);
  }
/*
  public function activate($user, $hash)
  {
    $stmt = $this->connexion->query("UPDATE users SET activated = 1 WHERE activhash = ? AND (login = ? OR mail = ?)", [$hash, $user, $user]);
    return ($stmt);
  }
*/
  public function isActivated($user)
  {
    $stmt = $this->connexion->query("SELECT activated FROM users WHERE login = ? OR mail = ?", [$user, $user]);
    return ($stmt->fetch());
  }

  public function setId($id)
  {
    echo "<script>console.log('Set ID : " . $this->_id . "')</script>";
    $this->_id = $id;
  }
  public function connected()
  {
    return ($this->_id != NULL);
  }
  public function redirectTo($path) {
    header('Location: ' . $path);
  }
  public function getLogin($id = NULL) {
    if ($id == NULL)
      $id = $this->_id;
    return $this->connexion->query("SELECT login FROM users WHERE id = ? LIMIT 1", [$id])->fetchColumn();
  }
  public function getAvatar($id = NULL) {
     if ($id == NULL)
      $id = $this->_id;
    $imgurl = $this->connexion->query("SELECT avatar FROM users WHERE id = ? LIMIT 1", [$id])->fetchColumn();
    if ($imgurl == NULL)
      $imgurl = "img/default-avatar.svg";
    return $imgurl;
  }
  public function logout() {
    unset($_SESSION['user']);
    return $this;
  }
}

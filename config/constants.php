<?php
if($_SERVER['SERVERNAME'] == "localhost")
  define("ABS_PATH", "/var/www/html/camagru");
else
  define("ABS_PATH", dirname(__FILE__)"/..");
define('HOME', '/index.php');
define('LOGIN', '/form.php');
define('LOGOUT', '/logout.php');
define('REGISTER', '/form.php?action=register');
?>
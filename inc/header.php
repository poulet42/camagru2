<?php
require ("inc/appstart.php");
require_once ('inc/funcs/dbconnect.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <!--GOOGLE FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Assistant|Open+Sans|Raleway|Source+Sans+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
    <!----------------->
    <link rel="stylesheet" href="css/style.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <header class='primary-header'>
      <div class='header-logo-wrapper'>
        <span class='header-logo-text'>
          LOGO
        </span>
      </div>
      <ul class='primary-nav'>
        <?php if (isset($_SESSION['loggued_user'])): ?>
            <li class="nav-entry nav-entry--full-width">
                <label for="user-head-toggle" class="nav-entry-link user-head-link">
                    <img class="user-head-thumb" src="img/default-avatar.svg">
                    <span class="user-head-name"><?= $_SESSION['loggued_user'] ?></span>
                </label>
                <input type="checkbox" id="user-head-toggle" />
                <ul class='user-head-submenu'>
                    <li class="user-head-submenu-entry">Mon compte</li>
                    <li class="user-head-submenu-entry"><a class="user-head-submenu-link" href="logout.php">Déconnexion</a></li>
                </ul>
            </li>

        <?php else: ?>
            <li class="nav-entry"><a href="/form.php" class="nav-entry-link header-btn">Login</a></li>
            <li class="nav-entry"><a href="/form.php?action=register" class="nav-entry-link header-btn">Register</a></li>
        <?php endif; ?>

      </ul>
    </header>

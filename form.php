<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 03/08/2016
 * Time: 15:42
 */
ob_start();
include_once(ABS_PATH . "/inc/header.php");
if ($user->connected())
  $user->redirectTo(HOME);
$auth = new Authentificator($DB_CON);
?>

<section class='main-content'>

  <div class='login-container'>

    <?php

    if (isset($_GET['action'])) {
      if ($_GET['action'] == 'register')
        include "inc/register.php";
      elseif ($_GET['action'] == 'activate')
        include $_SERVER['DOCUMENT_ROOT'] . "/inc/activate.php";
    } else {
      if (isset($_GET['registration']))
      {
        if ($_GET['registration'] == "successful" && $user->isActivated())
          echo "Compte activé, vous pouvez maintenant vous connecter !";
        elseif ($_GET['registration'] == "notactivated")
          echo "Inscription complete, veuillez activer votre compte pour vous connecter";
      }
      include $_SERVER['DOCUMENT_ROOT'] . "/inc/login.php";

    }

    ?>

  </div>

</section>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/inc/footer.php");
ob_end_flush();
?>
<?php
if (!empty($_POST['hash'])) {
  if ($user->activate($_GET['user'], $_GET['hash']))
    $user->redirectTo('form.php?action=successful');
  $user->getErrors();
}
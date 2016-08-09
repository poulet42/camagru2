<?php
if (!empty($_POST['hash'])) {
  $user->activate($_POST['hash'])->redirectTo('form.php?action=successful');
}
<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 07/08/2016
 * Time: 16:35
 */
if (isset($_POST['login']) && $_POST['login']['submit'] == "login") {
  if ($auth->login($_POST['login']['username'], $_POST['login']['password']))
    $user->redirectTo(HOME);
  else
    $errors = $auth->getErrors();
}
else {
  echo "<script>console.log('La variable post n\'existe pas, ou la valeur du submit est incorrecte');</script>";
}
?>

<?php if (!empty($errors)): ?>

<ul class="error-wrapper">

  <?php foreach ($errors as $error): ?>

  <li class='err' onclick="this.remove()"><?= $error ?></li>

  <?php endforeach; ?>

</ul>

<?php endif; ?>

<div class='fhead'>

  <h4 class='ftitle'>Connexion</h4>

</div>

<form method="post">

  <input type="text" name="login[username]" class="ftext" placeholder="Pseudo / Email"
         value="<?= rine($_POST['login']['username']) ?>" required/>
  <input type="password" id="password" class='ftext' name="login[password]"
         placeholder="Mot de passe" required>
  <button type="submit" class='fsubmit' name='login[submit]' value="login">Connexion</button>

</form>
<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 03/08/2016
 * Time: 20:29
 */

$validation = new Validator($_POST['register']);

$validation
    ->constraint("password", "password2", "equals", "Les mots de passe ne sont pas égaux !")
    ->add("username", ["minlen" => 5, "maxlen" => 20, "regex" => "^[a-zA-Z0-9]+$", "errname" => "Pseudo"])
    ->add("mail", ["minlen" => 5, "regex" => '^[a-zA-Z0-9._-]+\@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$', "errname" => "Email"])
    ->add("password", ['minlen' => 6, 'regex' => '^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\*\!\-\_\&\%\$]+$', "errname" => "Mot de passe"]);

if (isset($_POST['register'])) {
    if ($validation->validate() && !$user->exists($_POST['register']['username'], $_POST['register']['mail']))
        $user->register($_POST['register']['username'], $_POST['register']['password'], $_POST['register']['mail'])->redirectTo('form.php?registration=successful');
    else
        $errors = $validation->getErrors();
}
if (!empty($errors)): ?>

    <ul class="error-wrapper">

        <?php foreach ($errors as $error): ?>

            <li class='err' onclick="this.remove()"><?= $error ?></li>

        <?php endforeach; ?>

    </ul>

<?php endif; ?>

<div class='fhead'>

    <h4 class='ftitle'>Inscription</h4>

</div>

<form method="post">

    <input type="text" name="register[username]" class="ftext" placeholder="Pseudo"
           value="<?= rine($_POST['register']['username']) ?>" required/>

    <div class="tooltip-wrap">
        <input type="text" id="mail" class='ftext has-tooltip' name="register[mail]" placeholder="Adresse mail"
               value="<?= rine($_POST['register']['mail']) ?>" required/>
        <span class="tooltip">Cette email sera utilisée pour activer votre compte.</span>
    </div>

    <div class="tooltip-wrap">
        <input type="password" id="password" class='ftext has-tooltip' name="register[password]"
               placeholder="Mot de passe" required>
        <span class="tooltip">Votre mot de passe doit contenir plus de 6 caractères</span>
    </div>

    <div class="tooltip-wrap">
        <input type="password" id="password2" class='ftext has-tooltip' name="register[password2]"
               placeholder="Confirmer le mot de passe" required>
        <span class="tooltip">Les deux mots de passe doivent être égaux</span>
    </div>

    <button type="submit" class='fsubmit' name='register[submit]' value="register">Inscription</button>

</form>
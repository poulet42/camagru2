<?php
require_once('inc/appstart.php');
require_once('inc/funcs/dbconnect.php');
$errors = array();
if (!empty($_SESSION['loggued_user']))
    header("Location: index.php");
if (!empty($_GET['action']) && $_GET['action'] == 'activate') {
    if (isset($_GET['hash']) && !($user->activate(enc($_GET['hash']))))
        $errors[] = "Le code d'activation ne correspond pas";
    elseif ($user->is_activated($_GET['hash'])) {
        header("Location: index.php");
    }
} elseif (isset($_POST['submit'])) {
    $val = new Form();
    if ($_POST['submit'] == 'register') {
        if (!$val->check_login($_POST['login'])) {
            $errors[] = "Veuillez remplir correctement le champ Pseudo";
        }
        if (!$val->check_passwd($_POST['password'])) {
            $errors[] = "Veuillez remplir correctement le champ Mot de passe";
        }
        if ($_POST['password'] != $_POST['password2']) {
            $errors[] = "Les mots de passe ne correspondent pas";
        }
        if (!$val->check_mail($_POST['mail'])) {
            $errors[] = "Adresse mail incorrecte";
        }
        if ($user->exists($val->enc($_POST['login']), $val->enc($_POST['mail']))) {
            $errors[] = "Ce pseudo / mail est déjà utilisé";
        }
        if (empty($errors)) {
            $user->setLogin(enc($_POST['login']));
            $user->setMail(enc($_POST['mail']));
            $user->setPassword(enc_pass($_POST['password']));
            $user->register();
            header("Location: index.php");
        }
    } elseif ($_POST['submit'] == 'login') {

        $login = $val->enc($_POST['login']);
        $password = $val->enc_pass($_POST['password']);
        if ($user->auth($login, $password)) {
            $_SESSION['loggued_user'] = htmlspecialchars($_POST['login']);
            header("Location: index.php");
        } else {
            $errors[] = "Le couple identifiant / mot de passe est incorrect";
        }
    } else {
        $errors[] = "Erreur lors de l'authentification, veuillez réessayer";
    }
}
?>
<?php include_once('inc/header.php'); ?>
<section class='main-content'>
    <?php if ($errors): ?>
        <ul class="error-wrapper">
            <?php foreach ($errors as $error): ?>
                <li class='err' onclick="this.remove()"><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class='login-container'>
        <?php if (isset($_GET['action']) && $_GET['action'] == 'register'): ?>
            <div class='fhead'>
                <h4 class='ftitle'>Inscription</h4>
            </div>
            <form method="post">
                <input type="text" id="pseudo" class='ftext' name="login" placeholder="Pseudo"
                       value="<?= htmlspecialchars(@$_POST['login']) ?>">
                <div class="tooltip-wrap">
                    <input type="text" id="mail" class='ftext has-tooltip' name="mail" placeholder="Adresse mail"
                           value="<?= htmlspecialchars(@$_POST['mail']) ?>">
                    <span class="tooltip">Cette email sera utilisée pour activer votre compte.</span>
                </div>
                <div class="tooltip-wrap">
                    <input type="password" id="password" class='ftext has-tooltip' name="password"
                           placeholder="Mot de passe">
                    <span class="tooltip">Votre mot de passe doit contenir plus de 6 caractères</span>
                </div>
                <div class="tooltip-wrap">
                    <input type="password" id="password2" class='ftext has-tooltip' name="password2"
                           placeholder="Confirmer le mot de passe">
                    <span class="tooltip">Les deux mots de passe doivent être égaux</span>
                </div>
                <button type="submit" class='fsubmit' name='submit' value="register">Inscription</button>
            </form>
        <?php elseif (isset($_GET['action']) && $_GET['action'] == 'activate'): ?>
            <div class='fhead'>
                <h4 class='ftitle'>Activation</h4>
            </div>
            <form method="get">
                <input type="text" id="activation_code" class="ftext" name="hash"
                       placeholder="Copiez votre code d'activation ici"/>
                <button type="submit" class="fsubmit" name="action" value="activate">Activer</button>
            </form>
        <?php else: ?>
            <div class='fhead'>
                <h4 class='ftitle'>Connexion</h4>
            </div>
            <form method="post">
                <input type="text" id="pseudo" class='ftext' name="login" placeholder="Pseudo">
                <input type="password" id="password" class='ftext' name="password" placeholder="Mot de passe">
                <button type="submit" class='fsubmit' name='submit' value="login">Connexion</button>
            </form>
        <?php endif; ?>
        </form>
    </div>
</section>
<?php include_once('inc/footer.php'); ?>

<?php
/**
 * Created by PhpStorm.
 * User: Corentin
 * Date: 03/08/2016
 * Time: 15:42
 */
//TODO : ADD LOGIN AND ACTIVATE
ob_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/inc/header.php");
?>

    <section class='main-content'>

        <div class='login-container'>

            <?php

            if (isset($_GET['action'])) {

                if ($_GET['action'] == 'register') {

                    include $_SERVER['DOCUMENT_ROOT'] . "/inc/register.php";

                } elseif ($_get['action'] == 'activate') {

                    include $_SERVER['DOCUMENT_ROOT'] . "/inc/activate.php";

                }

            } else {

                if (isset($_GET['registration']) && $_GET['registration'] == "successful")
                    echo "Inscription complete, veuillez activer votre compte pour vous connecter";
                include $_SERVER['DOCUMENT_ROOT'] . "/inc/login.php";

            }

            ?>

        </div>

    </section>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/inc/footer.php");
ob_end_flush();
?>
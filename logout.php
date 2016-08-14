<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/inc/header.php");
$user->logout()->redirectTo(HOME);
?>

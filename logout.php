<?php
session_start();
unset($_SESSION['loggued_user']); 
header('Location: login.php');
?>

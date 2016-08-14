<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/constants.php');
session_start();
$DB_CON = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
$user = new User($DB_CON);
if (!empty($_SESSION['user']))
  $user->setId($_SESSION['user']);
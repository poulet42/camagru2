<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
//$session = new Session;
$DB_CON = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
$user = new User($DB_CON);

<?php
//Logout
session_start();

$_SESSION = array();

session_destroy();

header("Location: http://localhost/php-training-mysql/index.php"); // on redirige l'utilisateur vers la page d'accueil

?>
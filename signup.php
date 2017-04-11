<?php

include("database.php");
session_start();

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$newuser = $bdd->prepare("INSERT INTO users (login, mdp) VALUES (:login, :mdp)");


// si l'utilisateur renseigne les champs et valide le formulaire, il est inscrit à la base de données
if ((isset($username)) && (isset($password)) && (isset($_POST['button']))) {
	$_SESSION['login'] = $username;
	$_SESSION['mdp'] = $password;

	$newuser->execute(array('login' => $username, 'mdp' => $password));

	header("Location: http://localhost/php-training-mysql/page_membre.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> S'inscrire </title>
</head>
<body>
	<form action="" method="post">
		<div>
        <label for="username">Identifiant</label>
        <input type="text" name="username" required>
      </div>
      <div>
        <label for="password">Mot de passe </label>
        <input type="password" name="password" required>
      </div>
      <div>
        <button type="submit" name="button">S'inscrire</button>
      </div>
	</form>
    <a href="index.php"> Retour à l'accueil </a>
</body>
</html>
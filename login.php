<?php

include("database.php");

$req = $bdd->prepare("SELECT login, mdp FROM users WHERE login = :login AND mdp = :mdp");

$login = htmlspecialchars($_POST['username']);
$mdp = htmlspecialchars($_POST['password']);
$submit = $_POST['button'];

// si l'utilisateur remplit le formulaire et le valide
if ((isset($login)) && (isset($mdp)) && (isset($submit))) {
    $_SESSION['login'] = $login;
    $_SESSION['mdp'] = $mdp;
    $req->execute(array('login' => $login, 'mdp' => $mdp));

    $connecteduser = $req->fetch();

    // si les identifiants de l'utilisateur ne figurent pas dans la base de données, on empêche la connexion et on le propose de s'inscrire
    if (!$connecteduser) {
      echo "Utilisateur inconnu ! Vérifiez bien votre identifiant et votre mot de passe !";
      echo '<a href="signup.php"> S\'inscrire </a>';
    }
    else { // sinon, la session peut démarrer et l'utilisateur peut accéder à sa page membre personnelle
      session_start();
      $_SESSION['login'] = $connecteduser['login'];
      $_SESSION['mdp'] = $connecteduser['mdp'];
      header("Location: http://localhost/php-training-mysql/page_membre.php");
    }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
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
        <button type="submit" name="button">Se connecter</button>
      </div>
    </form>
    <a href="index.php"> Retour à l'accueil </a>
  </body>
</html>
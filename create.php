<?php

session_start();

include("database.php");

$randonnees = $bdd->query('SELECT * FROM hiking');

$name = htmlspecialchars($_POST['name']);
$difficulty = htmlspecialchars($_POST['difficulty']);
$distance = htmlspecialchars($_POST['distance']);
$duration = htmlspecialchars($_POST['duration']);
$height_difference = htmlspecialchars($_POST['height_difference']);
$available = htmlspecialchars($_POST['available']);

if ((isset($name)) && (isset($difficulty)) && (isset($distance)) && (isset($duration)) && (isset($height_difference)) && (isset($available)) && (isset($_POST['button']))) {
	$req = $bdd->prepare("INSERT INTO hiking (name, difficulty, distance, duration, height_difference, available) VALUES (?, ?, ?, ?, ?, ?)");
		
	$req->execute(array($name, $difficulty, $distance, $duration, $height_difference, $available));

	echo "La randonnée a été ajoutée avec succès.";
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="" required>
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty" required>
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="" required pattern="[0,9]">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="" required pattern="[0,9]">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="" required pattern="[0,9]">
		</div>
		<div>
			<label>Available</label>
			<input type="text" name="available" value="" required>
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>

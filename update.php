<?php

session_start();

include("database.php");

if (isset($_GET['id'])) { // si l'utilisateur clique sur "Modifier la randonnée"
	
	if ((isset($name)) && (isset($difficulty)) && (isset($distance)) && (isset($duration)) && (isset($height_difference)) && (isset($available)) && (isset($_POST['button']))) {
	$req = $bdd->prepare("UPDATE hiking SET name= :nvname, difficulty= :nvdifficulty, distance= :nvdistance, duration= :nvduration, height_difference= :nvheight_difference, available= :nvavailable WHERE id= :id");

	$nvname = htmlspecialchars($_POST['name']);
	$nvdifficulty = htmlspecialchars($_POST['difficulty']);
	$nvdistance = htmlspecialchars($_POST['distance']);
	$nvduration = htmlspecialchars($_POST['duration']);
	$nvheight_difference = htmlspecialchars($_POST['height_difference']);
	$nvavailable = htmlspecialchars($_POST['available']);

	
	$req->execute(array('nvname' => $nvname,
						'nvdifficulty' => $nvdifficulty,
						'nvdistance' => $nvdistance,
						'nvduration' => $nvduration,
						'nvheight_difference' => $nvheight_difference,
						'nvavailable' => $nvavailable,
						'id'=> $_GET['id']
	));

	echo "La randonnée a été modifiée avec succès.";
}
}

$fullfield = $bdd->prepare("SELECT * FROM hiking");
$fullfield->execute(array('id' => $_GET['id']));

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
	<?php while ($donnees = $fullfield->fetch()) { ?>
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo $donnees['name'] ?>">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?php echo $donnees['distance'] ?>" pattern="[0,9]">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?php echo $donnees['duration'] ?>" pattern="[0,9]">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?php echo $donnees['height_difference'] ?>" pattern="[0,9]">
		</div>
		<div>
			<label>Available</label>
			<input type="text" name="available" value="<?php echo $donnees['available'] ?>">
		</div> <br> <br>
		<?php }
		$fullfield->closeCursor(); ?>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>

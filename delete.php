<?php
/**** Supprimer une randonnée ****/
session_start();
include("database_hiking.php");

/*
- la page delete confirme la suppression d'une randonnée avec un message => echo "La randonnée a été supprimée avec succès.";
- la liste des randonnées est un tableau ($_GET['randonnee']) à parcourir => array() puis foreach() {}
- ce message ne s'affiche que SI l'utilisateur a cliqué sur "Supprimer une randonnée"
*/

if (isset($_GET['id'])) { // si l'utilisateur clique sur "Supprimer la randonnée"
	$delete = $bdd->prepare("DELETE FROM hiking WHERE id= :id"); // requête préparée pour supprimer une randonnée en particulier par son id

	$delete->execute(array('id' => $_GET['id']));
}

header('Location: http://localhost/php-training-mysql/read.php');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1> <a href="create.php"> Ajouter une nouvelle randonnée </a> <br> <br>
    <?php

      include("database.php");

      $randonnees = $bdd->query('SELECT * FROM hiking');

      $req = $bdd->prepare("INSERT INTO hiking (name, difficulty, distance, duration, height_difference, available) VALUES (?, ?, ?, ?, ?, ?)");
      $req->execute(array($_POST['name'], $_POST['difficulty'], $_POST['distance'], $_POST['duration'], $_POST['height_difference'], $_POST['available']));

      
      ?>
        
      
    <table>
      <!-- Afficher la liste des randonnées -->
      <tr>
        <th> name </th>
        <th> difficulty </th>
        <th> distance (in km) </th>
        <th> duration </th>
        <th> height_difference (in m) </th>
        <th> available </th>
      </tr>

      <?php while ($donnees = $randonnees->fetch()) { ?>
      <tr>
        <td> <?php echo $donnees['name']; ?>  </td>
        <td> <?php echo $donnees['difficulty']; ?> </td>
        <td> <?php echo $donnees['distance']; ?> </td>
        <td> <?php echo $donnees['duration']; ?> </td>
        <td> <?php echo $donnees['height_difference']; ?> </td>
        <td> <?php echo $donnees['available']; ?> </td>
        <td> <?php $modifiedhikings = array($donnees);
        foreach ($modifiedhikings as $modifiedhiking) {
          echo '<a href="update.php?id='.$donnees['id'].'"> Modifier la randonnée </a>';
        } ?>
         </td>

        <td> <?php $marches = array($donnees);

        foreach ($marches as $marche) {
           echo '<a href="delete.php?id='.$donnees['id'].'"> Supprimer la randonnée </a>';
         } ?>
           
        </td>
      </tr>
      <?php
      }

      $randonnees->closeCursor();
    ?>
    </table>
    

  </body>
</html>

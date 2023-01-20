<?php
 /*Inclusions du fichiers fonctions.php */
 require_once("fonctions.php");

 /*déclaration des variables du formulaire de cette page */
 $bntForm = "";
 $codePerm = "";
 $messageResultat = "";


//vérification s'il y a déjà eu un traitement du formulaire pour y mettre les dernières valeurs traitées
if(isset($_GET["codePerm"]))
  $codePerm = $_GET["codePerm"];

if(isset($_GET["bntForm"]))
        $messageResultat = rechercheNote($codePerm);
  
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <title>TP -Annabelle Gamache-</title>
</head>
<body>
    <header>
        <div class="nav">
          <ul>
            <li><a href="index.html">Accueil</a></li>
            <li><a href="afficheNoteParTravail.php">Note par travail</a></li>
            <li><a href="afficheNoteFinales.php">Notes finales</a></li>
            <li><a class="active" href="afficheNotesEtudiant.php">Notes d'un étudiant</a></li>
          </ul>
        </div>
      </header>
      <main>
            <h2>Recherche des notes d'un étudiant</h2>
            <hr>
            <form name="NoteEtudiant" method="GET">
              <label for="codePerm">Code permanent de l'étudiant:</label>
              <input type="text" name="codePerm" placeholder="ABCD123456" value="<?php echo $codePerm; ?>"> <br><br>
              <input type="submit" name="bntForm" value="Afficher">
            </form>
        <?= $messageResultat ?>
      </main>
      
</body>
</html>
<?php
 /*Inclusions du fichiers fonctions.php */
 require_once("fonctions.php");

 /*déclaration des variables du formulaire de cette page */
 $groupe = "" ;
 $travail = "" ;
 $bntForm = "" ;
 $messageResultat = "<h4>Veuillez choisir un groupe et un travail</h4>";


 //vérification s'il y a déjà eu un traitement du formulaire pour y mettre les dernières valeurs traitées
if(isset($_GET["groupe"]))
     $groupe = $_GET["groupe"];
if(isset($_GET["travail"]))
    $travail = $_GET["travail"];
if(isset($_GET["bntForm"])){
    if ($groupe != "" && $travail != ""){
        $messageResultat = afficheNoteParTravail($groupe, $travail);
        }else{
        $messageResultat = "<h4>Veuillez choisir au moins un groupe et un travail pour afficher le résultat</h4>";
        }
    }

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
            <li><a class="active" href="afficheNoteParTravail.php">Note par travail</a></li>
            <li><a href="afficheNoteFinales.php">Notes finales</a></li>
            <li><a href="afficheNotesEtudiant.php">Notes d'un étudiant</a></li>
          </ul>
        </div>
      </header>
      <main>
            <h2>Note par travail</h2>
            <hr>
            <form name="NoteParTravail" method="GET">
            <label for="groupe">Groupe :</label>
            <select name="groupe">
                <option value="1" <?php if($groupe == "1") echo "selected";?>>1</option>
                <option value="2" <?php if($groupe == "2") echo "selected";?>>2</option>
            </select><br>
            <label for="travail">Travail :</label>
            <select name="travail">
                <option value ="TP1" <?php if($travail == "TP1") echo "selected";?>>TP1</option>
                <option value="TP2" <?php if($travail == "TP2") echo "selected";?>>TP2</option>
                <option value ="ExamenFinal" <?php if($travail == "ExamenFinal") echo "selected";?>>Examen Final</option>
            </select><br><br>
            <input type="submit" name="bntForm" value="Afficher">
        </form>
        <?= $messageResultat ?>
      </main>
      <footer><span>Travail réalisé par Annabelle Gamache</span></footer>
</body>
</html>
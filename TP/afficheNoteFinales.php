<?php
 /*Inclusions du fichiers fonctions.php */
 require_once("fonctions.php");

 /*déclaration des variables du formulaire de cette page */
 $groupe = "" ;
 $echec = "" ;
 $sexe = "";
 $bntForm = "" ;
 $messageResultat = "<h4>Veuillez faire vos choix pour afficher le résultat</h4>";


 //vérification s'il y a déjà eu un traitement du formulaire pour y mettre les dernières valeurs traitées
if(isset($_GET["groupe"]))
     $groupe = $_GET["groupe"];
if(isset($_GET["echec"]))
    $echec = $_GET["echec"];
if(isset($_GET["sexe"]))
    $sexe = $_GET["sexe"];
if(isset($_GET["bntForm"])){
    if ($groupe != "" && $sexe != ""){
        $messageResultat = afficheNoteFinal($groupe, $echec, $sexe);
      }else{
        $messageResultat = "<h4>Veuillez choisir au moins un groupe et un genre pour afficher le résultat</h4>";
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
            <li><a href="afficheNoteParTravail.php">Note par travail</a></li>
            <li><a class="active" href="afficheNoteFinales.php">Notes finales</a></li>
            <li><a href="afficheNotesEtudiant.php">Notes d'un étudiant</a></li>
          </ul>
        </div>
      </header>
      <main>
            <h2>Note finale</h2>
            <hr>
            <form name="NoteFinal" method="GET">
            <label for="groupe">Groupe :</label>
            <select name="groupe">
                <option value="1" <?php if($groupe == "1") echo "selected";?>>1</option>
                <option value="2" <?php if($groupe == "2") echo "selected";?>>2</option>
                <option value="3" <?php if($groupe == "3") echo "selected";?>>1 et 2</option>
            </select><br>
            <label for="echec"> Afficher seulement les étudiants en situation d'échec :</label>
            <input type="checkbox" name="echec" value="echec"  <?php if($echec == "echec") echo "checked";?>><br>
            Sexe : <br>
            <input type="radio" name="sexe" value="homme" <?php if($sexe == "homme") echo "checked";?>>
            <label for="homme">Homme</label><br>
            <input type="radio" name="sexe" value="femme"<?php if($sexe == "femme") echo "checked";?>>
            <label for="femme">Femme</label><br>
            <input type="radio" name="sexe" value="deuxSexe" <?php if($sexe == "deuxSexe") echo "checked";?>>
            <label for="deuxSexe">Homme et Femme</label><br><br>
            <input type="submit" name="bntForm" value="Afficher">
        </form>
        <?= $messageResultat ?>
      </main>
      <footer><span>Travail réalisé par Annabelle Gamache</span></footer>
</body>
</html>
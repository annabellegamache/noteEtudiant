<?php
/* Fonction TrouveGroupe
      Description : 
        Fonction qui retourne le tableaua du groupe choisi par l'utilisateur
      Paramètres : 
        $classe : chaine de caractère contenant le numéro du groupe choisi.
      Valeur de retour : 
        Tableau: Le tableau du groupe.
*/
    function TrouveGroupe($numeroTableau)
    {
      /*inclure les tableaux des notes */
      require_once("variables.php");
      /* Vérification du premier paramètre pour choisir le bon tableau */
      switch($numeroTableau)
      {
        case "1":
          $tabNoteGroupe = $NotesGroupe1;
            break;
        case "2":
          $tabNoteGroupe = $NotesGroupe2;
            break; 
        case "3":
          $tabNoteGroupe = array_merge($NotesGroupe1, $NotesGroupe2);
            break;
       }
      return $tabNoteGroupe;
    }

  /* Fonction calculMoyenne($totalNote, $nbNote)
      Description : 
        Fonction qui retourne la moyenne des notes
        Paramètres :
          $totalNote : la somme des notes
          $nbNote : le nombre de notes
      Valeur de retour : 
        $moyenneNote: Nombre, la moyenne résultante arrondi au centième près
*/
    function calculMoyenne($totalNote, $nbNote)
    {
      /*declaration des variables */
      $moyenneNote = 0;
      $moyenneNote = round($totalNote/$nbNote, 2);
      return $moyenneNote;
    }
  
/* Fonction calculNoteFinal($note1, $note2, $note3)
       Description : 
        Fonction qui retourne un nombre qui est la note finale de l'étudiant
      Paramètres : 
        $note1, $note2, $note3 : note des travaux et examen de l'étudiant
      Valeur de retour : 
        $noteFin : Nombre La note finale de l'étudiant
*/
    function calculNoteFinal($note1, $note2, $note3)
    {
      /*declaration des variables */
      $noteFin= 0;
      /* Calcul de la note finale*/
      $noteTp1 = $note1 * 20 /100;
      $noteTp2 = $note2 * 40 /100;
      $noteExam = $note3 * 40 /100;
      $noteFin = $noteTp1 + $noteTp2 +$noteExam ;
      return $noteFin;
    }

 /* 
  Fonction afficheNoteParTravail
      Description : 
        Fonction qui prend en paramètres le numéro d'un groupe ainsi que le nom d'un travail. Les résultats seront affichés dans une table HTML, présentant ainsi le prénom et le nom de chaque étudiant du groupe ainsi que sa note du travail en question.
      Paramètres : 
        $classe et $travaux : chaine de caractère contenant le nuiméro du groupe et le titre du travail.
      Valeur de retour : 
        Chaine de caractère : Table HTML, présentant  le prénom et le nom de chaque étudiant du groupe ainsi que sa note du  travail en question. Il affiche également la moyenne du travail de ce groupe.
*/

  function afficheNoteParTravail($classe, $travaux)
  {
    /*déclaration des variables de la fonction */
    $tabNoteGroupe = "";
    $indiceTab="";
    $tableHTML = "<h3>Résultat</h3>
                  <table border='1'>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Note</th>
                    </tr>";
    $sommeNote = 0;

    /* Vérification du premier paramètre pour choisir le bon tableau */
    $tabNoteGroupe = TrouveGroupe($classe);

    /* Vérification du deuxième paramètre pour choisir le bon travail */
    if ($travaux == "TP1")
      $indiceTab = 4;
    if ($travaux == "TP2")
      $indiceTab = 5;
    if ($travaux == "ExamenFinal")
      $indiceTab = 6;

    /* Construction du tableau HTML en bouclant dans le tableau */  
    foreach ($tabNoteGroupe as $key => $value)
    {
      $sommeNote += $value[$indiceTab];
      $tableHTML .= "<tr>";
      $tableHTML .= "<td>{$value[0]}</td>"; 
      $tableHTML .= "<td>{$value[1]}</td>";
      $tableHTML .= "<td>{$value[$indiceTab]} %</td>";
      $tableHTML .=  "</tr>";     
    }
    /* Calcul de la moyenne */
    $moyenne = calculMoyenne($sommeNote,count($tabNoteGroupe));
    $tableHTML .=  "<tr>";
    $tableHTML .=  "<td class='moyenne' colspan ='2' >Moyenne</td>";
    $tableHTML .=  "<td>$moyenne %</td>";
    $tableHTML .=  "</table>";  
    return $tableHTML;
  }

/* Fonction afficheNoteFinal
      Description : 
        Fonction qui prend en paramètres le numéro d'un groupe ainsi que le sexe et si on veut afficher les étudiants en situation d'échec. Les résultats seront affichés dans une table HTML, présentant ainsi le prénom et le nom de chaque étudiant du groupe ainsi que sa note du travail en question.
      Paramètres : 
        $classe et $travaux : chaine de caractère contenant le nuiméro du groupe et le titre du travail.
      Valeur de retour : 
        Chaine de caractère : Table HTML, présentant  le prénom et le nom de chaque étudiant du groupe, son sexe ainsi que sa note final. Affiche également la moyenne des notes affichées.
*/

    function afficheNoteFinal($groupe, $echec, $sexe)
    {
      /*déclaration des variables de la fonction */
      $tabNoteGroupe = "";
      $fail="";
      $genre="";
      $tableHTML = "<h3>Résultat</h3>
                    <table border='1'>
                      <tr>
                          <th>Prénom</th>
                          <th>Nom</th>
                          <th>Sexe</th>
                          <th>Note finale</th>
                      </tr>";
      $sommeNote = 0;
      $nombreEtudiant = 0;
      $connstruitTable= false;
  
      /* Vérification du premier paramètre pour choisir le bon tableau */
      $tabNoteGroupe = TrouveGroupe($groupe);
  
      /* Vérification du deuxième paramètre pour afficher les étudiants en situation d'échec ou pas */
      if(isset($_GET["echec"]))
        $fail= true;
      

      /* Vérification du troisième paramètre pour afficher les étudiants selon le genre choisi*/
        switch($sexe)
        {
          case "homme":
              $genre="M";
              break;
          case "femme":
              $genre="F";
              break; 
          case "deuxSexe":
              $genre="2";
              break;
         }

  
      /* Construction du tableau HTML en bouclant dans le tableau */  
      foreach ($tabNoteGroupe as $key => $value)
      {
        $noteFinale = calculNoteFinal($value[4], $value[5], $value[6]);
        if ($fail && $noteFinale < 60 ){
          if ($value[2] == $genre){
            $connstruitTable = true;
            $nombreEtudiant += 1;
          }else if ($genre == "2" ){
            $connstruitTable = true;
            $nombreEtudiant += 1;
          } ; 
        }else if($fail==false){
          if ($value[2] == $genre){
            $connstruitTable = true;
            $nombreEtudiant += 1;
          }else if ($genre == "2" ){
            $connstruitTable = true;
            $nombreEtudiant += 1;
          } ; 
        };
        if ($connstruitTable){
          $tableHTML .= "<tr>";
          $tableHTML .= "<td>{$value[0]}</td>"; 
          $tableHTML .= "<td>{$value[1]}</td>";
          $tableHTML .= "<td>{$value[2]}</td>";
          $tableHTML .= "<td>$noteFinale %</td>";
          $sommeNote += $noteFinale;
          $tableHTML .=  "</tr>";
          $connstruitTable = false;
        }
      }
      if($nombreEtudiant>0){
        $moyenne = calculMoyenne($sommeNote,$nombreEtudiant);
        $tableHTML .=  "<tr>";
        $tableHTML .=  "<td class='moyenne' colspan ='3' >Moyenne</td>";
        $tableHTML .=  "<td>$moyenne %</td>";
        $tableHTML .=  "</table>"; 
      }else{
        $tableHTML= "Il y a aucun étudiants avec les paramètres choisies";
      }
      return $tableHTML;
    }

/* Fonction rechercheNote($code)
      Description : 
        Fonction qui prend en paramètres la saisi de l'utilisateur et vérifie si le format du code permanent entrer est valide 
      Paramètre:
        $code  : chaine de caractère entrer par l'utilisateur.
      Valeur de retour : 
        $message Chaine de caractère : message d'erreur ou Table HTML, présentant  le prénom et le nom de l'étudiant ainsi que ses notes par travail et sa note finale.
*/
   
  function rechercheNote($code)
  {
    /*déclaration des variables de la fonction */
    $valide = false;
    $message = "";
    /*merge des 2 tableaux */
    $tabNoteGroupe = TrouveGroupe(3);
    $tableHTML = "<h3>Résultat</h3>
                    <table border='1'>
                      <tr>
                          <th>Prénom</th>
                          <th>Nom</th>
                          <th>TP1</th>
                          <th>TP2</th>
                          <th>Examen</th>
                          <th>Note finale</th>
                      </tr>";
    $trouve = false;
    
    /* Vérification du code entrer par l'utilisateur */
    if (preg_match('/^([A-Z]{4}[0-9]{6})$/', $code, $matches, PREG_UNMATCHED_AS_NULL))
      $valide = true;
    else
      $valide = false;

      


    if(!$valide)
      $msg = "Veuillez entrer un code valide. <br> 
              Un code permanant comporte 4 lettres en majuscule <br>
              Suivi de 6 chiffres sans espace <br>
              exemple: ABCDE123456";
    
    if($valide){
      /*Vérification si le code permanent est lié à un étudiant dans le tableau*/
      
      foreach ($tabNoteGroupe as $cle => $valeur)
      {
        if($cle == $code){
            $noteFinale = calculNoteFinal($valeur[4], $valeur[5], $valeur[6]);
            $tableHTML .= "<tr>";
            $tableHTML .= "<td>{$valeur[0]}</td>"; 
            $tableHTML .= "<td>{$valeur[1]}</td>";
            $tableHTML .= "<td>{$valeur[4]} %</td>";
            $tableHTML .= "<td>{$valeur[5]} %</td>";
            $tableHTML .= "<td>{$valeur[6]} %</td>";
            $tableHTML .= "<td>$noteFinale %</td>";
            $tableHTML .=  "</tr>";
            $trouve = true;
            $msg = $tableHTML;
        }
        if ($trouve == false)
          $msg = "Il y a aucun étudiants correspondant à ce code permanant dans nos dossiers";
      }
    }
      

    return $msg;
  }
  


   ?>
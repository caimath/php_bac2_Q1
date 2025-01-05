<?php

// Vérifier les valeurs du formulaire
if ( isset($_POST['enregistrement']) ) {

    // Valider si regex est bon pour le pseudo
    if (!empty($_POST["pseudo"])  && preg_match('/^[a-zA-Z0-9\-_\.]+$/', $_POST['pseudo'])) {
        $pseudo = trim(htmlspecialchars($_POST['pseudo']));
    } else {
        $erreurs['pseudo'] = true;
    }
   

    // une liste blanche pour tester les appreciations
    $LBAppreciation = array('mauvais', 'moyen', 'bon', 'tres_bon');
    if (in_array($_POST['appreciation'],$LBAppreciation)){
        $appreciation = $_POST['appreciation'];
    } else { $erreurs['appreciation'] = True; 
    }
    
    // Vérifier si le mail est valide avec regex
    if (!empty($_POST['mail']) && preg_match('/^[a-zA-Z0-9\-_\.]+@[a-zA-Z0-9\-_\.]+\.[a-zA-Z]{2,5}$/', $_POST['mail'])) {
        $mail = trim(htmlspecialchars($_POST['mail']));
    } else {
        $erreurs['mail'] = true;
    }


    //s'il n'y a pas d'erreur...
    if (empty($erreurs)) {
        //le formulaire est correctement complété
        $form_correct = True;
    }
}

// Enregistrer dans fichiers les avis
if (!empty($form_correct)) {
    if (!empty($_POST['commentaire'])) {
        $donnees = $pseudo . " " . $mail . "\n" . "Appréciation : " . $appreciation . "\n" . "Commentaire : " . $_POST['commentaire'] . "\n" . "***************************" . "\n";
        $fichier = fopen('avis_fichier.txt', 'a+');
        fputs($fichier, $donnees);
        fclose($fichier);
    } else {
        $donnees = $pseudo . " " . $mail . "\n" . "Appréciation : " . $appreciation . "\n" . "***************************" . "\n";
        $fichier = fopen('avis_fichier.txt', 'a+');
        fputs($fichier, $donnees);
        fclose($fichier);
    }
    
}


   
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EX10_formulaire avec fichier plat</title>
</head>
<body>
    <h1>Exo 10</h1>

    <!-- test de code mais pas besoin pour le code final
    // if (!empty($form_correct)) {
    //     echo $appreciation . "<br>";
    //     echo $pseudo . "<br>";
    // } 
    -->

    <form action="index.php" method="post">
        <fieldset>
            <select name="appreciation">
                <option value="mauvais" selected> mauvais
                <option value="moyen"> moyen
                <option value="bon"> bon
                <option value="tres_bon"> très bon
            </select>

            <br><br>
            <label for="commentaire">Commentaire:<br>
                <textarea type="text" name="commentaire" id="commentaire"></textarea>
            </label>
            <br>

            <label for="pseudo">Pseudo:<br>
                <input type="texte" name="pseudo" id="pseudo" required>
            </label><br>

            <label for="mail">Mail:<br>
                <input type="email" name="mail" id="mail" required>
            </label>

            <br><br>
            <input type="submit" name="enregistrement" value="enregistrement">
        </fieldset>
    </form>

    <?php
    if (!empty("avis_fichier.txt")) {
        $fichier_affichage = fopen('avis_fichier.txt', 'r');
        $contenu = file_get_contents('avis_fichier.txt');
        $contenu_transfo = str_replace("\n","<br>",$contenu);
        echo $contenu_transfo;
        fclose($fichier_affichage);
    }
    ?>

</body>
</html>
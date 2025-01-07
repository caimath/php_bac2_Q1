<?php
include_once('_connexionBD.php');

// 10 resto, activité, min 1employé, pays, ville, nom, description, ordonné ordre alphabé.
$reqResto= $bd->query('SELECT r.nom AS nom_restau, r.description, v.ville, e.manager, v.code_pays, GROUP_CONCAT(e.nom) AS travailleur, e.id_restaurant
    FROM restaurants r 
    LEFT JOIN villes v on v.id_ville=r.id_ville
    LEFT JOIN employes e on e.id_restaurant=r.id_restaurant
    WHERE r.ouvert=1 AND e.travail_encore>=1
    GROUP BY r.id_restaurant
    ORDER BY r.nom ASC
    LIMIT 10;
');
// cette requête ne comprends pas encore les images des managers,pays,employé on verra après


// requete etape 2
// liste resto, min 1 employé, en activité, ordre alphabé
$reqListeResto= $bd->query('SELECT r.nom , r.id_restaurant, count(e.nom) AS nbr_employe 
    FROM restaurants r
    RIGHT JOIN employes e ON r.id_restaurant = e.id_restaurant
    WHERE r.ouvert = 1 AND e.travail_encore = 1
    GROUP BY r.nom
    HAVING nbr_employe > 0
    ORDER BY r.nom ASC');


//code robin etape 2

// Si valeur dans get_employe: $valeur= get_employe
if (isset($_GET['employe'])){
    $valeur = $_GET['employe'];

    // requete préparée pour éviter l'injection SQL
    $req_employe = $bd->prepare('SELECT e.nom, e.prenom, e.manager, COALESCE(SUM(v.nombre * b.prix), 0) AS chiffre_affaires
    FROM employes e
    LEFT JOIN commandes c ON e.id_employe = c.id_employe
    LEFT JOIN ventes v ON c.id_commande = v.id_commande
    LEFT JOIN burgers b ON v.id_burger = b.id_burger
    LEFT JOIN restaurants r ON e.id_restaurant = r.id_restaurant
    WHERE r.id_restaurant = :id AND e.travail_encore = 1
    GROUP BY e.id_employe
    ORDER BY e.nom ASC');
    // Se sert de id pour chercher les valeurs
    $req_employe->bindValue(':id', $valeur);
    $req_employe->execute();

}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exo2ExamBLancBurger</title>
</head>
<style> 
    a {
        text-decoration: none;
        color: black;
    }
</style>

<body>
    <h1>Exam BDD</h1>
    <h2>Restaurants</h2>
    <ol>
        <?php
        $count = 0 ;// compteur pour mon bold
        while($resto=$reqResto->fetch()) {
            $count++; // incré compteur bold

            echo '<li>:<img src="flags/'.$resto['code_pays'].'" alt="">';
            echo $resto['ville'].': ';
            
            // Bold pour les 3 premiers restau
            if ($count <=3 ) {
                echo '<a href="?employe='.$resto['id_restaurant'].'"><strong>' . $resto['nom_restau'] . '</strong></a>';
            } else {
                echo '<a href="?employe='.$resto['id_restaurant'].'">' . $resto['nom_restau'] . '</a>' ;
            }

            echo '<br>'.$resto['description'].'<br><br>';
            
            // Code de robin pour les icones des manageurs car pas capté et pas le temps d'essayer de capter
            $travailleurs = explode(',', $resto['travailleur']);
            $manager_count = $resto['manager'];
            $total_employes = count($travailleurs);
            for ($j = 0; $j < $total_employes; $j++) {
                if ($manager_count > 0) {
                    echo '<img src="icones/manager.png" alt="" width="30">';
                    $manager_count -= 1;
                } else {
                    echo '<img src="icones/employe.png" alt="" width="30">';
                }
            }

            echo '<br>';
        }
        ?>
    </ol>

    <!-- Création d'un formulaire pour l'étape 2 -->
    <form action="index.php" method="get">
        <select name="employe">
            <?php
             while($restoListeEmploye=$reqListeResto->fetch()) {
                $selected = (isset($valeur) && $restoListeEmploye['id_restaurant'] == $valeur)?'selected' : '';
                echo '<option value="'.$restoListeEmploye['id_restaurant'].'"'.$selected.'>'.$restoListeEmploye['nom'].'</option>' ;
               
            } 
            ?>

        </select>
        <button type="submit" name="enregistrement">Voir les employés</button>
    </form>

    <?php
    
        
    if (isset($req_employe)) {
        while ($travail = $req_employe->fetch()){
            if ($travail['manager'] == 1){
                echo '<p><b>'.$travail['nom'].' - '.$travail['prenom'].'</b> : '.$travail['chiffre_affaires'].' €</p>';
            } else {
                echo '<p>'.$travail['nom'].' - '.$travail['prenom'].' : '.$travail['chiffre_affaires'].' €</p>';
            }
        }
    }
    ?>
        
    


    
</body>
</html>
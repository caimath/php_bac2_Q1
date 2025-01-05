<?php 
date_default_timezone_set('Europe/Brussels'); //Fuseau horaire
$jours = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
$mois = array(1 => 'janvier', 2 => 'février', 3 => 'mars', 4 => 'avril', 5 => 'mai', 6 => 'juin', 7 => 'juillet', 8 => 'août', 9 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'décembre');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Jours avant le weekend</title>
</head>
<body>
	<h1>Vivement le weekend !</h1>
	<?php 
	//Calcul du nombre de jours restant avant samedi
	$joursAvantWE = max( 6 - date('w') ,0);
	
	
	//Affichage
	echo '<p>Vivement ',$jours[6],' !</p>'; 
	echo '<p>Nous sommes ',$jours[date('w')],'... plus que ',$joursAvantWE,' jours avant ',$jours[6],'.</p>'; 
	echo '<p>Nous sommes le ',$jours[date('w')],', ','le ',date('j'),' ',$mois[date('n')],' ',date('Y'),', ',date('G'),'h',date('i'),'</p>';

	// Date de naissance
	$dateNaissance = strtotime('2005-09-27 00:00:00'); // obtenir timestamp de la date de naissance

	// Date actuelle
	$dateActuelle = time();

	// Calcul du nombre de secondes écoulées
	$secondesEcoulees = $dateActuelle - $dateNaissance;

	// Calcul du nombre de jours écoulés
	$joursEcoules = $secondesEcoulees / (60 * 60 * 24);
	// ou $nb_sec = time()-mktime(0,0,0,9,27,2005);
	// Puis number_format($nb_sec/60/60/24)

	// Affichage
	echo '<p>Il s\'est écoulé ' . $secondesEcoulees . ' secondes depuis votre naissance.</p>';
	echo '<p>Il s\'est écoulé ' . $joursEcoules . ' jours depuis votre naissance.</p>';

	?>

</body>
</html>
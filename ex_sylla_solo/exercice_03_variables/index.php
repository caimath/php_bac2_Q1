<?php  
$taux_USD = 0.884 ;
$taux_GBP = 1.225 ;
$taux_SEK = 0.096 ;
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Opérations sur les variables</title>
</head>
<body>
	<?php 
	$prix_EUR = 18.50 ;
	echo '<p>Prix en euros: ', number_format($prix_EUR,2,","),' € </p>' ;

	$taux_GBP_EUR = number_format(($prix_EUR / $taux_GBP),2,",") ;
	echo '<p>Prix en livres sterling: ', $taux_GBP_EUR,' £ </p>' ;

	$taux_SEK_EUR = number_format(($prix_EUR / $taux_SEK), 2, ",") ;
	echo '<p>Prix en couronnes suédoises: ', $taux_SEK_EUR,' kr </p>' ;

	$taux_USD_EUR = $prix_EUR / $taux_USD ;
	$taux_USD_EUR_decimal = number_format($taux_USD_EUR, 2, ",") ;
	echo '<p>Prix en dollar: ', $taux_USD_EUR_decimal,' $ </p>' ;

	?>
</body>
</html>
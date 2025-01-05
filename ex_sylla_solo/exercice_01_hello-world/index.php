<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Hello World</title>
</head>
<body>
	<?php 
	echo '<h1>Hello World</h1>'; 

	// test pour voir avec echo et les tableaux associatifs
	$tab['an'] = 2020 ;
	$tab[0] = 2021;
	echo 'Nous sommes en ',$tab['an'], ' Bonne année la famax';
	echo "<br>";
	echo "nous sommes en {$tab['an']} Bonne année la famax"; 
	echo "<br>";
	echo date('j/n/Y', mktime(16, 14, 0, 2, 15, 2017));
	foreach ($_SERVER as $valeur) {
		echo '<p>',$valeur,'</p>';
	   }
	?>
</body>
</html>
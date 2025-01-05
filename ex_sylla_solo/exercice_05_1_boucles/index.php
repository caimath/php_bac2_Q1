<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tirages du Lotto</title>
	<style>
	table {text-align:center;}
	table td {border:1px solid #000; padding:0.25rem;}
	</style>
</head>
<body>
	<h1>Tirages du Lotto</h1>
	
	<?php 

	$nb_tirages = rand(4,10) ;

	for ($tirage=1 ; $tirage<=$nb_tirages ; $tirage++) {
		for ($i=0 ; $i<6 ; $i++) {
			$numeros[$tirage][$i] = rand(1,50);
		}
	}
	?>

	<table>
		<?php 
			
			// Je récupère les clés du nombre de tirage, pour faire une boucle qui pour chaque clé, fais une <tr>
			foreach ($numeros as $tirage => $numeros_tirages) {
				echo '<tr>';

				// Pour chaque tirage, je récupère la clé et la valeur(aléatoire de 1 à 50) et je fais un <td> pour faire un élément de tableau avec la valeur
				foreach ($numeros_tirages as $i) {
					echo '<td>',$i,'</td>';
				}
				echo '</tr>';
			}


		?>

	</table>


</body>
</html>
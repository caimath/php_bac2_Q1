<?php
//valeur par défaut si pas de paramètre GET
$page = 1 ;	
//récupération du paramètre GET s'il existe et conversion (int) pour sécurité
if (isset($_GET['page'])) $page = (int) $_GET['page'] ;

if ($page < 0 or $page > 3) {
	$page = 1 ;
	header('Location: index.php?page=1') ; }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Paramètres GET</title>
</head>
<body>
	<h1>Page <?php echo $page ; ?>/3</h1>
	<nav>
		<ul>
			<li><a href="index.php?page=1">Page 1</a>
			<li><a href="index.php?page=2">Page 2</a>
			<li><a href="index.php?page=3">Page 3</a>
			<?php 
			
			echo '<li><a href="index.php?page=', $page + 1,'">Page suivante</a></li>';
			if ($page > 3) {
				header('location: index.php?page=1');
			}
			echo '<li><a href="index.php?page=', $page - 1,'">Page précédente</a></li>';
			if ($page == 0) {
				$page = 3;
				header('location: index.php?page=3');
			}
				
			?>
		</ul>
	</nav>
</body>
</html>
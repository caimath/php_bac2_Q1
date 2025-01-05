<?php
session_start();	//démarrage de la session
//si le formulaire a été soumis...


if ( isset($_POST['connexion']) ) {
	//on réceptionne, on trime les chaînes et on hache le mot de passe
	$login = trim($_POST['login']) ;
	$password = SHA1( trim($_POST['password']) ) ;
	
	//si le login et le mot de passe (bill) sont bons... 
	if ( $login=='bill' and $password=='c692d6a10598e0a801576fdd4ecf3c37e45bfbc4') { 
		$_SESSION['nom']='Bill';	//on enregistre en SESSION
		$_SESSION['titre']='Monsieur'; //ajouter titre pour bill
		$_SESSION['admin']=True ; //ajouter bill en admin
		header('Location:index.php');	//on redirige pour vider $_POST
		exit();
	}

	//si le login et le mot de passe (bob) sont bons...
	if ($login=='bob' and $password=='48181acd22b3edaebc8a447868a7df7ce629920a') {
		$_SESSION['nom']='Bob';	//on enregistre en SESSION
		$_SESSION['titre']='Monsieur'; //ajouter titre pour bob
		$_SESSION['admin']=False ; //ajouter bob en non admin
		header('Location:index.php');	//on redirige pour vider $_POST
		exit();
	}

	//si le login et le mot de passe (betty) sont bons...
	if ($login=='betty' and $password=='5a7a28625bd1f84b38c576bcc0ee78ae9b4eae6b') {
		$_SESSION['nom']='Betty';	//on enregistre en SESSION
		$_SESSION['titre']='Madame'; //ajouter titre pour betty
		$_SESSION['admin']=True ; //ajouter betty en non admin
		header('Location:index.php');	//on redirige pour vider $_POST
		exit();
	
	}


} 
else if ( isset($_POST['deconnexion']) ) {
	session_destroy() ;		//on détruit la session
	header('Location:index.php');	//on redirige pour vers index.php pour pas devoir déco 2 fois
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Formulaire de connexion</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	if ( empty($_SESSION) ) {
		?>
		
		<form method="post" action="index.php">
			<p><label for="login">Identifiant :<br> 
				<input type="text" name="login" id="login">
			</label>
			<p><label for="password">Mot de passe :<br> 
				<input type="password" name="password" id="password">
			</label>
			<p><input type="submit" name="connexion" value="Connexion">
		</form>
		<?php
	}
	else {
		?>
		
		
		<?php	

		// page pour admin
		if ($_SESSION['admin']==True) {
			echo '<p>Bonjour ', $_SESSION['titre'],' ', $_SESSION['nom'],'</p>';
		}

		// page pour non admin
		else {
			echo '<p>Bonjour ', $_SESSION['nom'],'</p>';
		}

		?>
				
		<form method="post" action="index.php">
			<p><input type="submit" name="deconnexion" value="Déconnexion">
		</form>
		<?php
	}
	?>
</body>
</html>

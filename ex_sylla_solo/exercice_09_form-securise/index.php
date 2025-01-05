<?php
//Une liste de fruits et un choix par défaut
$liste_fruits = array('banane', 'framboise', 'kiwi', 'pomme','prout');
$fruit = $liste_fruits[0];
$titre = '';
$conditionsApprouve = '';
	
if ( isset($_POST['enregistrement']) ) {
	//Le nom : un champ obligatoire
	if ( !empty($_POST['nom']) ) $nom = $_POST['nom'] ;
	else $erreurs['nom'] = true;
	
	//L'année : un champ obligatoire avec certaines valeurs rejetées
	$annee = (int) $_POST['annee'];
	
	//Le fruit préféré : liste de sélection
	if (in_array($_POST['fruit'], $liste_fruits)) {
		$fruit = $_POST['fruit'] ;
	} else {
		$erreurs['fruit'] = true;
	}

	// sauvergarder pseudo
	if (!empty($_POST['pseudo'])) {
		$pseudo = $_POST['pseudo'];
	}

	// Sauvegarder le titre
	if (!empty($_POST['titre']) && ($_POST['titre'] == 'H' || $_POST['titre'] == 'F')) {
		$titre = $_POST['titre'];
	}

	// Sauvegarder les conditions
	if (!empty($_POST['conditions']) && $_POST['conditions'] == 'ok') {
		$conditionsApprouve = $_POST['conditions'];
	} else {
		$erreurs['conditions'] = true;
	}
	
	//s'il n'y a aucune erreur...
	if (empty($erreurs)) { 
		$form_correct = True;
	}
}
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Formulaire avec gestion des erreurs</title>
	<style>
	.red { color:red; }
	</style>
</head>
<body>
	<h1>Inscription</h1>
	
	<?php
	//Affichage des résultats du formulaire
	if ( !empty($form_correct) ) {
		echo "<p>Bonjour $nom,";
		echo "vous êtes né en $annee et ";
		echo "votre fruit préféré est : $fruit</p>";
		echo "Votre pseudo est : $pseudo", "<br>";
		echo "Votre titre est : $titre";
	}
	?>
	
	<form method="post" action="index.php" autocomplete="off">
	
		<p <?php if ( isset($erreurs['nom']) ) echo 'class="red"'; ?>>
			<label for="nom">Nom :<br> 
				<input type="text" id="nom" name="nom" value="<?php if (isset($nom)) echo $nom; ?>" required>
			</label>
			
		<p <?php if ( isset($erreurs['annee']) ) echo 'class="red"'; ?>>
			<label for="annee">Année de naissance :<br> 
				<input type="number" id="annee" name="annee" step="1" min="1900" max="<?= date('Y') ?>" value="<?php if (isset($annee)) echo $annee; ?>">
			</label>
		
		<p <?php if ( isset($erreurs['fruit']) ) echo 'class="red"'; ?>>
			<label for="fruit">Fruit préféré :<br> 
				<select id="fruit" name="fruit">
					<?php
					foreach ($liste_fruits as $f) {
						echo '<option value="',$f,'" ', ($fruit==$f)?'selected':'' ,'>',$f;
					}
					?>
				</select>
			</label>
		
		<p><label for="pseudo">Pseudo : <br>
				<input type="text" id="pseudo" name="pseudo" value="<?php if (isset($pseudo)) echo $pseudo; ?>">
			</label>
		</p>
		
		<p>Titre: <br>
				<label><input type="radio" name="titre" value="H" checked>Mr</label>
				<label><input type="radio" name="titre" value="F" <?=($titre=='F')?'checked':''?>>Mme</label>
		</p>
			
		<?php if ( isset($erreurs['conditions']) ) echo '<p class="red">Vous devez accepter les conditions d\'utilisation</p>'; ?>
		<p><label><input type="checkbox" name="conditions" value="ok" <?=($conditionsApprouve=='ok')?'checked':''?> required>J’ai lu et j’approuve les conditions d’utilisation.</label></p>

		<p><input type="submit" name="enregistrement" value="Enregistrer">
		
	</form>
</body>
</html>
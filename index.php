<!DOCTYPE html>
<html lang="fr" xml:lang="fr">
<?php
include 'global/init.php'; // Initialisation
include'global/head.php'; //header
?>
<body>
<?php 
	// Début de la tamporisation de sortie
	ob_start();
	// Si un module est specifié, on regarde s'il existe
	if (!empty($_GET['module'])) {
		$module = dirname(__FILE__).'/modules/'.$_GET['module'].'/';
	
		// Si l'action est specifiée, on l'utilise, sinon, on tente une action par défaut
		$action = (!empty($_GET['action'])) ? $_GET['action'].'.php' : 'index.php';
	
		// Si l'action existe, on l'exécute
		if (is_file($module.$action)) {
			include $module.$action;

		// Sinon, on affiche la page d'accueil !
		} else {
			include 'global/section.php';
		}

	// Module non specifié ou invalide ? On affiche la page d'accueil !
	} else {
		include 'global/section.php';
	}

	// Fin de la tamporisation de sortie
	$contenu = ob_get_clean();

	// Début du code HTML
		//nav
	include 'global/nav.php';
		//section
	echo $contenu;
		//footer
	include 'global/footer.php';
?>
</body>

</html>
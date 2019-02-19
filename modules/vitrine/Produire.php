<?php
unset($_SESSION['point']);
require_once CHEMIN_MODELE.'commerce.php';
if (!utilisateur_est_connecte() or $_SESSION['utilisateur']['libelleRole'] != "producteur") {

	include 'global/section.php';
} 
else
{
	$idUser = $_SESSION['utilisateur']['idUser'];
	$idProducteur = chargerIdProducteur($idUser);
	$rayons=chargerRayons();
	$modeProductions = chargerModeProduction($idProducteur);
	$parcelles = cargerParcelles($idProducteur);
	if(isset($_POST['monProduit']))
	{
		$poids_max = 512000; // Poids max de l'image en octets (1Ko = 1024 octets)
		$repertoire = 'img/produit/'; // Repertoire d'upload

		if (isset($_FILES['fichier']))
		{

		   // On vérifit le type du fichier
			if ($_FILES['fichier']['type'] != 'image/png' && $_FILES['fichier']['type'] != 'image/jpeg' && $_FILES['fichier']['type'] != 'image/jpg' && $_FILES['fichier']['type'] != 'image/gif')
			{
				$erreur = 'Le fichier doit être au format *.jpeg, *.gif ou *.png ';
			}

		   // On vérifit le poids de l'image
			elseif ($_FILES['fichier']['size'] > $poids_max)
			{
				$erreur = 'L\'image doit être inférieur à ' . $poids_max/1024 . 'Ko.';
			}

		   // On vérifit si le répertoire d'upload existe
			elseif (!file_exists($repertoire))
			{
				$erreur = 'Erreur, le dossier d\'upload n\'existe pas.';     
			}

		   // Si il y a une erreur on l'affiche sinon on peut uploader
			if(isset($erreur))
			{
				echo '' . $erreur . '<br><a href="javascript:history.back(1)">Retour</a>';
			}
			else
			{

		      // On définit l'extention du fichier puis on le nomme par le timestamp actuel
				if ($_FILES['fichier']['type'] == 'image/jpeg') { $extention = '.jpeg'; }
				if ($_FILES['fichier']['type'] == 'image/jpeg') { $extention = '.jpg'; }
				if ($_FILES['fichier']['type'] == 'image/png') { $extention = '.png'; }
				if ($_FILES['fichier']['type'] == 'image/gif') { $extention = '.gif'; }
				$nom_fichier = time().$extention;

				$cheminPhoto = $nom_fichier;
				$idRayon = $_POST['monRayon'];
				$nomProduit = $_POST['monProduit'];

				$ajout_produit= ajout_produit($idRayon, $nomProduit, $cheminPhoto);

				if($ajout_produit)
				{     
			      // On upload le fichier sur le serveur.
					if (move_uploaded_file($_FILES['fichier']['tmp_name'], $repertoire.$nom_fichier))
					{
						$url = 'http://petersonr.hol.es/newWorld/'.$repertoire.''.$nom_fichier.'';
						echo 'Votre image à été uploadée sur le serveur avec succes!<br>Voici le lien: <input type="text" value="' . $url . '" size="60">';


					}
					else
					{
						echo 'L\'image n\'a pas pu être uploadée sur le serveur.';
					}
				}
				else
				{
					echo 'Un produit avec un nom identique existe déjà dans ce rayon';  
				}
			}
		}


	}
	else
	{
		$form = true;
	}



	if(isset($_POST['maVariete']))
	{
		$poids_max = 512000; // Poids max de l'image en octets (1Ko = 1024 octets)
		$repertoire = 'img/variete/'; // Repertoire d'upload

		if (isset($_FILES['fichier']))
		{

		   // On vérifit le type du fichier
			if ($_FILES['fichier']['type'] != 'image/png' && $_FILES['fichier']['type'] != 'image/jpeg' && $_FILES['fichier']['type'] != 'image/jpg' && $_FILES['fichier']['type'] != 'image/gif')
			{
				$erreur = 'Le fichier doit être au format *.jpeg, *.gif ou *.png ';
			}

		   // On vérifit le poids de l'image
			elseif ($_FILES['fichier']['size'] > $poids_max)
			{
				$erreur = 'L\'image doit être inférieur à ' . $poids_max/1024 . 'Ko.';
			}

		   // On vérifit si le répertoire d'upload existe
			elseif (!file_exists($repertoire))
			{
				$erreur = 'Erreur, le dossier d\'upload n\'existe pas.';     
			}

		   // Si il y a une erreur on l'affiche sinon on peut uploader
			if(isset($erreur))
			{
				echo '' . $erreur . '<br><a href="javascript:history.back(1)">Retour</a>';
			}
			else
			{

		      // On définit l'extention du fichier puis on le nomme par le timestamp actuel
				if ($_FILES['fichier']['type'] == 'image/jpeg') { $extention = '.jpeg'; }
				if ($_FILES['fichier']['type'] == 'image/jpeg') { $extention = '.jpg'; }
				if ($_FILES['fichier']['type'] == 'image/png') { $extention = '.png'; }
				if ($_FILES['fichier']['type'] == 'image/gif') { $extention = '.gif'; }
				$nom_fichier = time().$extention;

				$cheminPhoto = $repertoire.$nom_fichier;
				$idProduit = $_POST['produit'];
				$nomVariete = $_POST['maVariete'];

				$ajout_variete= ajout_variete($idProduit, $nomVariete, $cheminPhoto);

				if($ajout_variete)
				{     
			      // On upload le fichier sur le serveur.
					if (move_uploaded_file($_FILES['fichier']['tmp_name'], $repertoire.$nom_fichier))
					{
						$url = 'http://petersonr.hol.es/newWorld/'.$repertoire.''.$nom_fichier.'';
						echo 'Votre image à été uploadée sur le serveur avec succes!<br>Voici le lien: <input type="text" value="' . $url . '" size="60">';


					}
					else
					{
						echo 'L\'image n\'a pas pu être uploadée sur le serveur.';
					}
				}
				else
				{
					echo 'Une variete avec un nom identique existe déjà dans pour ce produit';  
				}
			}
		}

	}
	else
	{
		$form = true;
	}


	if (isset($_POST['description']))
	{
		$idVariete = $_POST['mavariete'];
		$idParcelle = $_POST['parcelle'];
		$quantite = $_POST['quantite'];
		$unite = $_POST['unite'];
		$prix = $_POST['prix'];
		$description = $_POST['description'];
		$dateRecolte = $_POST['dateRecolte'];
		$dateLimite = $_POST['dateLimite'];
		// Ou encore
		$dateRecolte_fr = $_POST['dateRecolte'];
		$dateRecolte_us = date('Y-m-d', strtotime(str_replace('/', '-', $dateRecolte_fr)));

// Ou encore
		$dateLimite_fr = $_POST['dateLimite'];
		$dateLimite_us = date('Y-m-d', strtotime(str_replace('/', '-', $dateLimite_fr)));

		$creation_lot = creation_lot($idProducteur, $idVariete, $idParcelle, $quantite, $unite, $prix, $description, $dateRecolte_us, $dateLimite_us);
		if ($creation_lot)
		{
			$message_succes = " Cette parcelle a bien été enregistrée";
			$_SESSION['messageForm']= $message_succes;
			include CHEMIN_VUE.'message_succes.php';
			include CHEMIN_VUE.'gestion_production.php';

		}
		else
		{
			$form = true;
			$message_erreurs = "La parcelle n'a pas pût être enregistrée, veuillez contacter un administrateur.";
		}

	}
	else
	{
		$form = true;
	}



	if(isset($_POST['modeProduction']))
	{
		$latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];
		$commune= $_POST['ville'];
		$production= $_POST['modeProduction'];
		$ajout_effectue= creation_parcelle($idProducteur, $commune, $latitude, $longitude, $production);
		if ($ajout_effectue) {
			$message_succes = " Cette parcelle a bien été enregistrée";
			$_SESSION['messageForm']= $message_succes;
			include CHEMIN_VUE.'message_succes.php';
			include CHEMIN_VUE.'gestion_production.php';

		}
		else
		{
			$form = true;
			$message_erreurs = "La parcelle n'a pas pût être enregistrée, veuillez contacter un administrateur.";
		}

	}
	else
	{
		$form = true;
	}

}

if($form) {
		//On affiche un message sil y a lieu
	if(isset($message_erreurs))
	{
		$_SESSION['messageForm']= $message_erreurs;
		include CHEMIN_VUE.'message_erreurs.php';
	}
	include CHEMIN_VUE.'gestion_production.php';
}
?>

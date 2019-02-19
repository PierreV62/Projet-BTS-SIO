<?php
require_once CHEMIN_MODELE.'commerce.php';
if (!utilisateur_est_connecte()) {

	include 'global/section.php';	
} 
else 
{
	$rayons=chargerRayons();

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
		
		$cheminPhoto = $repertoire.time();
		$idRayon = $_POST['monRayon'];
		$nomProduit = $_POST['monProduit'];

		$ajout_produit= ajout_produit($idRayon, $nomProduit, $cheminPhoto);

		if($ajout_produit)
		{     
	      // On upload le fichier sur le serveur.
			if (move_uploaded_file($_FILES['fichier']['tmp_name'], $repertoire.$nom_fichier))
			{
				$url = 'www.monsite.com/'.$repertoire.''.$nom_fichier.'';
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

<?php

require_once CHEMIN_MODELE.'commerce.php';
	
	$idUser = $_SESSION['utilisateur']['idUser'];
	$rayons=chargerRayons();
	if(isset($_POST['rayon']))
	{
		$leRayon = $_POST['rayon'];
	}
	else
	{
		$leRayon="-1";
	}
	if(isset($_POST['produit']))
	{
		$leProduit = $_POST['produit'];
	}
	else
	{
		$leProduit="-1";
	}
	if(isset($_POST['variete']))
	{
		$laVariete = $_POST['variete'];
	}
	else
	{
		$laVariete="-1";
	}
	if(isset($_POST['producteur']))
	{
		$leProducteur = $_POST['producteur'];
	}
	else
	{
		$leProducteur="-1";
	}
	if(isset($_POST['pointDeVente']))
	{
		$lePointDeVente = $_POST['pointDeVente'];
	}
	else
	{
		$lePointDeVente="-1";
	}
	$compteLots = compterLots($idUser, $leRayon, $leProduit, $laVariete, $lePointDeVente, $leProducteur);
	$nbLots = count($compteLots);
	$lotsParPage= 8;
	$nombreDePages=ceil($nbLots/$lotsParPage);


	if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
	{
	     $pageActuelle=$_GET['page'];
	 
	     if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
	     {
	          $pageActuelle=$nombreDePages;
	     }
	}
	else // Sinon
	{
	     $pageActuelle=1; // La page actuelle est la n°1    
	}

	$premiereEntree=($pageActuelle - 1)*$lotsParPage; // On calcul la première entrée à lire
	
	if($premiereEntree <0)
	{
		$premiereEntree=0;
	}
	
	$lesLots = chargerLots($idUser, $premiereEntree, $lotsParPage, $leRayon, $leProduit, $laVariete, $lePointDeVente, $leProducteur);

	$pointDeVentes = chargerPointDeVente($idUser);

	foreach ($pointDeVentes as $pointDeVente) 
	{

		$varPoint = $pointDeVente['nomPoint'];
		$mesPointDeVente[]= "$varPoint";
	}

$mesPointDeVente =implode("', '", $mesPointDeVente);
$producteurs = chargerProducteur($mesPointDeVente);

include CHEMIN_VUE.'catalogue.php';

?>
<?php
require_once CHEMIN_MODELE.'commerce.php';

$idUser = $_SESSION['utilisateur']['idUser'];


if (!utilisateur_est_connecte()) {
	include 'global/section.php';	
}
else 
{
	$verifPoint = verificationPoint_producteur($idUser);
	if ($verifPoint && !isset($_SESSION['point']))
	{
		require_once CHEMIN_CONTROLEUR.'produire.php';
	} 
	elseif (isset($_GET['point']))
	{
		$idPoint = $_GET['point'];
		$idUser = $_SESSION['utilisateur']['idUser'];
		$point_favori = ajout_point_producteur($idPoint, $idUser);
		$_SESSION['point'] = $_GET['point'];
		unset($_GET);
		
		include CHEMIN_CONTROLEUR.'produire.php';
	}
	else
	{
		
		$nuDepartement = substr($_SESSION['utilisateur']['cp'],0,2);
		$nuDepartement.='%';
		$infos_pointDeVente = chargerPointsDepartement_producteur($idUser, $nuDepartement);
		if(count($infos_pointDeVente) < 1)
		{
			$infos_pointDeVente = chargerTousPoints_producteur($idUser);
			$point_departement = true;
		}
		//$rayons=chargerRayons();
		//$produits=chargerTousProduits();
		include CHEMIN_VUE.'maps_producteur.php';

	}
}
?> 
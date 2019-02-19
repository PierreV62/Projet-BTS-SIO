<?php

require_once 'modeles/commerce.php';

//if(utilisateur_est_connecte())
//{
	//if(isset($_POST["idRayon"]))
	//{
	 	$idRayon = $_GET["idRayon"];

		$tabProduits=chargerProduits($idRayon);
		echo json_encode($tabProduits);
	//}
	//else echo("appel incorrest");
//}
//else echo ("Utilisateur non connecté");
?>
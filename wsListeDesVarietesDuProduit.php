<?php

require_once 'modeles/commerce.php';

//if(utilisateur_est_connecte())
//{
	//if(isset($_POST["idRayon"]))
	//{
	 	$idProduit = $_GET["idProduit"];

		$tabVarietes=chargerVarietes($idProduit);
		echo json_encode($tabVarietes);
	//}
	//else echo("appel incorrest");
//}
//else echo ("Utilisateur non connecté");
?>
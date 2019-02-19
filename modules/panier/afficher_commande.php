<?php
$idUser = $_SESSION['utilisateur']['idUser'];
$panier = $_SESSION['panier'];

foreach ($panier as $lot) {
	$mesLots[] = $lot['ref'];
	echo "bonjour"; 
}

$mesPoints = chargerMesPoint($mesLots);
var_dump($mesPoints);

?>
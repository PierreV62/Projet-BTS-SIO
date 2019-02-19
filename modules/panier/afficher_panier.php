<?php 
if (@$_POST['operation'] != "Passer la Commande")  {

}
if (!isset ($_SESSION['panier'])) 
{  // On vide le panier
	include 'modules/panier/gestion_panier.php'; // On vide le panier ici puisque action="Vider le Panier"
	include 'modules/panier/vues/panier_vide.php';
}
if ((@$_POST['operation'] != "Vider le Panier") &&  (@$_POST['action'] != "Passer la Commande")) {
	require_once CHEMIN_MODELE.'commerce.php';
	$produits=$_SESSION["panier"];
	foreach ($produits as $produit) {
		//echo "<br/> produit <br/>";
		//var_dump($produit);
		//echo "<br/> panier <br/>";
		//var_dump($infos_panier[0]);
		if($produit["quantite"] > $produit["stock"])
		{
			$produit["quantite"]= $produit["stock"];
			$erreur="la quantité demande exéde la quantité maximum, la quantité commandé a été modifié en conscéquence";
			echo $erreur;
		}

	}
	include 'modules/panier/vues/panier_infos.php';
} 
if (@$_POST['action'] =="Vider le Panier") 
{  // On vide le panier
	include 'modules/panier/gestion_panier.php'; // On vide le panier ici puisque action="Vider le Panier"
	include 'modules/panier/vues/panier_vide.php';
}
if (@isset ($_POST['Ajout au panier'])) {  // On ajoute au panier
	echo "Ajout au panier ici";
	include_once 'modules/panier/infos_panier.php';
	$infos_panier = infos_panier();
	include 'modules/panier/gestion_panier.php'; // On ajoute au panier
	include 'modules/panier/vues/panier_infos.php';
} 
if (@$_POST['action'] == "Passer la Commande")  
{  // ON PASSE LA COMMANDE
    	include 'modules/panier/afficher_commande.php';
}
?>
<?php
require ('global/configMysql.php');

function chargerRayons(){
	global $connexion;
	$requeteRayonTxt = "SELECT idRayon, libelleRayon FROM rayon";
	$requeteRayon = mysqli_query($connexion, $requeteRayonTxt) or die('Erreur SQL !<br>'.$requeteRayonTxt.'<br>'.mysqli_error($connexion));
	while($data = mysqli_fetch_assoc($requeteRayon))  
	{ 
		$result[]=$data;
	}
	return $result;
}
function chargerProduits($idRayon){
	global $connexion;
	$requeteLotsTxt = "SELECT idProduit, libelleProduit FROM produit WHERE validiteProduit =1 AND idRayon =$idRayon";
	$requeteLots = mysqli_query($connexion, $requeteLotsTxt) or die('Erreur SQL !<br>'.$requeteLotsTxt.'<br>'.mysqli_error($connexion));

	while($data = mysqli_fetch_assoc($requeteLots))  
	{ 
		$result[]=$data;
	}

	return $result;
}

function chargerVarietes($idProduit){
	global $connexion;
	$requeteLotsTxt = "SELECT idVariete, libelleVariete FROM variete WHERE validiteVariete =1 AND idProduit =$idProduit";
	$requeteLots = mysqli_query($connexion, $requeteLotsTxt) or die('Erreur SQL !<br>'.$requeteLotsTxt.'<br>'.mysqli_error($connexion));

	while($data = mysqli_fetch_assoc($requeteLots))  
	{ 
		$result[]=$data;
	}

	return $result;
}

function chargerModeProduction($idProducteur){
	global $connexion;
	$requeteParcelleTxt = "SELECT idProduction, modeProduction FROM modeProduction";
	$requeteParcelle = mysqli_query($connexion, $requeteParcelleTxt) or die('Erreur SQL !<br>'.$requeteParcelleTxt.'<br>'.mysqli_error($connexion));
	while($data = mysqli_fetch_assoc($requeteParcelle))  
	{ 
		$result[]=$data;
	}
	return $result;
}

function cargerParcelles($idProducteur)
{
	global $connexion;
	$requeteParcelleTxt = "SELECT idParcelle, libelleParcelle, commune FROM parcelles WHERE idProducteur = $idProducteur";
	$requeteParcelle = mysqli_query($connexion, $requeteParcelleTxt) or die('Erreur SQL !<br>'.$requeteParcelleTxt.'<br>'.mysqli_error($connexion));
	while($data = mysqli_fetch_assoc($requeteParcelle))  
	{ 
		$result[]=$data;
	}
	return $result;

}

function chargerPointDeVente($idUser){
	global $connexion;
	$requeteLotsTxt = "SELECT pointDeVente.idPoint, nomPoint FROM pointDeVente INNER JOIN choixPointsAchat ON pointDeVente.idPoint = choixPointsAchat.idPoint WHERE choixPointsAchat.idUser = $idUser";
	$requeteLots = mysqli_query($connexion, $requeteLotsTxt) or die('Erreur SQL !<br>'.$requeteLotsTxt.'<br>'.mysqli_error($connexion));
	$result="";
	$cpt=0;
	while($data = mysqli_fetch_assoc($requeteLots))  
	{ 
		$result[$cpt]=$data; 
		$cpt++;
	}
	return $result;
}


function chargerProducteur($mesPointDeVente){
	global $connexion;
	$requeteLotsTxt = "SELECT producteur.idProducteur, nom, prenom FROM utilisateur INNER JOIN producteur ON utilisateur.idUser = producteur.idUser INNER JOIN choixPointsLivraison ON producteur.idProducteur = choixPointsLivraison.idProducteur INNER JOIN pointDeVente ON choixPointsLivraison.idPoint = pointDeVente.idPoint WHERE pointDeVente.nomPoint IN ('$mesPointDeVente') GROUP BY idProducteur";
	$requeteLots = mysqli_query($connexion, $requeteLotsTxt) or die('Erreur SQL !<br>'.$requeteLotsTxt.'<br>'.mysqli_error($connexion));
	while($data = mysqli_fetch_assoc($requeteLots))  
	{ 
		$result[]=$data; 
	}
	return $result;

}


function chargerIdProducteur($idUser){
	global $connexion;

	//récupération de l'id du role par rapport à son libelle
	$resultIdProducteur = $connexion->query("SELECT producteur.idProducteur FROM utilisateur INNER JOIN producteur ON utilisateur.idUser = producteur.idUser WHERE utilisateur.idUser =$idUser ");
	$ligneIdProducteur = $resultIdProducteur->fetch_array();
	$idProducteur = $ligneIdProducteur['idProducteur'];
	return $idProducteur;

}

function chargerPointsDepartement($idUser, $nuDepartement){
	global $connexion;
	$requetePointsTxt = "SELECT pointDeVente.idPoint, ruePoint, cpPoint, villePoint, nomPoint, latitude, longitude FROM pointDeVente WHERE pointDeVente.idPoint NOT IN(SELECT choixPointsAchat.idPoint FROM choixPointsAchat WHERE choixPointsAchat.idUser = $idUser) AND cpPoint LIKE \"$nuDepartement\" ";
	$requetePoints = mysqli_query($connexion, $requetePointsTxt) or die('Erreur SQL !<br>'.$requetePointsTxt.'<br>'.mysqli_error($connexion));
	
	while($data = mysqli_fetch_assoc($requetePoints))  
	{ 
		$result[]=$data; 
	}
	return $result;
}

function chargerPointsDepartement_producteur($idUser, $nuDepartement){
	global $connexion;

	//récupération de l'id du role par rapport à son libelle
	$resultIdProducteur = $connexion->query('SELECT idProducteur from producteur where idUser="'.$idUser.'"');
	$ligneIdProducteur = $resultIdProducteur->fetch_array();
	$idProducteur = $ligneIdProducteur['idProducteur'];

	$requetePointsTxt = "SELECT pointDeVente.idPoint, ruePoint, cpPoint, villePoint, nomPoint, latitude, longitude FROM pointDeVente WHERE pointDeVente.idPoint NOT IN(SELECT choixPointsLivraison.idPoint FROM choixPointsLivraison WHERE choixPointsLivraison.idProducteur = $idProducteur) AND cpPoint LIKE \"$nuDepartement\" ";
	$requetePoints = mysqli_query($connexion, $requetePointsTxt) or die('Erreur SQL !<br>'.$requetePointsTxt.'<br>'.mysqli_error($connexion));
	
	while($data = mysqli_fetch_assoc($requetePoints))  
	{ 
		$result[]=$data; 
	}
	return $result;
}


function chargerTousPoints($idUser){
	global $connexion;
	$requetePointsTxt = "SELECT pointDeVente.idPoint, ruePoint, cpPoint, villePoint, nomPoint, latitude, longitude FROM pointDeVente WHERE pointDeVente.idPoint NOT IN(SELECT choixPointsAchat.idPoint FROM choixPointsAchat  WHERE choixPointsAchat.idUser = $idUser)";
	$requetePoints = mysqli_query($connexion, $requetePointsTxt) or die('Erreur SQL !<br>'.$requetePointsTxt.'<br>'.mysqli_error($connexion));
	
	while($data = mysqli_fetch_assoc($requetePoints))  
	{ 
		$result[]=$data; 
	}
	return $result;
}

function chargerTousPoints_producteur($idUser){
	global $connexion;

	//récupération de l'id du role par rapport à son libelle
	$resultIdProducteur = $connexion->query('SELECT idProducteur from producteur where idUser="'.$idUser.'"');
	$ligneIdProducteur = $resultIdProducteur->fetch_array();
	$idProducteur = $ligneIdProducteur['idProducteur'];


	$requetePointsTxt = "SELECT pointDeVente.idPoint, ruePoint, cpPoint, villePoint, nomPoint, latitude, longitude FROM pointDeVente WHERE pointDeVente.idPoint NOT IN(SELECT choixPointsLivraison.idPoint FROM choixPointsLivraison WHERE choixPointsLivraison.idProducteur = $idProducteur)";
	$requetePoints = mysqli_query($connexion, $requetePointsTxt) or die('Erreur SQL !<br>'.$requetePointsTxt.'<br>'.mysqli_error($connexion));
	
	while($data = mysqli_fetch_assoc($requetePoints))  
	{ 
		$result[]=$data; 
	}
	return $result;
}

function chargerDetailsPoint($idPoint){
	global $connexion;
	$requetePointsTxt = "SELECT pointDeVente.idPoint, ruePoint, cpPoint, villePoint, nomPoint, latitude, longitude, heureOuvertureMatin, heureFermetureMatin, heureOuvertureApresMidi, heureFermetureApresMidi, nomJour FROM pointDeVente inner join ouverture on pointDeVente.idPoint = ouverture.idPoint inner join jourDansSemaine on ouverture.idJour = jourDansSemaine.idJour WHERE pointDeVente.idPoint = $idPoint GROUP by pointDeVente.idPoint";
	$requetePoints = mysqli_query($connexion, $requetePointsTxt) or die('Erreur SQL !<br>'.$requetePointsTxt.'<br>'.mysqli_error($connexion));
	$result="";
	$cpt=0;
	while($data = mysqli_fetch_assoc($requetePoints))  
	{ 
		$result[$cpt]=$data; 
		$cpt++;
	}
	return $result;
}

function ajout_point($idPoint, $idUser){
	global $connexion;
	$requeteAjoutTxt = "INSERT INTO choixPointsAchat VALUES($idPoint,$idUser)";
	$requeteAjout = mysqli_query($connexion, $requeteAjoutTxt) or die('Erreur SQL !<br>'.$requeteAjoutTxt.'<br>'.mysqli_error($connexion));
	if($data = mysqli_fetch_assoc($requeteAjout))  
	{ 
    	// on retourne les informations de l'enregistrement en cours
		$result=$data; 
	}
	return $result;  

}

function ajout_point_producteur($idPoint, $idUser){
	global $connexion;

	//récupération de l'id du role par rapport à son libelle
	$resultIdProducteur = $connexion->query('SELECT idProducteur from producteur where idUser="'.$idUser.'"');
	$ligneIdProducteur = $resultIdProducteur->fetch_array();
	$idProducteur = $ligneIdProducteur['idProducteur'];

	$requeteAjoutTxt = "INSERT INTO choixPointsLivraison VALUES($idPoint,$idProducteur)";
	$requeteAjout = mysqli_query($connexion, $requeteAjoutTxt) or die('Erreur SQL !<br>'.$requeteAjoutTxt.'<br>'.mysqli_error($connexion));
	if($data = mysqli_fetch_assoc($requeteAjout))  
	{ 
    	// on retourne les informations de l'enregistrement en cours
		$result=$data; 
	}
	return $result;  

}

function compterLots($idUser, $leRayon, $leProduit, $laVariete, $lePointDeVente, $leProducteur){
	global $connexion;
	$requeteLotsTxt = 'SELECT lot.idLot, libelleVariete, libelleProduit, quantite, dateRecolte, dateLimite, prix, libelleUnite, descLot, variete.photo, idProducteur FROM rayon INNER join produit on rayon.idRayon = produit.idRayon INNER join variete on produit.idProduit = variete.idProduit inner join lot on variete.idVariete = lot.idVariete inner join unite on lot.idUnite = unite.idUnite WHERE lot.idLot IN(SELECT lot.idLot FROM lot inner JOIN producteur on lot.idProducteur = producteur.idProducteur inner join choixPointsLivraison on producteur.idProducteur = choixPointsLivraison.idProducteur INNER JOIN pointDeVente on choixPointsLivraison.idPoint = pointDeVente.idPoint INNER join choixPointsAchat on pointDeVente.idPoint = choixPointsAchat.idPoint WHERE choixPointsAchat.idUser ='.$idUser.'';
	if($lePointDeVente != "-1")
	{
		$requeteLotsTxt .=' AND pointDeVente.idPoint ='.$lePointDeVente;
	}

	$requeteLotsTxt.=')';
	
	if($leRayon != "-1")
	{
		$requeteLotsTxt .= ' AND rayon.idRayon ='.$leRayon;
	}
	if($leProduit != "-1")
	{
		$requeteLotsTxt .= ' AND produit.idProduit ='.$leProduit;
	}
	if($laVariete != "-1")
	{
		$requeteLotsTxt .=' AND variete.idVariete = '.$laVariete;
	}
	if($leProducteur != "-1")
	{
		$requeteLotsTxt .=' AND lot.idProducteur = '.$leProducteur;
	}
	$requeteLots = mysqli_query($connexion, $requeteLotsTxt) or die('Erreur SQL !<br>'.$requeteLotsTxt.'<br>'.mysqli_error($connexion));
	
	while($data = mysqli_fetch_assoc($requeteLots))  
	{ 
		$result[]=$data; 
	}
	return $result;
}

function chargerLots($idUser, $premiereEntree, $lotsParPage, $leRayon, $leProduit, $laVariete, $lePointDeVente, $leProducteur){
	global $connexion;
	$requeteLotsTxt = 'SELECT lot.idLot, libelleVariete, libelleProduit, quantite, dateRecolte, dateLimite, prix, libelleUnite, descLot, variete.photo, idProducteur FROM rayon INNER join produit on rayon.idRayon = produit.idRayon INNER join variete on produit.idProduit = variete.idProduit inner join lot on variete.idVariete = lot.idVariete inner join unite on lot.idUnite = unite.idUnite WHERE lot.idLot IN(SELECT lot.idLot FROM lot inner JOIN producteur on lot.idProducteur = producteur.idProducteur inner join choixPointsLivraison on producteur.idProducteur = choixPointsLivraison.idProducteur INNER JOIN pointDeVente on choixPointsLivraison.idPoint = pointDeVente.idPoint INNER join choixPointsAchat on pointDeVente.idPoint = choixPointsAchat.idPoint WHERE choixPointsAchat.idUser ='.$idUser.'';
	if($lePointDeVente != "-1")
	{
		$requeteLotsTxt .=' AND pointDeVente.idPoint ='.$lePointDeVente;
	}

	$requeteLotsTxt.=')';

	if($leRayon != "-1")
	{
		$requeteLotsTxt .= ' AND rayon.idRayon ='.$leRayon;
	}
	if($leProduit != "-1")
	{
		$requeteLotsTxt .= ' AND produit.idProduit ='.$leProduit;
	}
	if($laVariete != "-1")
	{
		$requeteLotsTxt .=' AND variete.idVariete = '.$laVariete;
	}
	if($leProducteur != "-1")
	{
		$requeteLotsTxt .=' AND lot.idProducteur = '.$leProducteur;
	}
	$requeteLotsTxt .= ' ORDER BY dateLimite ASC LIMIT '.$premiereEntree.', '.$lotsParPage.'';
	$requeteLots = mysqli_query($connexion, $requeteLotsTxt) or die('Erreur SQL !<br>'.$requeteLotsTxt.'<br>'.mysqli_error($connexion));
	
	while($data = mysqli_fetch_assoc($requeteLots))  
	{ 
		$result[]=$data; 
	}
	return $result;
}

function verificationPoint($idUser){
	global $connexion;
	$requetePointsTxt = "SELECT idPoint FROM choixPointsAchat WHERE idUser = $idUser";
	$requetePoints = mysqli_query($connexion, $requetePointsTxt) or die('Erreur SQL !<br>'.$requetePointsTxt.'<br>'.mysqli_error($connexion));
	while($data = mysqli_fetch_assoc($requetePoints))  
	{ 
		$result[]=$data; 
	}
	return $result;


}

function verificationPoint_producteur($idUser){
	global $connexion;

	//récupération de l'id du role par rapport à son libelle
	$resultIdProducteur = $connexion->query('SELECT idProducteur from producteur where idUser="'.$idUser.'"');
	$ligneIdProducteur = $resultIdProducteur->fetch_array();
	$idProducteur = $ligneIdProducteur['idProducteur'];

	$requetePointsTxt = "SELECT idPoint FROM choixPointsLivraison WHERE idProducteur = $idProducteur";
	$requetePoints = mysqli_query($connexion, $requetePointsTxt) or die('Erreur SQL !<br>'.$requetePointsTxt.'<br>'.mysqli_error($connexion));

	while($data = mysqli_fetch_assoc($requetePoints))  
	{ 
		$result[]=$data; 

	}
	return $result;


}

function ajout_produit($idRayon, $nomProduit, $cheminPhoto)
{
	global $connexion;
	$valide=false;

	//récupération de l'id du role par rapport à son libelle
	$resultIdProduit = $connexion->query('SELECT ifnull(max(idProduit), 50)+1 as maxId from produit');
	$ligneIdProduit = $resultIdProduit->fetch_array();
	$idProduit = $ligneIdProduit['maxId'];

	//vérification id utilisateur
	$resultUser = $connexion->query('SELECT idProduit from produit where libelleProduit= "'.$nomProduit.'"');
	if ($resultUser === false OR $resultUser->num_rows < 1)
	{

		if($connexion->query("INSERT INTO produit(idProduit, libelleProduit, photoProduit, idRayon) VALUES($idProduit, \"$nomProduit\", \"$cheminPhoto\", $idRayon)"))
		{
			$valide = true;
		}
	}
	return $valide;
}

function ajout_variete($idProduit, $nomVariete, $cheminPhoto)
{
	global $connexion;
	$valide=false;

	//récupération de l'id du role par rapport à son libelle
	$resultIdVariete = $connexion->query('SELECT ifnull(max(idVariete), 50)+1 as maxId from variete');
	$ligneIdVariete = $resultIdVariete->fetch_array();
	$idVariete = $ligneIdVariete['maxId'];

	//vérification id utilisateur
	$resultUser = $connexion->query('SELECT idVariete from variete where libelleVariete= "'.$nomVariete.'"');
	if ($resultUser === false OR $resultUser->num_rows < 1)
	{

		if($connexion->query("INSERT INTO variete(idVariete, libelleVariete, photo, idProduit) VALUES($idVariete, \"$nomVariete\", \"$cheminPhoto\", $idProduit)"))
		{
			$valide = true;
		}
	}
	return $valide;
}
/*
function chargerMesPoint($mesLots)
{
	global $connexion;
	$requetePointsTxt = "SELECT pointDeVente.idPoint FROM pointDeVente WHERE pointDeVente.idPoint IN()";
	$requetePoints = mysqli_query($connexion, $requetePointsTxt) or die('Erreur SQL !<br>'.$requetePointsTxt.'<br>'.mysqli_error($connexion));
	
	while($data = mysqli_fetch_assoc($requetePoints))  
	{ 
		$result[]=$data; 
	}
	return $result;

}
*/

function creation_parcelle($idProducteur, $commune, $latitude, $longitude, $production)
{
	global $connexion;

	//récupération de l'id du role par rapport à son libelle
	$resultIdParcelle = $connexion->query('SELECT ifnull(max(idParcelle), 50)+1 as maxId from parcelles');
	$ligneIdParcelle = $resultIdParcelle->fetch_array();
	$idParcelle = $ligneIdParcelle['maxId'];

	$requeteAjoutTxt = "INSERT INTO parcelles(idParcelle, commune, latitude, longitude, idProduction, idProducteur) VALUES($idParcelle, '$commune','$latitude', '$longitude', $production, $idProducteur)";
	$requeteAjout = mysqli_query($connexion, $requeteAjoutTxt) or die('Erreur SQL !<br>'.$requeteAjoutTxt.'<br>'.mysqli_error($connexion));
	if($data = mysqli_fetch_assoc($requeteAjout))  
	{ 
    	// on retourne les informations de l'enregistrement en cours
		$result=$data; 
	}
	return $result;  
}

function creation_lot($idProducteur, $idVariete, $idParcelle, $quantite, $unite, $prix, $description, $dateRecolte_us, $dateLimite_us)
{
	global $connexion;
	//récupération de l'id du role par rapport à son libelle
	$resultIdlot = $connexion->query('SELECT ifnull(max(idlot), 50)+1 as maxId from lot');
	$ligneIdlot = $resultIdlot->fetch_array();
	$idLot = $ligneIdlot['maxId'];
/*
	//récupération de l'id du role par rapport à son libelle
	$resultIdUnite = $connexion->query("SELECT idUnite from unite where libelleUnite ='$unite");
	$ligneIdUnite = $resultIdUnite->fetch_array();
	$idUnite = $ligneIdUnite['idUnite'];
*/
	$requeteAjoutTxt = "INSERT INTO lot(idLot, descLot, idUnite, quantite, prix, idVariete, idProducteur, idParcelle, dateRecolte, dateLimite) VALUES($idLot, '$description', 1, $quantite, $prix, $idVariete, $idProducteur, $idParcelle, '$dateRecolte_us', '$dateLimite_us')";
	$requeteAjout = mysqli_query($connexion, $requeteAjoutTxt) or die('Erreur SQL !<br>'.$requeteAjoutTxt.'<br>'.mysqli_error($connexion));
	if($data = mysqli_fetch_assoc($requeteAjout))  
	{ 
    	// on retourne les informations de l'enregistrement en cours
		$result=$data; 
	}
	return $result; 

}


function chargerPointDeVenteDeLot($idLot)
{
	global $connexion;
	$requetePointsTxt = "SELECT pointDeVente.idPoint, pointDeVente.nomPoint FROM lot inner JOIN producteur on lot.idProducteur = producteur.idProducteur inner join choixPointsLivraison on producteur.idProducteur = choixPointsLivraison.idProducteur INNER JOIN pointDeVente on choixPointsLivraison.idPoint = pointDeVente.idPoint INNER join choixPointsAchat on pointDeVente.idPoint = choixPointsAchat.idPoint where idLot =".$idLot." GROUP by idPoint";
	$requetePoints = mysqli_query($connexion, $requetePointsTxt) or die('Erreur SQL !<br>'.$requetePointsTxt.'<br>'.mysqli_error($connexion));

	while($data = mysqli_fetch_assoc($requetePoints))  
	{ 
		$result[]=$data; 

	}
	return $result;

}
?>
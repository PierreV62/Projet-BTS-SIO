<?php
require ('global/configMysql.php');

//connexion d'un utilisateur
function connexion($email,$password)
{
	global $connexion;
	$valide=false;


	$resultUser = $connexion->query('SELECT password FROM utilisateur WHERE email =  "'.$email.'"');
	$ligneUser = $resultUser->fetch_array();

	//$pass = password_verify($password == $ligneUser['password']);
	if ($ligneUser['password'] == md5($password))
	{
		$valide=true;
	}
	return $valide;
}
//optien toutes les infos de l'utilisateur
function lire_infos_utilisateur($email) 
{
	global $connexion;
	$requeteTxt = 'SELECT idUser, nom, prenom, rue, cp, ville, email, password, u.idRole, libelleRole, etatIns, tel, photoUser, descUser, latitude, longitude FROM utilisateur u INNER JOIN role r ON u.idRole=r.idRole  WHERE email = "'.$email.'"';
	$requete = mysqli_query($connexion, $requeteTxt) or die('Erreur SQL !<br>'.$requete.'<br>'.mysqli_error($connexion));
	$result="";
	if($data = mysqli_fetch_assoc($requete))  
	{ 
    	// on retourne les informations de l'enregistrement en cours
		$result=$data; 
	}
	return $result;  
}
function inscription($nom, $prenom, $rue, $cp, $ville, $tel, $password, $email, $latitude, $longitude, $role, $ipUser, $key)
{
	global $connexion;
	$valide=false;

	//récupération de l'id du role par rapport à son libelle
	$resultRole = $connexion->query('SELECT idRole from role where libelleRole="'.$role.'"');
	$ligneId = $resultRole->fetch_array();
	$idRole = $ligneId['idRole'];
	

	//récupération de l'id du role par rapport à son libelle
	$resultIdUser = $connexion->query('SELECT ifnull(max(idUser), 50)+1 as maxId from utilisateur');
	$ligneIdUser = $resultIdUser->fetch_array();
	$idUser = $ligneIdUser['maxId'];

    //vérification id utilisateur
	$resultUser = $connexion->query('SELECT idUser from utilisateur where email="'.$email.'"');
	if ($resultUser === false OR $resultUser->num_rows < 1) {
		echo $idUser." second";
		if ($connexion->query('INSERT INTO utilisateur(idUser, prenom, nom, password, email, rue, cp, ville, tel, idRole, ipUser, latitude, longitude, etatIns, confirmKey) values ('.$idUser.', "'.$prenom.'", "'.$nom.'", "'.$password.'", "'.$email.'","'.$rue.'","'.$cp.'", "'.$ville.'", "'.$tel.'", "'.$idRole.'", "'.$ipUser.'", "'.$latitude.'", "'.$longitude.'",0, "'.$key.'")'))
		{
			if($role == "producteur")
			{
				//récupération de l'id du role par rapport à son libelle
				$resultIdProducteur = $connexion->query('SELECT ifnull(max(idProducteur), 50)+1 as maxId from producteur');
				$ligneIdProducteur = $resultIdProducteur->fetch_array();
				$idProducteur = $ligneIdProducteur['maxId'];

				if ($connexion->query('INSERT INTO producteur(idProducteur, idUser) values ('.$idProducteur.', '.$idUser.')'))
				{
					
				}

			}
			$valide=true;
		}

	} 

	return $valide;
}

function role_inscription()
{
	global $connexion;
	$requeteTxt = "SELECT idRole, libelleRole from role where libelleRole='client' or libelleRole ='producteur' or libelleRole = 'artisan' ";
	$requete = mysqli_query($connexion, $requeteTxt) or die('Erreur SQL !<br>'.$requete.'<br>'.mysqli_error($connexion));
	$result="";
	$cpt=0;
	while($data = mysqli_fetch_assoc($requete))  
	{ 
    	// on retourne les informations de l'enregistrement en cours
		$result[$cpt]=$data; 
		$cpt++;  
	}
	return $result;
}

function question()
{
	global $connexion;
	$requeteTxt = "SELECT * FROM questions_secrete";
	// on vérifie que la requète est correctement été exécutée
	$requete = mysqli_query($connexion, $requeteTxt) or die('Erreur SQL !<br>'.$requeteTxt.'<br>'.mysqli_error($connexion));
	$result="";
	$cpt=0;
	while($data = mysqli_fetch_assoc($requete))  
	{ 
    	// on retourne les informations de l'enregistrement en cours
		$result[$cpt]=$data; 
		$cpt++;  
	}
	return $result;
}
function changerMDP($id,$mdp)
{
	global $connexion;
	$requeteTxt = "UPDATE utilisateur SET
	password = '$mdp'
	WHERE
	idUser = $id";
	if ($requete = mysqli_query($connexion, $requeteTxt) or die('Erreur SQL !<br>'.$requeteTxt.'<br>'.mysqli_error($connexion)))
	{
		$valide=true;
	} 
	return $valide;
}

function email_service_communication()
{

	global $connexion;
	$requeteTxt = 'SELECT valueParametre from parametre where libelleParametre="email_serviceCommunication"';
	$requete = mysqli_query($connexion, $requeteTxt) or die('Erreur SQL !<br>'.$requete.'<br>'.mysqli_error($connexion));
	$result="";
	if($data = mysqli_fetch_assoc($requete))  
	{ 
    	// on retourne les informations de l'enregistrement en cours
		$result=$data; 
	}
	return $result;  

}

function confirmation_key()
{
	global $connexion;
	$requeteTxt = 'SELECT etatIns, confirmKey FROM utilisateur WHERE email = "'.$email.'"';
	$requete = mysqli_query($connexion, $requeteTxt) or die('Erreur SQL !<br>'.$requete.'<br>'.mysqli_error($connexion));
	$result="";
	if($data = mysqli_fetch_assoc($requete))  
	{ 
    	// on retourne les informations de l'enregistrement en cours
		$result=$data; 
	}
	return $result;  

}

function modifier_profil($nom, $prenom, $rue, $cp, $ville, $tel, $nouveauEmail, $ancienEmail, $latitude, $longitude)
{
	global $connexion;
	$valide=false;

	if ($nouveauEmail != $ancienEmail)
	{
		$resultUser = $connexion->query('SELECT idUser from utilisateur where email="'.$nouveauEmail.'"');
		if ($resultUser === false OR $resultUser->num_rows < 1) {

			if ($connexion->query("UPDATE utilisateur SET prenom ='$prenom', nom = '$nom', email='$nouveauEmail', rue='$rue', cp='$cp', ville='$ville', tel='$tel', latitude='$latitude', longitude='$longitude' WHERE
				email = '$ancienEmail'"))
			{
				$valide=true;
			}

		} 
	}
	else
	{
		if ($connexion->query("UPDATE utilisateur SET prenom ='$prenom', nom = '$nom', email='$nouveauEmail', rue='$rue', cp='$cp', ville='$ville', tel='$tel', latitude='$latitude', longitude='$longitude' WHERE
			email = '$ancienEmail'"))
		{
			$valide=true;
		}
	}

	return $valide;
}
?>
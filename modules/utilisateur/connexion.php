<?php
/*if (utilisateur_est_connecte()) {
	include 'global/section.php';	
} 
else 
{*/
	if(isset($_POST['email'], $_POST['password']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];

		require_once CHEMIN_MODELE.'authentification.php';
		$idUser = connexion($email,$password);

		// Si les identifiants sont valides
		if ( $idUser) 
		{
		    // On enregistre les informations dans la session
			$infos_utilisateur = lire_infos_utilisateur($email);  
			if ( $infos_utilisateur) 
			{     
				$_SESSION['utilisateur'] =$infos_utilisateur;
				$prenom = $_SESSION['utilisateur']['prenom'];
				$message_succes = "Bienvenue, $prenom. Vous êtes maintenant connecté !";

				if(isset($message_succes))
				{
					$_SESSION['messageForm']= $message_succes;
					include CHEMIN_VUE.'message_succes.php';
				}
				else
				{

				}
				include 'global/section.php';

			}
			else // Accès pas refusé !
			{
				$form = true;
				$message_erreurs = "Un problème est survenu lors de la récupération.";
			}

		}
		else // Accès pas refusé !
		{
			$form = true;
			$message_erreurs = "Nom d'utilisateur ou mot de passe inexistant.";
		}

		
	}
	else
	{
		$form = true;
	}
//}
	// On affiche le formulaire de connexion si on n'est pas déja connecté 
if ($form)
{
	if(isset($message_erreurs))
	{
		$_SESSION['messageForm']= $message_erreurs;
		include CHEMIN_VUE.'message_erreurs.php';
	}
	include CHEMIN_VUE.'formulaire_connexion.php';
}


?>
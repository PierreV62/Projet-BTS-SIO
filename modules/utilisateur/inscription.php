<?php
if (utilisateur_est_connecte()) {
	include 'global/section.php';
} 
else 
{
	if(isset($_POST['email'],$_POST['password']))
	{

	// Vérification de l'identité des pwd
		if($_POST['password']==$_POST['passverif']) {
		// vérification de la longueur du mot de passe
			if(strlen($_POST['password'])>=6) {
				// echappement des variables pour pouvoir les mettre dans une requette SQL
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$rue = $_POST['rue'];
				$cp = $_POST['cp'];
				$ville = $_POST['ville'];
				$tel = $_POST['tel'];
				$pwd = $_POST['password'];
				$password = md5($pwd);
				$email = $_POST['email'];
				$latitude = $_POST['latitude'];
				$longitude = $_POST['longitude'];
				$role= $_SESSION['role'];
				$ipUser = $_SERVER['REMOTE_ADDR'];
				$key = md5(microtime(TRUE)*100000);

                // Si d'autres erreurs ne sont pas survenues
				if (!empty($nom) && !empty($prenom)) {
					require_once CHEMIN_MODELE.'authentification.php';
		// inscription() est défini dans ~/modeles/authentification.php
					$inscription_effectuee = inscription($nom, $prenom, $rue, $cp, $ville, $tel, $password, $email, $latitude, $longitude, $role, $ipUser, $key);
					$_SESSION['email'] = $email;
					$_SESSION['key'] = $key;
					if ($inscription_effectuee) {

						$message_succes = " L'inscription s'est deroulée avec succés ! Vous allez bientôt recevoir un mail vous permettant d'activer votre compte afin de pouvoir vous connecter.";

						if(isset($message_succes))
						{
							$_SESSION['messageForm']= $message_succes;
							include CHEMIN_VUE.'message_succes.php';
							include CHEMIN_VUE.'inscription_client.php';
							include 'global/section.php';
						
						}
						
						
						//include 'global/section.php';
					//if($role=="client")
					//{
						//$inscription_effectuee = inscription($nom, $prenom, $rue, $cp, $ville, $tel, $password, $email, $latitude, $longitude, $role, $ipUser);
						//include('modules/messagerie/vues/inscription_client.php');
						
						//include CHEMIN_MODULES.'formulaireInscription.php');;
					//}
					}
					else
					{
						$form = true;
						$message_erreurs = 'Un compte est déjà attribué à cet adresse email.';

					} 

					
				}


			}
			else {
				$form = true;
				$message_erreurs = 'Le mot de passe que vous avez entré contient moins de 6 caractères.';
			}
		}
		else {
			$form = true;
			$message_erreurs = 'Les mots de passe que vous avez entré ne sont pas identiques.';
		}
	}
	else {
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
		include CHEMIN_VUE.'formulaire_inscription.php';
	}
	?>
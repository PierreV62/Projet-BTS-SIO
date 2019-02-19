<?php
if (!utilisateur_est_connecte()) {
	// On affiche la page d'erreur comme quoi l'utilisateur est déjà connecté   
	include CHEMIN_VUE.'erreur_non_connecte.php';
	include 'global/section.php';	
} 
else 
{
	//formulaire modification mot de passe
	if(isset($_REQUEST['changeMDP']))
	{
		if(strlen($_POST['ancienMDP'])>=6) 
		{

			if($_POST['nouveauMDP1'] == $_POST['nouveauMDP2'])
			{ 
				if ($_SESSION['utilisateur']['password'] != md5($_POST['nouveauMDP1'])) 
				{    
					// on modifie le mot de passe 
					$id = $_SESSION['utilisateur']['idUser'];
					$mdp =  md5($_POST['nouveauMDP1']);
					$modification_effectuee =changerMDP($id,$mdp);

					// on recharge les informations de l'utilisateur avec le nouveau mot de passe
					$email = $_SESSION['utilisateur']['email'];
					$infos_utilisateur = lire_infos_utilisateur($email);
					$_SESSION['utilisateur'] =$infos_utilisateur;
					
					// on redirige vers la page de gestion de profil avec message de confirmation
					$message_succes = "Votre mot de passe a bien été modifié.";

					if(isset($message_succes))
					{
						$_SESSION['messageForm']= $message_succes;
						include CHEMIN_VUE.'message_succes.php';
					}
					else
					{

					}
					include CHEMIN_VUE.'default_profil.php';

				}
				else // Accès pas refusé !
				{
					$form = true;
					$message_erreurs = "Le nouveau mot de passe est identque au précédent.";
				}

			}
			else // Accès pas refusé !
			{
				$form = true;
				$message_erreurs = "Les deux nouveax mot de passe ne sont pas identiques.";
			}
		}
		else
		{
			$form = true;
			$message_erreurs = "Le mot de passe que vous avez entré contient moins de 6 caractères.";
		}

	}
	else
	{
		$form = true;
	}
// formulaire modification du profil
	if(isset($_REQUEST['modifierProfil']))
	{
		if(isset($_POST['email']))
		{

				// echappement des variables pour pouvoir les mettre dans une requette SQL
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$rue = $_POST['rue'];
			$cp = $_POST['cp'];
			$ville = $_POST['ville'];
			$tel = $_POST['tel'];
			$nouveauEmail = $_POST['email'];
			$ancienEmail = $_SESSION['utilisateur']['email'];
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];
			$email = $nouveauEmail;

			$modification_effectuee = modifier_profil($nom, $prenom, $rue, $cp, $ville, $tel, $nouveauEmail, $ancienEmail, $latitude, $longitude);

			if ($modification_effectuee) 
			{
				// on recharge les informations de l'utilisateur avec le nouveau mot de passe
					$email = $_SESSION['utilisateur']['email'];
					$infos_utilisateur = lire_infos_utilisateur($email);
					$_SESSION['utilisateur'] =$infos_utilisateur;

				$message_succes = " Votre profile a été mis à jour.";

				if(isset($message_succes))
				{
					$_SESSION['messageForm']= $message_succes;
					include CHEMIN_VUE.'message_succes.php';
				}

			}
			else
			{
				$form = true;
				$message_erreurs = 'Un compte est déjà attribué à ce nouveau adresse email.';

			} 


		}
		else
		{
			$form = true;
	 				 // Affichage du formulaire inscription
			$message_erreurs = "Un problème est survenu lors de la modification.";

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
		include CHEMIN_VUE.'default_profil.php';
	}
?>
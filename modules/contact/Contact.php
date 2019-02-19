<?php 
if(isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['body']))
{

$nom =  $POST['nom'];
$email = $POST['email'];
$corp = $POST['body'];
$obj = $_POST['subject'];

$destinataire = 'peterson.rostain@gmail.com';
$sujet = "Activer votre compte" ;
$entete = "From: newWorld@newWorld.com" ;
 
// Le lien d'activation est composé du login(log) et de la clé(cle)
$message = 'Bienvenue sur new World,
 
Pour activer votre compte, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.
 
<a>http://petersonr.hol.es/newWorld/mails/activationClient.php?email='.urlencode($email).'&confirmKey='.urlencode($key).'</a>
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
 
 
mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail

include 'global/section.php';
	//require_once CHEMIN_VUE.'contact_message.php';
		$message_erreur = "Une erreur s'est produite. Votre message n'a pu être délivré";

	


}
else // envoi refusé !
{
	$form = true;
	
}

if ($form)
{
	if(isset($message_erreur))
	{
		include CHEMIN_VUE.'erreur_contact.php';
	}
	include CHEMIN_VUE.'formulaire_contact.php';
}

?>
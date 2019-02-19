<h2>Votre Profil</h2>
<p>
<?php
 if(!$_SESSION['utilisateur']['photoUser'])
{
	?>
		<img class="flottant_droite" src="images/user/avatar_default.jpg" title="Avatar de <?php echo $_SESSION['utilisateur']['prenom']; ?>" />
<?php
}
else
{
	?>
		<img class="flottant_droite" src="<?php echo $_SESSION['utilisateur']['photoUser']; ?>" title="Avatar de <?php echo $_SESSION['utilisateur']['prenom']; ?>" />	
<?php
}
?>
	
	<span class="label_profil">Nom</span> : <?php echo $_SESSION['utilisateur']['nom']; ?><br />
	<span class="label_profil">Prénom</span> : <?php echo $_SESSION['utilisateur']['prenom']; ?><br />
	<span class="label_profil">Email</span> : <?php echo $_SESSION['utilisateur']['email']; ?><br />
	<span class="label_profil">Rue </span> : <?php echo $_SESSION['utilisateur']['rue']; ?><br />
	<span class="label_profil">Code postal</span> : <?php echo $_SESSION['utilisateur']['cp']; ?><br />
	<span class="label_profil">Ville</span> : <?php echo $_SESSION['utilisateur']['ville']; ?><br />
	<span class="label_profil">Fonction : </span>  <?php echo $_SESSION['utilisateur']['libelleRole']; ?>
</p>

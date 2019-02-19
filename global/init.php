<?php
session_start();
// Inclusion du fichier de configuration (qui définit des constantes)
include 'global/config.php';
// On a besoin du modèle des inscription
include CHEMIN_MODELE.'authentification.php'; 



// Vérifie si l'utilisateur est connecté   
function utilisateur_est_connecte() {
  return !empty($_SESSION['utilisateur']);
}
?>
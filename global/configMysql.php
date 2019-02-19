<?php
/*
// Identifiants pour la base de données.
$servername = "mysql.hostinger.fr";
$username = "u747752631_world";
$password = "Bushido1";
$base= "u747752631_new";
// Create connection
$connexion = new mysqli($servername, $username, $password, $base);

// Check connection
if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
} 
*/


// Identifiants pour la base de données.
$servername = "localhost";
$username = "pvergniez";
$password = "ini01";
$base= "newWorld";
// Create connection
$connexion = new mysqli($servername, $username, $password, $base);

// Check connection
if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}

?>

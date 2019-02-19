<?php 
$mail = 'peterson.rostain@gmail.com'; // Déclaration de l'adresse de destination.

$message = '
<html>
<head>
   <title>Vous avez réservé sur notre site ...</title>
</head>
<body>
   <p>Message de '.$nom.'</p>
   <p>email : '.$email.'</p>
   <p>message : '.$corp.'</p>
</body>
</html>';<br><br> $entetes =
'Content-type: text/html; charset=utf-8' . "\r\n" .
'From: contact@newWorld.fr' . "\r\n" .
'Reply-To:'. $email. "\r\n" .
'X-Mailer: PHP/' . phpversion();
                         
//Envoi du mail
mail($mail, $objet, $message, $entetes);

include 'global/section.php';
?>
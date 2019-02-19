<!--Navbar-->
<nav class="navbar navbar-toggleable-md navbar-dark bg-primary navbar-fixed-top">
	<div class="container">
   <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <a class="navbar-brand active" href="index.php"><span class="sr-only">(current)</span><strong>NW</strong></a>
   <div class="collapse navbar-collapse" id="navbarNav1">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item "><a class="nav-link" href='index.php?module=vitrine&action=maps'>Acheter</a></li>
      <li class="nav-item "><a class="nav-link" href='index.php?module=vitrine&action=maps_producteur'>Produire</a></li>
      <li class="nav-item "><a class="nav-link" href='index.php?module=vitrine&action=distribuer'>Distribuer</a></li>
      <?php
      if (utilisateur_est_connecte()) {
        $role = $_SESSION['utilisateur']['libelleRole'] ;
        $nbLotPanier = count($_SESSION['panier']);
        switch ($role) {
        //cas client
          case "client" :  
          ?>
          <li class="nav-item "><a class="nav-link" href='index.php?module=panier&action=afficher_panier'>Panier<span class="badge badge-danger badge-pill"><?php echo $nbLotPanier;?></span></a></li>
          <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="icon_avatar" src='images/user/avatar_default.png'/></a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="nav-link" href='index.php?module=utilisateur&action=profil'> <i class="fa fa-user" ></i> Mon profil</a>
                    <a class="nav-link" href='index.php?module=utilisateur&action=deconnexion'><i class="fa fa-sign-out" ></i> Se déconnecter</a>
                </div>
            </li>
          <?php          
          break;
        //cas point relai
          case "relai" :
          ?>

          <li class="nav-item "><a class="nav-link" href='index.php?module=panier&action=afficher_panier'>Panier<span class="badge badge-danger badge-pill"><?php echo $nbLotPanier;?></span></a></li>
          <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="icon_avatar" src='images/user/avatar_default.png'/></a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="nav-link" href='index.php?module=utilisateur&action=profil'> <i class="fa fa-user" ></i> Mon profil</a>
                    <a class="nav-link" href='index.php?module=utilisateur&action=deconnexion'><i class="fa fa-sign-out" ></i> Se déconnecter</a>
                </div>
            </li>
          <?php    
          break;
        //cas producteur
          case "producteur" : 
          ?>
          <li class="nav-item "><a class="nav-link" href='index.php?module=panier&action=afficher_panier'>Panier<span class="badge badge-danger badge-pill"><?php echo $nbLotPanier;?></span></a></li>
          <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="icon_avatar" src='images/user/avatar_default.png'/></a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="nav-link" href='index.php?module=utilisateur&action=profil'> <i class="fa fa-user" ></i> Mon profil</a>
                    <a class="nav-link" href='index.php?module=utilisateur&action=deconnexion'><i class="fa fa-sign-out" ></i> Se déconnecter</a>
                </div>
            </li>
          <?php          
          break;
        //cas modératzur
          case "moderateur" :  
          ?>
          <li class="nav-item "><a class="nav-link" href='index.php?module=panier&action=afficher_panier'>Panier</a></li>
          <li class="nav-item "><a class="nav-link" href='index.php?module=commerce&action=produits'>Vos produits</a></li>
          <li class="nav-item "><a class="nav-link" href='index.php?module=utilisateur&action=profil'>Profil</a></li>
          <li class="nav-item "><a class="nav-link" href='index.php?module=utilisateur&action=deconnexion'><i class="fa fa-sign-out" ></i>Déconnexion</a></li>
          <?php          
          break;
        //cas administrateur
          case "administrateur" :  
          ?>
          <li class="nav-item "><a class="nav-link" href='index.php?module=panier&action=afficher_panier'>Panier</a></li>
          <li class="nav-item "><a class="nav-link" href='index.php?module=commerce&action=produits'>Vos Produits</a></li>
          <li class="nav-item "><a class="nav-link" href='index.php?module=utilisateur&action=profil'>Profil</a></li>
          <li class="nav-item "><a class="nav-link" href='index.php?module=utilisateur&action=deconnexion'><i class="fa fa-sign-out" ></i>Déconnexion</a></li>
          <?php          
          break;
        //cas client + producteur + point relai
          default :
          ?>
          <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="icon_avatar" src='images/user/avatarAccount.png'/></a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="nav-link" href='index.php?module=utilisateur&action=profil'> <i class="fa fa-user" ></i> Mon profil</a>
                    <hr />
                    <a class="nav-link" href='index.php?module=utilisateur&action=deconnexion'><i class="fa fa-sign-out" ></i> Se déconnecter</a>
                </div>
            </li>
           <?php
          break; 
        }    
      }
      else 
      {
        ?>
        <!--<li class="nav-item"><a href="#modal_login" id="show_login" class="nav-link" data-toggle="modal" data-target="#modal_login"><i class="fa fa-sign-in" ></i>Connexion</i>-->
          <li class="nav-item "><a class="nav-link" href='index.php?module=utilisateur&amp;action=connexion'><i class="fa fa-sign-in" ></i>Connexion</a></li>
          <?php 
        } 
        ?>
      </ul>
    </div>
  </div>

</nav>



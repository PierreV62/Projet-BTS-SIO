<?php
unset($_SESSION['point']);
?>
<!-- Grid row -->
<div class="row">

  <!-- Grid row -->
  <div class="col-lg-3">

    <br />
    <br />
    <div class="container">
      <div class="row">
        <div class="col-md-8 bg-primary">
         <div class="filter-sidebar">
          <div class="row card-body py-2 mb-3 bg-dark twhite">
            <h4><i class="fa fa-cog"></i> Options</h4>
          </div>
          <form id="options" class="ajax-auth" action="index.php?module=vitrine&action=catalogue" method="post">
            <div class="form-group">
              <select class="form-control" id="rayon" name="rayon" onchange="remplirListeDesProduits(this.value)">
                <option value="-1">Rayon </option>
                <?php
                foreach ($rayons as $rayon) {
                  ?>
                  <option value="<?php echo $rayon['idRayon']; ?>"><?php echo $rayon['libelleRayon']; ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <select class="form-control" id="produit" name="produit" onclick="remplirListeDesVarietes(this.value)">
                <option value="-1"> choisir un rayon</option>
              </select>
            </div>
            <div class="form-group">
              <select class="form-control" id="variete" name="variete">
                <option value="-1"> choisir un produit</option>
              </select>
            </div>
            <div class="form-group">
              <select class="form-control" name="pointDeVente" id="pointDeVente">
                <option  value="-1">Point de vente</option>
                <?php
                foreach ($pointDeVentes as $pointDeVente) {
                  ?>
                  <option value="<?php echo $pointDeVente['idPoint']; ?>"><?php echo $pointDeVente['nomPoint']; ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <select class="form-control" id="producteur" name="producteur">
                <option value="-1">Producteur</option>
                <?php
                foreach ($producteurs as $producteur) {
                  ?>
                  <option value="<?php echo $producteur['idProducteur']; ?>"><?php echo $producteur['prenom']." ".$producteur['nom']; ?></option>
                  <?php
                }
                ?>
              </select>
            </div>

            <hr>
            <button class="submit_button btn btn-primary" type="submit" value="connexion">RECHERCHER</button>
          </form>

        </div>
      </div>
    </div>
  </div>

</div>

<!-- Grid row -->
<div class=" row col-lg-9">

  <?php
  if ($nbLots > 1)
  {
  foreach ($lesLots as $lot)
  {

    ?>
    <!-- Grid column -->
    <div class="cardCatalogue col-lg-4 col-md-6">
      <!-- Card -->
      <div class="card card-cascade wider card-ecommerce">
        <!-- Card image -->
        <div class="view overlay">
          <img src="<?php echo $lot['photo']; ?>" class="card-img-top" alt="sample photo">
          
        </div>
        <!-- Card image -->
        <!-- Card content -->
        <div class="card-body text-center">
          <!-- Category & Title -->
          <a href="" class="text-muted">
            <h5><?php echo $lot['libelleProduit']; ?></h5>
          </a>
          <h4 class="card-title">
            <strong>
              <a href=""><?php echo $lot['libelleVariete']; ?></a>
            </strong>
          </h4>
          <!-- Description -->
          <p class="card-text"><?php echo $lot['descLot']; ?></p>
          <!-- Card footer -->
          <div class="card-footer px-1">
            <span class="float-left font-weight-bold">
              <strong><?php echo $lot['prix']."€ / ".$lot['libelleUnite']; ?></strong>
            </span>
            <span class="float-right">
              <a data-toggle="modal" data-target="#myModal<?php echo $lot['idLot']; ?>" data-placement="top" title="Ajout au panier">
               <i class="fa fa-shopping-cart grey-text ml-3"></i>
             </a>
             
           </span>
         </div>
       </div>
       <!-- Card content -->
     </div>
     <!-- Card -->
   </div>
   <!-- Grid column -->


   <!-- The Modal -->
   <div class="modal" id="myModal<?php echo $lot['idLot']; ?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"><?php echo $lot['libelleProduit']; ?> - <?php echo $lot['libelleVariete']; ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
         <!-- Grid row -->
         <div class="row">

          <!-- Grid row -->
          <div class="col-lg-1">
          </div>
          <div class="view overlay">
            <img src="<?php echo $lot['photo']; ?>" class="card-img-top" alt="sample photo">
            <a>
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>
          <!-- Grid row -->
          <div class="col-lg-6">
            <p class="card-text"><?php echo $lot['descLot']; ?></p>
            <hr />
            <p>Quantité restante : <?php echo $lot['quantite']." ".$lot['libelleUnite']; ?> </p>
            <form id='ajout' action='index.php?module=panier&action=gestion_panier' method='post'>
              <input type='hidden' name='id' value="<?php echo $lot['idLot']; ?>"/>
              <input type='hidden' name='description' value="<?php echo $lot['descLot']; ?>"/>
              <input type='hidden' name='stock' value="<?php echo $lot['quantite']; ?>"/>
              <input type='hidden' name='unite' value="<?php echo $lot['libelleUnite']; ?>"/>
              <input type='hidden' name='prix' value="<?php echo $lot['prix']; ?>"/>
              <input type='hidden' name='photo' value="<?php echo $lot['photo']; ?>"/>
              <input type='hidden' name='operation' value='Ajouter au panier' />
              <div class='row col-lg-12'>
                <div class='col-lg-6'>
                  <input type='number' id='quantite' class='form-control' name='quantite'/>
                </div>
                <div class='col-lg-6'>
                  <button class='submit_button btn btn-primary' type='submit' value='ajout' title='Ajouter au panier'><i class='fa fa-cart-plus'></i></button>
                </div>
              </div>
            </form>
            <p>Date de récolte : <?php echo $lot['dateRecolte']; ?></p>
            <p>Date limite de conservation : <?php echo $lot['dateLimite'];?></p>
          </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php 
}
}
 else
{
 ?>
  <div class="alert alert-danger alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Dommage!</strong> Il n'y a aucun lot dans les paramètres désirés.
    </div>

<?php
  }
 ?>
</div>

<br />
<br />
<div class="col-sm-9 col-sm-push-3 monBlock">
  <nav aria-label="Page navigation example">
    <br />
    <br />
    <ul class="pagination justify-content-end">
      <?php
      $i =1;
      if (isset($_GET['page']) && $_GET['page'] > 1)
      {
        ?>
        <li class="page-item">
         <a class="page-link" href="index.php?module=vitrine&action=catalogue&page=<?php echo $_GET['page']-1; ?>">
           <span aria-hidden="true">&laquo;</span>
           <span class="sr-only">Previous</span>
         </a>
       </li>
       <?php
     }
     else
     {
      ?>
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
      <?php
    }

for($i=1; $i<=$nombreDePages; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$pageActuelle) //Si il s'agit de la page actuelle...
     {
      ?>
      <li class="page-item active"><a class="page-link" href="index.php?module=vitrine&action=catalogue&page=<?php echo $i; ?>"> <?php echo $i; ?></a></li>
      <?php
    }  
     else //Sinon...
     {
      ?>
      <li class="page-item"><a class="page-link" href="index.php?module=vitrine&action=catalogue&page=<?php echo $i; ?>"> <?php echo $i; ?></a></li>
      <?php
    }
  }

  if (isset($_GET['page']) && $_GET['page'] < $nombreDePages)
  {
    ?>
    <li class="page-item">
     <a class="page-link" href="index.php?module=vitrine&action=catalogue&page=<?php echo $_GET['page']+1; ?>">
       <span aria-hidden="true">&raquo;</span>
       <span class="sr-only">Next</span>
     </a>
   </li>
   <?php
 }
 else
 {
  ?>
  <li class="page-item disabled">
    <a class="page-link" href="#" tabindex="-1">
      <span aria-hidden="true">&raquo;</span>
      <span class="sr-only">Next</span>
    </a>
  </li>
  <?php
}
?>
</ul>
</nav>
</div>

<?php

?>
</div>
<!-- Grid row -->

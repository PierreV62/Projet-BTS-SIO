<?php
$nom = $_SESSION['utilisateur']['nom'];
$prenom =$_SESSION['utilisateur']['prenom'];
$rue = $_SESSION['utilisateur']['rue'];
$cp = $_SESSION['utilisateur']['cp'];
$ville = $_SESSION['utilisateur']['ville'];
$tel = $_SESSION['utilisateur']['tel'];
$email = $_SESSION['utilisateur']['email'];
$latitude = $_SESSION['utilisateur']['latitude'];
$longitude = $_SESSION['utilisateur']['longitude'];
$adresse = "$rue $cp $ville";
?>
<br/>
<br/>
<center>
  <div class="col-8">
    <div class="card">
      <div class="card-block">
        <!--Header-->
        <div class="form-header  purple darken-4">
          <h3><i class="fa fa-lock"></i>Inscription:</h3>
        </div>
        <!--Body-->
        <form id="register" class="ajax-auth" action='index.php?module=utilisateur&action=profil' method="post">
         <div class="md-form"><i class="fa fa-user active"></i>
          <label for="idNom" class="active">Nom:* </label>
          <input class="form-control" type="text" name="nom" id="idNom" placeholder="Votre nom ..." value="<?php echo($nom); ?>">
        </div>
        <div class="md-form"><label for="idPrenom" class="active">*Prénom: </label>
          <input class="form-control" type="text" name="prenom" id="idPrenom" placeholder="Votre prénom..." value="<?php echo($prenom); ?>">
        </div>
        <div class="md-form">
          <i class="fa fa-envelope active"></i>
          <label for="idEmail" class="active">Email:* </label>
          <input class="form-control" type="text" name="email" id="idEmail" placeholder="Votre mail..." value="<?php echo($email); ?>">
        </div>
        <datalist id="listeDesAdresses"></datalist>
        <div class="md-form">
          <i class="fa fa-home active"></i>
          <label for="idAdresse" class="active">Adresse:*</label>
          <input type="text" name="adresse" id="idAdresse" placeholder="Adresse" class="ui-autocomplete-input" autocomplete="off" value="<?php echo($adresse); ?>">
        </div>
        <div class="md-form">
          <i class="fa fa-home active"></i>
          <label for="idRue" class="active">Rue: </label>
          <input class="form-control" type="text" name="rue" id="idRue" placeholder="rue..." value="<?php echo($rue); ?>">
        </div>
        <div class="md-form">
          <label for="idCP" class="active">*Code postal: </label>
          <input class="form-control" type="text" name="cp" id="idCP" placeholder="Votre code postal..." value="<?php echo($cp); ?>">
        </div>
        <div class="md-form">
          <label for="idVille" class="active">*Ville: </label>
          <input class="form-control" type="text" name="ville" id="idVille" placeholder="Votre ville..." value="<?php echo($ville); ?>">
        </div>
        <div class="md-form">
          <i class="fa fa-phone active"></i>
          <label for="idTel" class="active">Téléphone: </label>
          <input class="form-control" type="text" name="tel" id="idTel" placeholder="Votre numéro..." value="<?php echo($tel); ?>">
        </div>
        <div class="md-form">
          <label for="idLatitude"></label>
          <input class="form-control" type="hidden" name="latitude" id="idLatitude" placeholder="" value="<?php echo($latitude); ?>">
        </div>
        <div class="md-form">
          <label for="idLongitude"></label>
          <input class="form-control" type="hidden" name="longitude" id="idLongitude" placeholder="" value="<?php echo(longitude); ?>">
        </div>                 
        <div class="text-center">
          <button type="submit" name="modifierProfil" class=" btn btn-unique waves-effect waves-light">Confirmer</button>
        </div>
      </form>
    </div>
    <!--Footer-->
    <div class="modal-footer">
    </div>
  </div>
</div>

<!-- SCRIPTS -->

<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

<!-- Bootstrap dropdown -->
<script type="text/javascript" src="js/popper.min.js"></script>

<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>

<script type="text/javascript" src="js/jqueryAdresse.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">

    //auto complément de l'adresse ville et code postal
    $("#idAdresse").autocomplete({
      source: function (request, response) {
        $.ajax({
          url: "https://api-adresse.data.gouv.fr/search/?limit=5",
          data: { q: request.term },
          dataType: "json",
          success: function (data) {
            response($.map(data.features, function (item) {
              return { label: item.properties.label, postcode: item.properties.postcode,city: item.properties.city, value: item.properties.label, street: item.properties.street, name: item.properties.name, latitude: item.geometry.coordinates[1],longitude: item.geometry.coordinates[0]};
            }));
          }
        });
      },
      select: function(event, ui) {
        $('#idCP').val(ui.item.postcode);
        $('#idVille').val(ui.item.city);
        if(ui.item.street)
          $('#idRue').val(ui.item.street);
        else
          $('#idRue').val(ui.item.name);
        $("#idLatitude").val(ui.item.latitude);
        $("#idLongitude").val(ui.item.longitude);
      }
    });

  </script>

</center>
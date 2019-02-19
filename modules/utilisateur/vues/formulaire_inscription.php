<?php
$_SESSION['role'] = $_GET['role'];
?>
<br/>
<br/>
<center>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-block">
        <!--Header-->
        <div class="form-header  purple darken-4">
          <h3><i class="fa fa-lock"></i>Inscription:</h3>
        </div>
        <!--Body-->
        <form id="register" class="ajax-auth" action='index.php?module=utilisateur&action=inscription' method="post">
         <div class="md-form"><i class="fa fa-user active"></i>
          <label for="idNom" class="active">Nom:* </label>
          <input class="form-control" type="text" name="nom" id="idNom" placeholder="Votre nom ..." value="">
        </div>
        <div class="md-form"><label for="idPrenom" class="active">*Prénom: </label>
          <input class="form-control" type="text" name="prenom" id="idPrenom" placeholder="Votre prénom..." value="">
        </div>
        <div class="md-form">
          <i class="fa fa-envelope active"></i>
          <label for="idEmail" class="active">Email:* </label>
          <input class="form-control" type="text" name="email" id="idEmail" placeholder="Votre mail..." value="">
        </div>
        <div class="md-form">
          <i class="fa fa-lock active"></i>
          <label for="idPasswd1" class="active">Mot de passe:* </label>
          <input class="form-control" type="password" name="password" id="idPassword" placeholder="Choisissez un mot de passe..." value="">
        </div>
        <div class="md-form">
          <label for="idPasswd1" class="active">Mot de passe(confirmation):* </label>
          <input class="form-control" type="password" name="passverif" id="idpassverif" placeholder="Confirmez" value="">
        </div>
        <datalist id="listeDesAdresses"></datalist>
        <div class="md-form">
          <i class="fa fa-home active"></i>
          <label for="idAdresse" class="active">Adresse:*</label>

          <input required="" type="text" name="adresse" id="idAdresse" placeholder="Adresse" value="" class="ui-autocomplete-input" autocomplete="off">
        </div>
        <div class="md-form">
          <i class="fa fa-home active"></i>
          <label for="idRue" class="active">Rue: </label>
          <input class="form-control" type="text" name="rue" id="idRue" placeholder="rue..." value="">
        </div>
        <div class="md-form">
          <label for="idCP" class="active">*Code postal: </label>
          <input class="form-control" type="text" name="cp" id="idCP" placeholder="Votre code postal..." value="">
        </div>
        <div class="md-form">
          <label for="idVille" class="active">*Ville: </label>
          <input class="form-control" type="text" name="ville" id="idVille" placeholder="Votre ville..." value="">
        </div>
        <div class="md-form">
          <i class="fa fa-phone active"></i>
          <label for="idTel" class="active">Téléphone: </label>
          <input class="form-control" type="text" name="tel" id="idTel" placeholder="Votre numéro..." value="">
        </div>
        <div class="md-form">
          <label for="idLatitude"></label>
          <input class="form-control" type="hidden" name="latitude" id="idLatitude" placeholder="" value="">
        </div>
        <div class="md-form">
          <label for="idLongitude"></label>
          <input class="form-control" type="hidden" name="longitude" id="idLongitude" placeholder="" value="">
        </div>
        <div class="md-form">
          <label for="idRole"></label>
          <input class="form-control" type="hidden" name="role" id="idRole" placeholder="" value="">
        </div>                  
        <div class="text-center">
          <button type="submit" class=" btn btn-unique waves-effect waves-light">S'inscrire</button>
        </div>
      </form>
    </div>
    <!--Footer-->
    <div class="modal-footer">
      <div class="options">
        <p>Vous avez déjà un compte? <a href='index.php?module=utilisateur&amp;action=connexion'>Se connecter</a></p>
      </div>
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
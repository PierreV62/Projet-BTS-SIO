
<br/>
<br/>
<center>
  <div class="col-8">
    <div class="card">
      <div class="card-block">
        <!--Header-->
        <div class="form-header  purple darken-4">
            <h3><i class="fa fa-lock"></i>Mot de passe :</h3>
        </div>
        <!--Body-->
        <form id="login" class="ajax-auth" action="index.php?module=utilisateur&action=profil" method="post">
          <div class="md-form">
            <i class="fa fa-lock prefix"></i>
            <input type="password" id="ancienMDP" class="form-control" name="ancienMDP" required="">
            <label for="ancienMDP">Ancien mot de passe :</label>
          </div>
          <div class="md-form">
              <i class="fa fa-lock prefix"></i>
              <input type="password" id="nouveauMDP1" class="form-control" name="nouveauMDP1" required="">
              <label for="nouveauMDP1">Mot de passe :</label>
          </div>
          <div class="md-form">
            <i class="fa fa-lock prefix"></i>
            <input type="password" id="nouveauMDP2" class="form-control" name="nouveauMDP2" required="">
            <label for="nouveauMDP2">Confirmation mot de passe :</label>
          </div>
          <div class="text-center">
            <button class="submit_button btn btn-primary" type="submit" name="changeMDP" value="connexion">Confirmer</button>
          </div>
        </form>
      </div>
      <!--Footer-->
      <div class="modal-footer">
      </div>
    </div>
  </div>
</center>

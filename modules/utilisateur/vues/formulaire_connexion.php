
<br/>
<br/>
<center>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-block">
        <!--Header-->
        <div class="form-header  purple darken-4">
            <h3><i class="fa fa-lock"></i>Authentification:</h3>
        </div>
        <!--Body-->
        <form id="login" class="ajax-auth" action="index.php?module=utilisateur&action=connexion" method="post">
          <div class="md-form">
            <i class="fa fa-user prefix"></i>
            <input type="text" id="email" class="form-control" name="email" required="">
            <label for="email">Adresse email :</label>
          </div>
          <div class="md-form">
              <i class="fa fa-lock prefix"></i>
              <input type="password" id="password" class="form-control" name="password" required="">
              <label for="password">Mot de passe :</label>
          </div>
          <div class="text-center">
            <button class="submit_button btn btn-primary" type="submit" value="connexion">Se Connecter</button>
          </div>
        </form>
      </div>
      <!--Footer-->
      <div class="modal-footer">
      </div>
    </div>
  </div>
</center>

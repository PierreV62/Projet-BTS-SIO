<br />
<br />
<div class="bd-example" role="tabpanel">
  <div class="row">
    <div class="col-3">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-dashboard-list" data-toggle="tab" href="#list-dashboard" role="tab" aria-controls="list-dashboard">Dashboard</a>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="tab" href="#list-profile" role="tab" aria-controls="list-profile">Modifier le profile</a>
        <a class="list-group-item list-group-item-action" id="list-pwd-list" data-toggle="tab" href="#list-pwd" role="tab" aria-controls="list-pwd">Changer mot de passe</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="tab" href="#list-settings" role="tab" aria-controls="list-settings">Settings</a>
      </div>
    </div>
    <div class="col-8">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-dashboard" role="tabpanel" aria-labelledby="list-dashboard-list">
          <?php include CHEMIN_VUE.'profil_infos_utilisateur.php'; ?>

        </div>
        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
          <?php include CHEMIN_VUE.'formulaire_modifierProfil.php'; ?>
        </div>
        <div class="tab-pane fade" id="list-pwd" role="tabpanel" aria-labelledby="list-pwd-list">
            <?php include CHEMIN_VUE.'formulaire_changerMDP.php'; ?>         
        </div>
        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
          <p>...</p>
        </div>
      </div>
    </div>
  </div>
</div>
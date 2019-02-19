 <br/>
<br/>
<center>
  <div class="col-lg-6">
  	<div class="card">
  		<div class="card-block">
  			<!--Header-->
  			<div class="form-header  purple darken-4">
  				<h3><i class="fa fa-envelope"></i>Nous contacter:</h3>
  			</div>
  			<form id="contact" class="ajax-auth" action='index.php?module=contact&action=Contact' method="post">
  				<div class="md-form">
  					<i class="fa fa-user prefix grey-text"></i>
  					<input required="" name="nom" type="text" id="form3" class="form-control" required="">
  					<label for="form3">Votre nom</label>
  				</div>

  				<div class="md-form">
  					<i class="fa fa-envelope prefix grey-text"></i>
  					<input required="" name="email" type="email" id="form2" class="form-control" required="">
  					<label for="form2" class="">Votre email</label>
  				</div>

  				<div class="md-form">
  					<i class="fa fa-tag prefix grey-text"></i>
  					<input required="" name="subject" type="text" id="form32" class="form-control" required="">
  					<label for="form34">Sujet</label>
  				</div>

  				<div class="md-form">
  					<i class="fa fa-pencil prefix grey-text"></i>
  					<textarea required="" name="body" type="text" id="form8" class="md-textarea" style="height: 100px" required=""></textarea>
  					<label for="form8">Votre message</label>
  				</div>

  				<div class="text-center">
  					<button class="btn btn-unique waves-effect waves-light">Envoyer<i class="fa fa-paper-plane-o ml-1"></i></button>
  				</div>

  			</form>
  		</div>
  	</div>
  </div>
</center>
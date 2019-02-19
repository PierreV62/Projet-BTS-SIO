<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>New World</title>



    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

  <!-- SCRIPTS -->
    <!-- JQuery -->
    <script src="js/jquery-3.3.1.js"></script>
    <!-- Bootstrap tooltips -->
    <script src="js/tether.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script src="js/mdb.min.js"></script>


<script>

//affiche les formulaires correspondant au type d'utilisateur demandé
function afficherForm(etat1,etat2){
  document.getElementById('pr').style.visibility=etat1;
  document.getElementById('pv').style.visibility=etat2;
}

function valider_tel() {
  var nombre = document.getElementById("idTel").value;
  var chiffres = new String(nombre);
  // Enlever tous les charactères sauf les chiffres
  chiffres = chiffres.replace(/[^0-9]/g, '');
  // Le champs est vide
  if ( nombre == "" )
  {
    alert ( "Le champs est vide !" );
    return;
  }
  // Nombre de chiffres
  compteur = chiffres.length;
  if (compteur!=10)
  {
    alert("Assurez-vous de rentrer un numéro à 10 chiffres (xxx-xxx-xxxx)");
    return;
  }
  else
  {
    alert("Le numéro me semble bon !");
  }
}

function remplirListeDesProduits(noRayon)
  {
    //alert("chgt de rayon");
    //alert("le rayon:"+noRayon+" est demandé");
    var request = $.ajax({
    //url: "http://petersonr.hol.es/newWorld/wsListeDesProduitsDuRayon.php",
    url: "wsListeDesProduitsDuRayon.php",
    method: "GET",
    data: { idRayon : noRayon }
    });

      //element html de type select qui contiendra les produits du rayon
      var listeDesProduits=$("#produit");
      //vider la liste des produits
      $(listeDesProduits).html("");


      //element html de type select qui contiendra les varietes du produit
      var listeDesVarietes=$("#variete");
      //vider la liste des produits
      $(listeDesVarietes).html("");

    //lors de la reception du json
    request.done(function(reponse)
    {
      //pour chaque categ du rayon
      //alert(reponse);
      var tabProduits=JSON.parse(reponse);


      $.each(tabProduits, function( i,produit) 
      {
        //alert(produit.libelleProduit);
        //ajout du produit obtenu à la liste
        //création de l'option
        var nouveauProduit=document.createElement("option");
        //valorisation de l'attribut value de l'option
        $(nouveauProduit).attr("value",produit.idProduit);
        //mise en place du libellé du produit
        $(nouveauProduit).html(produit.libelleProduit);
        //ajout de l'option à la select
        $(listeDesProduits).append(nouveauProduit);

      });//fin du pour chaque produit
    });//fin reception du json
    request.fail(function( msg ) 
    {
      alert("Pas de produit dans ce rayon");
    });
  }//fin de la fonction remplirListeDesProduitsDuRayon

  function remplirListeDesVarietes(noProduit)
  {

    var request = $.ajax({
    //url: "http://petersonr.hol.es/newWorld/wsListeDesVarietesDuProduit.php",
    url: "wsListeDesVarietesDuProduit.php",
    method: "GET",
    data: { idProduit : noProduit }
    });

    //element html de type select qui contiendra les produits du rayon
      var listeDesVarietes=$("#variete");
      //vider la liste des produits
      $(listeDesVarietes).html("");

    //lors de la reception du json
    request.done(function(reponse)
    {
      //pour chaque categ du rayon
      var tabVarietes=JSON.parse(reponse);
      

      $.each(tabVarietes, function( i,variete) 
      {
        //ajout de la variete obtenu à la liste
        //création de l'option
        var nouvelleVariete=document.createElement("option");
        //valorisation de l'attribut value de l'option
        $(nouvelleVariete).attr("value",variete.idVariete);
        //mise en place du libellé du variete
        $(nouvelleVariete).html(variete.libelleVariete);
        //ajout de l'option à la select
        $(listeDesVarietes).append(nouvelleVariete);

      });//fin du pour chaque variete
    });//fin reception du json
    request.fail(function( msg ) 
    {
      alert("Pas de variete dans ce produit");
    });
  }//fin de la fonction remplirListeDesVarietes
</script>
</head>
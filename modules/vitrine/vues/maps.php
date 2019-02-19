<style type="text/css">
.niveau2{margin-left:15px !important;}
.niveau3{margin-left:15px !important;}
.badge{width: 130px;}
</style>
<?php


if(!$point_departement)
{
?>
<div class="alert alert-info alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Info!</strong> Choisissez vos points de ventes favories où vous viendrez récupérer vos produits.
  </div>
<?php 
}
 else
{
 ?>
 	<div class="alert alert-danger alert-dismissible">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	<strong>Attention!</strong> Il n'y a aucun point de vente dans votre département ou vous les avez déjà mis en favoris.
  	</div>

<?php
 	}
 ?>
<a href="index.php?module=vitrine&action=catalogue" type="button" class="btn peach-gradient btn-lg bg-primary">Accéder aux produits</a>
<div id="EmplacementDeMaCarte"></div>

		<noscript>
			<p>Attention : </p>
			<p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
			<p>Or, il semble que JavaScript est désactivé ou qu'il ne soit pas supporté par votre navigateur.</p>
			<p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
		</noscript>


<!-- script pour l'API de google -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1H2GdqzMpty57RJV_9E7XqG9EHMDa-HU"></script>
<!-- paramètres de la carte -->
<script type="text/javascript">

	var locations = <?php echo json_encode($infos_pointDeVente); ?>;
	var test_département = <?php echo json_encode($point_departement); ?>;

	if(locations.length >0 && !test_département)
	{
		var optionsCarte = {
			zoom: 9,
			center: new google.maps.LatLng(locations[0].latitude, locations[0].longitude),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: true,
			zoomControl: true
		}

	}
	else
	{
		var optionsCarte = {
			zoom: 6,
			center: new google.maps.LatLng(48, 2),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: true,
			zoomControl: true
		}
	}
		var map = new google.maps.Map(document.getElementById("EmplacementDeMaCarte"), optionsCarte);

    //var infowindow = new google.maps.InfoWindow();

    var marker, i;


    for (i = 0; i < locations.length; i++) {  

      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i].latitude, locations[i].longitude),
        map: map,
        title: locations[i].nomPoint
      });

      (function(marker, i) {

            // add click event
            var contentString = '<div id="content">'+
            '<h4 id="firstHeading" class="firstHeading"> ' + locations[i].nomPoint + ' </h4> <br />'+
            '<table>'+
            '<tr>'+
            '<td>'+
            '<p>' + locations[i].ruePoint + '</p <br />' +
            '<p>' + locations[i].cpPoint + ' ' + locations[i].villePoint+'</p> <br />' +
            '<p> <a class="nav-link" href=\'index.php?module=vitrine&action=maps&point=' + locations[i].idPoint +'\'>Ajouter au favoris</a>'+
            '</td>'+
            '<td>'+
            '<p>'+ locations[i].cpPoint +' </p>'+
            '</td>'
            '</tr>'+
            '</table>'+
            '</div>';
            google.maps.event.addListener(marker, 'click', function() {
                infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                infowindow.open(map, marker);
            });
        })(marker, i);
    }
</script>
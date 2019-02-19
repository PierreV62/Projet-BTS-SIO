<style type="text/css">
.niveau2{margin-left:15px !important;}
.niveau3{margin-left:15px !important;}
.badge{width: 130px;}
</style>

<div id="EmplacementDeMaCarte"></div>
		<noscript>
			<p>Attention : </p>
			<p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
			<p>Or, il semble que JavaScript est désactivé ou qu'il ne soit pas supporté par votre navigateur.</p>
			<p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
		</noscript>
		
<div class="container">
	<div class="row">
		<div id="gauche" class="col-lg-2"> 
			<br/><br/> 
			<div id="monmenu">
				<ul class="niveau1">
<?php 
					foreach($rayons as $rayon) {
					$idRayon=$rayon['idRayon'];
					$libelleRayon=$rayon['libelleRayon'];
					echo "<li><span class='badge  light-blue darken-3'><h6>$libelleRayon</h6></span>";
?>
						<ul class="niveau2">
<?php 
						if(isset($rayon['produit']))
						{
							foreach($rayon['produit'] as $produit)
							{
							$idProduit=$produit['idProduit'];
							$libelleProduit=$produit['libelleProduit'];
							echo "<li><span class='badge light-blue darken-2'><h6>$libelleProduit</h6></span>";
?>
								<ul class="niveau3">
<?php 
								if(isset($produit['variete']))
								{
									foreach($produit['variete'] as $variete)
									{
									$idVariete=$variete['idVariete'];
									$libelleVariete=$variete['libelleVariete'];   				
									echo "<li><span class='badge  light-blue lighten-1'><a href='index.php?module=commerce&action=produit&produit=$idVariete'><h6>$libelleVariete</h6></a></span></li>";
?>
									</li>
<?php
									}						
								}
?>
								</ul>
							</li>
<?php
							}
						}
?>
			    		</ul>
					</li>
<?php
					}					
?>
				</ul>
			</div>
		</div>
<?php
require_once CHEMIN_MODELE.'commerce.php';
$infos_pointDeVente = chargerTousPoints();

if($infos_pointDeVente)
{
	$_SESSION['pointDeVente'] = $infos_pointDeVente;


}
var_dump($infos_pointDeVente);

?>

<!-- script pour l'API de google -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1H2GdqzMpty57RJV_9E7XqG9EHMDa-HU"></script>
<!-- paramètres de la carte -->
<script type="text/javascript">
   /* var locations = [
      ['Bondi Beach', -33.890542, 151.274856, 4],
      ['Coogee Beach', -33.923036, 151.259052, 5],
      ['Cronulla Beach', -34.028249, 151.157507, 3],
      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
      ['Maroubra Beach', -33.950198, 151.259302, 1]
    ];
	*/

	var locations = <?php echo json_encode($infos_pointDeVente); ?>;

	var optionsCarte = {
			zoom: 6,
			center: new google.maps.LatLng(48, 2),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: true,
			zoomControl: true
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
            '<div id="siteNotice">'+
            '</div>'+
            '<h4 id="firstHeading" class="firstHeading"><a href="https://en.wikipedia.org/w/ndex.php?title=Uluru&oldid=297882194"></h4>'+
            '<div id="bodyContent">'+
            '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
            'sandstone rock formation in the southern part of the '+
            'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
            'south west of the nearest large town, Alice Springs; 450&#160;km '+
            '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '+
            'features of the Uluru - Kata Tjuta National Park. Uluru is '+
            'sacred to the Pitjantjatjara and Yankunytjatjara, the '+
            'Aboriginal people of the area. It has many springs, waterholes, '+
            'rock caves and ancient paintings. Uluru is listed as a World '+
            'Heritage Site.</p>'+
            '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
            'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
            '(last visited June 22, 2009).</p>'+
            '</div>'+
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
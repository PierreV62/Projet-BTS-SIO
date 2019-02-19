<div class="container text-center">
<table border="0" cellspacing="0" cellpadding="4">
<tr>
  <th align="center">Référence</th>
  <th align="center">Stock</th>
  <th align="center">Prix Unitaire</th>
  <th align="center">Montant</th>
  <th align="center">Point de vente</th>
</tr>
<?php
	$total=0;
	foreach ($produits as $produit) {
		$ref=$produit["ref"];
		$stock=$produit["stock"];
		$qte=$produit["quantite"];
		$unite=$produit["unite"];
		$prix=$produit["prix"];
		$points = $produit["pointDeVente"];
		//$des=$infos_panier[0][$i]["description"];
		$montant=$qte*$prix;
		$total=$total+$montant;
		echo '<tr><td >'.$ref.'</td>';
		echo '<td align="right">'.$stock.' '.$unite.'</td>';
		echo '<td align="right">'.$prix.' &euro;</td>';
		echo '<td align="right">'.$montant.' &euro;</td>';
		echo "<td align='right'>

		<form id=\'ajout\'>
			            <div class='form-group'>
              <select class='form-control' id='point' name='point'>";
                foreach ($points as $lePoint) {
      
                  echo "<option value=".$lePoint['idPoint'].">".$lePoint['nomPoint']."</option>";
                }
              
              echo "</select>
            </div>
        </form>

		</td>";
		echo "<td align='left'>
		<form id='ajout' action='index.php?module=panier&action=gestion_panier' method='post'>
			<input type='hidden' name='id' value=$ref />
      		<input type='hidden' name='operation' value='Ajouter au panier' />
			<div class='row col-lg-12'>
          		<div class='col-lg-6'>
	            	<input type='number' id='quantite' class='form-control' name='quantite' min='1' value=\"".$qte."\"/>
	       		</div>
	       		<div class='col-lg-6'>
	            	<button class='submit_button btn btn-primary' type='submit' value='ajout' title='Ajouter au panier'><i class='fa fa-plus'></i></button>
				</div>
			</div>
        </form>
        </td>";
        echo "<td align='left'>
		<form id='ajout' action='index.php?module=panier&action=gestion_panier' method='post'>
			<input type='hidden' name='id' value=$ref />
      		<input type='hidden' name='operation' value='Supprimer du panier' />
			<div class='row col-lg-12'>
	       		<div class='col-lg-6'>
	            	<button class='submit_button btn btn-primary' type='submit' value='ajout' title='Supprimer du panier'><i class='fa fa-minus'></i></button>
				</div>
			</div>
        </form>
        </td>";
    }
	  echo '<tr>';
	  echo '<td align="right" colspan="4">Total</td>';
	  echo '<td align="right">'.$total.' &euro;</td>';
	  echo '</tr>';
	  echo "
	    </table>
	    </div>
	    <div class='large-4 columns'>
		 <a href='index.php?module=vitrine&action=catalogue'>
		 <button class='submit_button btn btn-primary' type='submit' value='ajout' title='Retour au catalogue'><i class='fa fa-shopping-basket'></i></button>
		 </a>
		 <a href='index.php?module=vitrine&action=catalogue'>
		 <button class='submit_button btn btn-primary' type='submit' value='ajout' title='Passer la commande'><i class='fa fa-shopping-cart'></i></button>
		 </a>
        </div";
		  //echo $formViderPanier;
		  //echo $formVCommander;
     ?>
</div>

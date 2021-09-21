<?php
	function afficherPanier(){

			if(isset($_SESSION["paiement"])){
				echo '<p style="color:'.$_SESSION["color"].';">'.$_SESSION["paiement"].'</p>';
				unset($_SESSION["color"]);
				unset($_SESSION["paiement"]);
			}
			else{
				if(isset($_COOKIE["panier"])){
						include("Donnees.inc.php");
						
						$arr = json_decode($_COOKIE["panier"],true);
						echo '<table>';
						echo "<tr><td width='50px'>ID</td><td width='80px'>Titre</td><td width='80px'>Prix</td></tr>"; 
						echo "<tr><td colspan='3'><hr></td></tr>";
						$pos = 0;
						foreach($arr as $item){
									echo "<tr>";
									echo "<td id='item'>".$item."</td><td> ".$Albums[$item]["titre"]."</td><td> ".$item."</td>";
									echo '<td><button onclick="removePanier('.$item.','.$pos.')">effacer</button></td>';
									echo "</tr>";
									echo "<tr><td colspan='3'><hr></td></tr>";	
									$pos++;
							}

									
						
						echo '</table>';
					}
					else{
						echo '<p>Pas de produits dans votre panier</p>';
					}
				}
			}
	
?>
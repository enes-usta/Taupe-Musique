<?php
	function afficherPanier(){

			if(isset($_SESSION["paiement"])){
				echo '<p style="color:'.$_SESSION["color"].';">'.$_SESSION["paiement"].'</p>';
				unset($_SESSION["color"]);
				unset($_SESSION["paiement"]);
			}
			else{
                $db = Database();
                $req = $db->prepare("SELECT IDPROD,NBPROD FROM PANIER p WHERE p.LOGIN = :login");
                $req->execute(array(
                    ':login' => $_SESSION["user"]
                    ));
                $result = $req->fetchAll(PDO::FETCH_ASSOC);
				if(!empty($result)){
						include("Donnees.inc.php");
						
						//$arr = json_decode($result,true);
						echo '<table>';
						echo "<tr><td width=100px></td><td width='50px'>ID</td><td width='80px'>Titre</td><td width='80px'>Prix</td><td width='80px'>Quantité</td></tr>";
						echo "<tr><td colspan='3'><hr></td></tr>";
						$pos = 0;
						foreach($result as $inter) {
                            foreach ($inter as $value => $item) {
                                if ($value == 'IDPROD') {
                                    echo "<tr>";
                                    echo '<td><button onclick="removePanier(' . $item . ',' . $pos . ')">effacer</button></td>';
                                    echo "<td id='item'>" . $item . "</td><td> " . $Albums[$item]["titre"] . "</td><td> " . $Albums[$item]["prix"] . "</td>";
                                }
                                if ($value == 'NBPROD') {
                                    echo "<td>" . $item . "</td>";
                                    echo "</tr>";
                                    echo "<tr><td colspan='3'><hr></td></tr>";
                                    $pos++;
                                }
                            }
                        }

						echo '</table>';
					}
					else{
						echo '<p>Pas de produits dans votre panier</p>';
					}
				}
			}
	
?>
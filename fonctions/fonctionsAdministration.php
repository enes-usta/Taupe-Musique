<?php


function uploadFichier()
{
    if (isset($_FILES['xml'])) {
        $fichier = 'upload/' . basename($_FILES['xml']['name']);

        if (move_uploaded_file($_FILES['xml']['tmp_name'], $fichier)) {
            construireBdd();
        } else {
            $_SESSION['message'] = '<div style="text-align:center"><h1>Echec de l\'envoi du fichier xml.</h1><br /><br /><a href="index.php">Cliquez ici pour retourner � l\'administration.</a></div>';
            header('Location: message.php');
        }

        unlink($fichier);
    }
}

//on s'assure que chaque produit poss�de les propr�t�s Libelle, Prix et UniteDeVente
function xmlValide($dom)
{
    $produitList = $dom->getElementsByTagName('Produit');
    foreach ($produitList as $produit) {
        $estValide['Libelle'] = false;
        $estValide['Prix'] = false;
        $estValide['UniteDeVente'] = false;

        $proprieteList = $produit->getElementsByTagName('Propriete');
        foreach ($proprieteList as $propriete) {
            if ($propriete->getAttribute('nom') == 'Libelle') $estValide['Libelle'] = true;

            if ($propriete->getAttribute('nom') == 'Prix') $estValide['Prix'] = true;

            if ($propriete->getAttribute('nom') == 'UniteDeVente') $estValide['UniteDeVente'] = true;
        }

        if (!$estValide['Libelle']) {
            $_SESSION['message'] = '<div style="text-align:center"><h1>Erreur ligne ' . $propriete->getLineNo() . '. Le produit n\'a pas de propri�t� Libelle.</h1><br /><br /><a href="index.php">Cliquez ici pour retourner � l\'administration.</a></div>';
            header('Location: message.php');
            exit;
        }

        if (!$estValide['Prix']) {
            $_SESSION['message'] = '<div style="text-align:center"><h1>Erreur ligne ' . $propriete->getLineNo() . '. Le produit n\'a pas de propri�t� Prix.</h1><br /><br /><a href="index.php">Cliquez ici pour retourner � l\'administration.</a></div>';
            header('Location: message.php');
            exit;
        }

        if (!$estValide['UniteDeVente']) {
            $_SESSION['message'] = '<div style="text-align:center"><h1>Erreur ligne ' . $propriete->getLineNo() . '. Le produit n\'a pas de propri�t� UniteDeVente.</h1><br /><br /><a href="index.php">Cliquez ici pour retourner � l\'administration.</a></div>';
            header('Location: message.php');
            exit;
        }
    }
}

//on ins�re une nouvelle rubrique dans la base de donn�es (si la rubrique est d�j� pr�sente alors on insert uniquement les rubriques sup�rieures de fa�on r�cursive)
function insererRub($rub)
{
    $result = mysql_query('select id_rub from rubrique where Libelle_rub ="' . $rub['Nom'] . '"');

    if (mysql_num_rows($result) == 0) {
        mysql_query('insert into rubrique (Libelle_rub) values("' . $rub['Nom'] . '")');
        if (isset($rub['RubriquesSuperieures'])) $result = mysql_query('select id_rub from rubrique where Libelle_rub ="' . $rub['Nom'] . '"');
    }

    if (isset($rub['RubriquesSuperieures'])) {
        $id_rub = mysql_fetch_row($result);

        foreach ($rub['RubriquesSuperieures'] as $libelle) {
            insererRub(array('Nom' => $libelle)); //on ins�re r�cursivement les rubriques sup�rieures dans la base de donn�es

            $result = mysql_query('select id_rub from rubrique where Libelle_rub ="' . $libelle . '"');
            $id_rub_sup = mysql_fetch_row($result);

            mysql_query('insert into hierarchie (id_parent, id_enfant) values("' . $id_rub_sup[0] . '","' . $id_rub[0] . '")');
        }
    }
}

function parserRub($dom)
{
    $ListeRubriques = $dom->getElementsByTagName('ListeRubriques');
    foreach ($ListeRubriques as $LR) {
        $rubriqueList = $LR->getElementsByTagName('Rubrique');
        foreach ($rubriqueList as $rubrique) {
            unset($rub);

            foreach ($rubrique->getElementsByTagName('Nom') as $nom) $rub['Nom'] = utf8_decode($nom->nodeValue);

            $rubSupList = $rubrique->getElementsByTagName('RubriquesSuperieures');
            foreach ($rubSupList as $rubSup) {
                $rubriqueList2 = $rubSup->getElementsByTagName('Rubrique');
                foreach ($rubriqueList2 as $rubrique2) $rub['RubriquesSuperieures'][] = utf8_decode($rubrique2->nodeValue);
            }

            if (isset($rub)) insererRub($rub);
        }
    }
}

function insererProd($prod)
{
    if (!isset($prod['Photo'])) $prod['Photo'] = 'img_encours.jpg';
    if (!isset($prod['Descriptif'])) $prod['Descriptif'] = '';
    if (!isset($prod['Rubriques'])) {
        $prod['Rubriques'][] = 'Divers';
        $result = mysql_query('select id_rub from rubrique where Libelle_rub="Divers"');
        if (mysql_num_rows($result) == 0) mysql_query('insert into rubrique (Libelle_rub) values("Divers")');
    }

    mysql_query('insert into produit (Libelle, Prix, UniteDeVente, Descriptif, Photo) values("' . $prod['Libelle'] . '","' . $prod['Prix'] . '","' . $prod['UniteDeVente'] . '","' . $prod['Descriptif'] . '","' . $prod['Photo'] . '")');

    //on r�cup�re l'id du produit que l'on vient d'ins�rer
    $result = mysql_query('select id_prod from produit where Libelle="' . $prod['Libelle'] . '" order by id_prod DESC');
    $id_prod = mysql_fetch_row($result);

    foreach ($prod['Rubriques'] as $libelle) {
        //On r�cup�re l'id de la rubrique.
        $result = mysql_query('select id_rub from rubrique where Libelle_rub="' . $libelle . '"');
        $id_rub = mysql_fetch_row($result);

        mysql_query('insert into appartient (id_prod, id_rub) values("' . $id_prod[0] . '","' . $id_rub[0] . '")');
    }

    //on supprime des �lements de $prod pour se retrouver avec les propri�t�s que nous n'avons pas encore trait�es
    unset($prod['Libelle']);
    unset($prod['Prix']);
    unset($prod['UniteDeVente']);
    unset($prod['Descriptif']);
    unset($prod['Photo']);
    unset($prod['Rubriques']);

    foreach ($prod as $propriete => $valeur) {
        //On r�cup�re l'id de la propri�t�. Si la propri�t� n'est pas dans la base de donn�es alors on l'insert.
        $result = mysql_query('select id_prop from propriete where libelle_prop="' . $propriete . '"');
        if (mysql_num_rows($result) == 0) {
            mysql_query('insert into propriete (libelle_prop) values("' . $propriete . '")');
            $result = mysql_query('select id_prop from propriete where libelle_prop="' . $propriete . '"');
        }
        $id_prop = mysql_fetch_row($result);

        mysql_query('insert into appartient2 (id_prod, id_prop, valeur_prop) values("' . $id_prod[0] . '","' . $id_prop[0] . '","' . $valeur . '")');
    }
}

function parserProd($dom)
{
    $ListeProduits = $dom->getElementsByTagName('ListeProduits');
    foreach ($ListeProduits as $LP) {
        $produitList = $LP->getElementsByTagName('Produit');
        foreach ($produitList as $produit) {
            unset($prod);

            $proprieteList = $produit->getElementsByTagName('Propriete');
            foreach ($proprieteList as $propriete) $prod[utf8_decode($propriete->getAttribute('nom'))] = utf8_decode($propriete->nodeValue);

            foreach ($produit->getElementsByTagName('Descriptif') as $descriptif) $prod['Descriptif'] = utf8_decode($descriptif->nodeValue);

            foreach ($produit->getElementsByTagName('Rubriques') as $rubriques) {
                foreach ($rubriques->getElementsByTagName('Rubrique') as $rubrique) $prod['Rubriques'][] = utf8_decode($rubrique->nodeValue);
            }

            if (isset($prod)) insererProd($prod);
        }
    }
}

function construireBdd()
{
    $fichier = 'upload/' . basename($_FILES['xml']['name']);
    $dom = new DOMDocument();

    if (!$dom->load($fichier)) die('Impossible de charger le fichier XML');

    xmlValide($dom);

    parserRub($dom);
    parserProd($dom);
}

function afficherAdministration()
{
    extract($_GET);

    //si on a cliqu� sur le bouton envoyer
    if (isset($_POST['envoyer'])) uploadFichier();

    echo '<a href="index.php?action=bdd">Editer la base de donn�es.</a><br /><br />';

    //si on a cliqu� sur "Editer la base de donn�es." alors on affiche ce qui suit
    if (isset($action) && $action == 'bdd') {
        echo '<div style="margin-left:30px">';
        echo '<form method="post" action="index.php" enctype="multipart/form-data">';
        echo '<div>';
        echo '<label>Fichier: </label><input type="file" name="xml"/>
						 <input type="submit" name="envoyer" value="Envoyer"/>';
        echo '</div>';
        echo '</form>';
        echo '</div><br /><br />';
    }

    echo '<a href="produits.php">Gestion de produits</a><br/><br/>';
    echo '<a href="utilisateurs.php">Gestion d\'utilisateurs</a><br/><br/>';

    echo '<a href="index.php?action=commande">Visualiser les commandes.</a><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';

    //si on a cliqu� sur "Visualiser les commandes." alors on affiche ce qui suit
    if (isset($action) && $action == 'commande') {
        echo '<form action="index.php?action=commande" method="post"><div class="floatRight">';
        $result = mysql_query('select * from commande order by id_com DESC');

        echo '<label>N� commande: </label><select name="id_com">';

        while ($commande = mysql_fetch_assoc($result)) {
            if (isset($_POST['id_com']) && $_POST['id_com'] == $commande['id_com']) echo '<option selected="selected">' . $commande['id_com'] . '</option>';
            else echo '<option>' . $commande['id_com'] . '</option>';
        }

        echo '</select>';

        echo '<input id="submit" name="voir" type="submit" value="Voir" style="margin:0px"/>';
        echo '</div></form>';

        //si on a cliqu� sur voir
        if (isset($_POST['voir'])) {
            $result = mysql_query('select * from commande where id_com="' . $_POST['id_com'] . '"');

            $commande = mysql_fetch_assoc($result);

            $date = getdate($commande['date']);

            echo '<br /><br /><div class="article">
				#' . $_POST['id_com'] . '<br />
				Date: ' . $date['mday'] . '/' . $date['mon'] . '/' . $date['year'] . ' � ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'] . '<br /><br />' .
                $commande['civilite'] . '. ' . ucfirst(strtolower($commande['prenom'])) . ' ' . strtoupper($commande['nom']) . '<br />' .
                $commande['adresse'] . '<br />' .
                $commande['cp'] . '<br />' .
                $commande['ville'] . '<br />' .
                $commande['telephone'] . '
				</div><br /><br />';

            $result = mysql_query('select * from detail where id_com="' . $_POST['id_com'] . '"');

            echo '<div class="entetePanier" style="width:90px">Prix</div>
				<div class="entetePanier" style="width:70px; border-right:none">Quantit�</div>
				<div class="entetePanier" style="width:94px; border-right:none">Prix unitaire</div>';

            $i = 1;
            $nbArticle = mysql_num_rows($result);

            while ($article = mysql_fetch_assoc($result)) {
                $result2 = mysql_query('select Libelle, Prix from produit where id_prod="' . $article['id_prod'] . '"');
                $info = mysql_fetch_assoc($result2);

                $detail[$article['id_prod']]['Quantite'] = $article['quantite'];
                $detail[$article['id_prod']]['Libelle'] = $info['Libelle'];
                $detail[$article['id_prod']]['Prix'] = $info['Prix'];
            }

            foreach ($detail as $id_prod => $article) {
                echo '<div class="panier"';
                if ($i != $nbArticle) echo ' style="border-bottom:none"';

                echo '>
						<div style="float: left; padding: 5px; width:421px">' . $article['Libelle'] . '</div>						
						<div class="colonnePanier" style="width:94px; padding-top:17px;">' . $article['Prix'] . ' �</div>						
						<div class="colonnePanier" style="width:70px; padding-top:17px;">' . $article['Quantite'] . '</div>						
						<div class="colonnePanier" style="width:90px; padding-top:17px;">' . $article['Prix'] * $article['Quantite'] . ' �</div>					
					</div>';

                $i++;
            }

            $total = 0;

            foreach ($detail as $article) $total += $article['Prix'] * $article['Quantite'];

            echo '<div class="piedPanier">' . $total . ' �</div>';
        }
    }
}

?>
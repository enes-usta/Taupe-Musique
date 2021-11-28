<?php

function afficherAdmin()
{
    if (isAdmin()) {
        echo '<a href="produits.php"><h4>Gestion de produits</h4></a><br/>';
        echo '<a href="utilisateurs.php"><h4>Gestion d\'utilisateurs</h4></a><br/>';
        echo '<a href="commandes.php"><h4>Visualiser les commandes<h4></a>';
    }
}

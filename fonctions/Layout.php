<?php
function afficherCadreCompte()
{
    ?>
    <div style="padding-left:8px; padding-right:8px;">
        <?= isAdmin() ? "<a class='btn btn-default' href='/admin'>Administration</a><br /><br />" : "" ?>
        <?= isLogged() ? '<a class="btn btn-default" href="'.parse_url('/profil.php', PHP_URL_PATH).'">Mon compte</a><br/><br/>' : '' ?>
    </div>
    <?php
}
/*
function afficherMenuGauche()
{
    echo '<ul class="menuh">';

    $result = mysql_query('SELECT id_rub, Libelle_rub FROM rubrique WHERE id_rub NOT IN (SELECT id_enfant FROM hierarchie)');
    while ($rub = mysql_fetch_row($result)) echo '<li><a href="index.php?id_rub=' . $rub[0] . '&amp;source=menu" title="">' . $rub[1] . '</a></li> ';

    echo '</ul>';
}
function afficherBarreRecherche()
{
    echo '<span style="color:#1db6f6; font-weight:bold; float:left; padding-left:13px">Recherche</span>';
    echo '<form action="index.php" method="post">';
    echo '<div style="width:168px"><input type="text" id="recherche" name="recherche"/></div>';
    echo '</form>';
}

function afficherCadrePanier()
{
    echo '<a href="panier.php';

    if (isset($_GET['id_rub'])) echo '?id_rub=' . $_GET['id_rub'];

    echo '"><img src = "images/caddy.png" alt=""/><br />';

    if (!isset($_SESSION['panier']) || (count($_SESSION['panier'])) == 0) echo 'Le panier est vide.';
    else {
        $nbArticle = 0;
        $total = 0;

        foreach ($_SESSION['panier'] as $article) {
            $nbArticle += $article['Quantite'];
            $total += $article['Prix'] * $article['Quantite'];
        }

        if ($nbArticle == 1) echo '1 article ';
        else echo $nbArticle . ' articles ';

        echo $total . ' �';
    }

    echo '</a>';
}
*/
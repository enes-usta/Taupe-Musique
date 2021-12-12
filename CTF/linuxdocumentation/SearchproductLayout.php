<?php

function EffectuerRecherche()
{
    ?>
    <h2>Effectuer la recherche</h2><br/>
    <form enctype='multipart/form-data' action='SearchProduct.php' method='post' >
        <table>
            <tr>
                <td wnameth='180px'>User :</td>
                <td><input type="search" size="55" id="searchbar" placeholder="barre de recherche" name="user"/></td>
            </tr>
            <tr>
                <td><input name='valider' type='submit' value='Rechercher'/></td>
            </tr>
        </table>
    </form>
    <?php
}
<?php
include_once 'DB.php';

function ajouterProduitLayout()
{
    ?>
    <h2>Ajouter produit</h2><br/>
    <form enctype='multipart/form-data' action='Actions/addProduct.php' method='post' class='putImages'>
        <table>
            <tr>
                <td wnameth='180px'>Auteur</td>
                <td><input type='text' name='auteur'/></td>
            </tr>
            <tr>
                <td wnameth='180px'>Titre</td>
                <td><input type='text' name='titre'/></td>
            </tr>
            <tr>
                <td>Prix</td>
                <td><input type='text' name='prix'/></td>
            </tr>
            <tr>
                <td>Critique</td>
                <td><textarea name='descriptif' rows='8' cols='50'></textarea></td>
            </tr>
            <tr>
                <td>Image</td>
                <td><input id='file' name='file' type='file' multiple/></td>
            </tr>
            <tr>
                <td>Genre</td>
                <td>
                    <select name='rubrique' style='wnameth:145px'>
                        <?php
                        $rub = getMainRubriques();
                        if ($rub == false)
                            echo "ERRPR";
                        foreach ($rub as $item)
                            echo "<option>" . $item->LIBELLE_RUB . "</option>";
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Nombre de Chansons</td>
                <td><select id='nombre' name='nombre' style='wnameth:145px' onchange='numChansons()'>
                        <option selected>0</option>
                        <?php
                        for ($i = 1; $i <= 30; $i++)
                            echo "<option>" . $i . "</option>";
                        ?>

                    </select><br/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div id='tracks'></div>
                </td>
            <tr>
            <tr>
                <td><input name='valider' type='submit' value='Ajouter'/></td>
            </tr>
        </table>
    </form>
    <?php
}

<?php
include_once 'DB.php';

function ajouterRubriqueLayout()
{
    ?>
    <h2>Ajouter rubrique</h2><br/>
    <form enctype='multipart/form-data' action='Actions/addRubrique.php' method='post' class='putImages'>
        <table>
            <tr>
                <td wnameth='180px'>Rubrique</td>
                <td><input type='text' name='rubrique'/></td>
            </tr>
            <tr>
                <td><input name='valider' type='submit' value='Ajouter'/></td>
            </tr>
        </table>
    </form>
    <?php
}

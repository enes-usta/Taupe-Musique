<?php
include_once 'DB.php';

function ajouterRubriqueLayout()
{
    ?>
    <h2>Ajouter rubrique</h2><br/>
    <form enctype='multipart/form-data' action='Actions/addRubrique.php' method='post' class='putImages'>
        <table>
            <div>
                <label>Rubrique
                    <input type='text' name='rubrique'/>
                </label>
            </div>
            <br>
            <div>
                <input name='valider' type='submit' value='Ajouter'/>
            </div>
        </table>
    </form>
    <?php
}

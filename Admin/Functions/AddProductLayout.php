<?php
include_once 'DB.php';

function ajouterProduitLayout()
{
    ?>
    <h2>Ajouter produit</h2><br/>
    <form method='post'>
        <div class="form-group">
            <label for="author_field">Auteur</label>
            <input type="text" name="author" class="form-control" id="author_field"/>
        </div>
        <div class="form-group">
            <label for="title_field">Titre</label>
            <input type="text" name="title" class="form-control" id="title_field"/>
        </div>
        <div class="form-group">
            <label for="price_field">Prix</label>
            <input type="number" name="price" class="form-control" id="price_field"/>
        </div>
        <div class="form-group">
            <label for="descriptif_field">Critique</label>
            <input type="text" name="descriptif" class="form-control" id="descriptif_field"/>
        </div>

        <div class="form-group">
            <label for="genre_field">Genre</label>
            <select name="genre" class="form-control" id="genre_field">
                <?php
                foreach (getMainRubriques() as $item)
                    echo '<option>' . $item->LIBELLE_RUB . '</option>';
                ?>
            </select>
        </div>

        <div class="form-group">
            <div class="custom-file">
                <label class="custom-file-label" for="albumImage">Image de l'album</label>
                <input type="file" class="custom-file-input" id="albumImage" required/>
            </div>
        </div>

        <div class="form-group">
            <label for="nb_chansons_field">Nombre de chansons</label>
            <input onchange="numChansons(this.value)" type="number" name="nb_chansons" class="form-control"
                   id="nb_chansons_field"/>
        </div>
        <div id="tracks"></div>

        <input name='valider' type='submit' value='Ajouter'/>
    </form>
    <?php
}

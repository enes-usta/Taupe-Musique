<?php
session_start();
include 'authorized.php';
include 'Functions/Layout.php';
include_once 'Functions/DB.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>TaupeMusique</title>

    <link rel="stylesheet" type="text/css" href="/public/css/bootstrap.min.css"/>
    <script type="application/javascript" src="/public/js/jquery.min.js"></script>
    <script type="application/javascript" src="/public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/public/js/jq.js"></script>

    <script>
        numChansons = (nb) => {
            let str = '';
            for (let i = 0; i < nb; i++)
                str += `<div class="form-group mb-3">
                          <input type="text" class="form-control" name="tracks[${i}]" placeholder="Chanson n°${i}" />
                        </div>`;
            document.getElementById('tracks').innerHTML = str;
        }
    </script>

</head>

<body>
<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="row carousel">
        <div class="col-md-3">
            <p class="lead">Votre Profil</p>
            <?php CompteLayout(); ?>
        </div>
        <div class="col-md-9">
            <div class="row carousel-holder">
                <h2>Ajouter produit</h2><br/>
                <form id="addItemForm" method='post' enctype="multipart/form-data">
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
                                echo '<option>' . $item->libelle . '</option>';
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <label class="custom-file-label" for="albumImage">Image de l'album</label>
                            <input type="file" class="custom-file-input" name="albumImage" id="albumImage" required/>
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
                <hr>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('addItemForm').addEventListener('submit', (e) => {
        e.preventDefault();
        let data = new FormData(document.getElementById('addItemForm'))
        console.log(data)

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'Actions/addItem.php', true);
        xhr.onload = function(e) {

        };

        xhr.send(data);


            /*
            .then((r) => {
            return r.json();
        }).then((message) => {
            let response = document.getElementById('reponse1');
            response.className = (message.error) ? 'error' : 'success';
            response.innerHTML = '';
            if (message.ok) {
                response.style.color = 'green';
                response.innerHTML = '<li>Ajout effectué avec succès</li>';
            } else {
                response.style.color = 'red';
                for (const err in message.errors) response.innerHTML += '<li>' + message.errors[err] + '</li>';
            }
        })
    */})
</script>
<div class="container">
    <hr>
    <?php include("includes/footer.php"); ?>
</div>
</body>
</html>

<?php
session_start();
#echo phpinfo();
include("API.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include("imports.html"); ?>

    <title>Taupe Musique</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/heart.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link rel="stylesheet" href="css/datepicker.min.css"/>
    <link rel="stylesheet" href="css/datepicker3.min.css"/>

    <script type="text/javascript">

        $().ready(function () {
            $("input[name=selection]").each(function (i, selected) {
                selected.addEventListener('click', requestAlbumList, false);
            });
            document.getElementById("favOnly").addEventListener('click', requestAlbumList, false);

            $("#addPan").click((e) => {
                this.preventDefault();
            });

            $('#toolt').tooltip();

            setTimeout(requestAlbumList, 50);
        });

        var ingrList;
        function requestAlbumList() {
            ingrList = [];
            $("input[name=selection]:checked").each(function (i, selected) {
                ingrList.push(selected.value);
            });
            $.ajax({
                method: "POST",
                url: "getAlbumList.php",
                data: {ingr: ingrList, favOnly: document.getElementById("favOnly").checked, mot: $("#search").val()}
            })
                .done(function (msg) {
                    $("#albumList").html(msg);
                    addEvents();
                });
        }
        function addFav(e) {
            $.ajax({
                method: "POST",
                url: "EnregFav.php",
                data: {id_produit: e},
                success: function (data) {
                },
            });

        }
        function addPanier(e) {
            $.ajax({
                type: 'POST',
                url: 'fonctions/fonctionsPanier.php',
                data: {item: e},
                success: function (data) {
                    alert(data);
                },
            });
        }

    </script>

</head>

<body>

<!-- Navigation -->
<?php include("includes/navbar.php"); ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-3">
            <p class="lead">Sélectionnez un genre</p>

            <div class="checkbox">
                <label>
                    <input type="checkbox" id="favOnly"> N'afficher que vos albums favoris
                </label>
            </div>

            <div class="list-group">
                <?php


                displayRubriques(16,0);
                function displayRubriques($id_rubrique, $indentLvl)
                {
                    $rubriques = getSousRubriques($id_rubrique);
                    foreach ($rubriques as $a) {

                        echo '<a href="#" class="list-group-item" style="margin-left:' . (25 * $indentLvl) . 'px" data-toggle="collapse" data-target="#element' . $a->ID_RUB . '">
                            <i class="fa fa-angle-down"></i>' . $a->LIBELLE_RUB . '</a href="#">' . PHP_EOL;

                        echo '<div id="element' . $a->ID_RUB . '" class="list-group collapse parent">';
                        if (existeSousRubriques($a->ID_RUB)) {
                            displayRubriques($a->ID_RUB, $indentLvl+1);
                        }

                        echo '</div>' . PHP_EOL;

                    }
                }


                ?>
            </div>
        </div>

        <div class="col-md-9">
            <hr>
            Artist / Album <input id="search" onchange="requestAlbumList();" type="text"/>
            <hr>
            <div class="row" id="albumList">

                <div class="col-sm-6 col-lg-6 col-md-6">
                    <h2>Pas de produits dans la base de données</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <hr>
    <?php include("includes/footer.php"); ?>

</div>

<script src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/jq.js"></script>
<script src="js/heart.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/daterangepicker.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/moment.min.js"></script>

</body>

</html>

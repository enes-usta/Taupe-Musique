<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Taupe musique - Mot de passe oublié">

    <title>Taupe Musique</title>

    <script src="/public/js/jquery.min.js"></script>
    <script src="/public/js/jq.js"></script>
    <link href="/public/css/shop-homepage.css" rel="stylesheet">
    <link href="/public/css/bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript">
        $(document).ready(function () {
            document.getElementById('valider').addEventListener('click', async () => {
                await fetch('sendResetLink.php', {
                    method: "POST",
                    body: JSON.stringify({email: document.getElementById('email').value}),
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                document.getElementById('res').style.display = '';
            })
        });

    </script>

</head>

<body>
<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="row" id="albumList">
                <div class="col-sm-6 col-lg-6 col-md-6">
                    <h2>Mot de passe oublié</h2><br/>
                    <label>Entrez l'adresse email avec laquelle vous vous êtes inscrit pour réinitialiser votre mot de
                        passe.</label><br/><br/>
                    <input type="text" size="55" id="email" placeholder="votre email"/><br/><br/>
                    <button id="valider">Valider</button>
                    <div id="res" style="margin-top: 15px; display: none">
                        <p style="color: green">
                            Votre requête a bien été envoyé.
                            Si votre email est valide, un mail de réinitialisation a été envoyé
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <hr>
    <?php include("includes/footer.php"); ?>

</div>
</body>

</html>

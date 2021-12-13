<?php
session_start();
include 'Functions/Layout.php';
include_once("Database/DB.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Profil TaupeMusique">

    <title>Taupe Musique</title>


    <link href="/public/css/shop-homepage.css" rel="stylesheet">
    <link href="/public/css/bootstrap.min.css" rel="stylesheet">

    <script src="/public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/js/jq.js"></script>
    <style>
        td{
            padding: 5px 70px 5px 0;
        }
    </style>

</head>

<body>
<?php include("includes/navbar.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <p class="lead">Votre Profil</p>
            <?php CompteLayout(); ?>
        </div>

        <div class="col-md-9">
            <div class="row carousel-holder">
                <h2>Vos Informations</h2>
                <?php
                if (isLogged()) {
                    $user = getUser($_SESSION["user"]);
                    ?>
                    <table>
                        <tr>
                            <th>
                                <hr>
                            </th>
                        </tr>
                        <tr>
                            <td><strong>Login d'utilisateur</strong></td>
                            <td><?= htmlspecialchars($user->login) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Mot de passe<strong></td>
                            <td>********</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td><?= htmlspecialchars($user->email) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Nom</strong></td>
                            <td><?= htmlspecialchars($user->nom) ?></td>
                        </tr>

                        <tr>
                            <td><strong>Prénom</strong></td>
                            <td><?= htmlspecialchars($user->prenom) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Date de Naissance</strong></td>
                            <td><?= htmlspecialchars($user->date) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Telephone</strong></td>
                            <td><?= htmlspecialchars($user->telephone) ?></td>
                        </tr>

                        <tr>
                            <td><strong>Adresse</strong></td>
                            <td><?= htmlspecialchars($user->adresse) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Ville</strong></td>
                            <td><?= htmlspecialchars($user->ville) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Code Postal</strong></td>
                            <td><?= htmlspecialchars($user->codep) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Sexe</strong></td>
                            <td><?= htmlspecialchars($user->sexe) ?></td>
                        </tr>
                        <tr>
                            <td><a href='#Modifier' data-toggle='modal' class='list-group-item'>Éditer</a></td>
                            <td></td>
                        </tr>
                    </table>
                    <?php
                } else
                    echo "<font color='grey'>Connectez vous pour afficher cette page</font>";
                ?>


            </div>

        </div>

    </div>

</div>
<!-- /.container -->

<div class="container">

    <hr>

    <!-- Footer -->
    <?php include("includes/footer.php"); ?>


    <?php
    if (isLogged()) {
    $user = getUser($_SESSION["user"]);

    $sexe = ($user->sexe == "Homme") ?
        "<label class='radio-inline active'>
            <input type='radio' name='optradio' value='Homme' checked='' >Homme</label>
			<label class='radio-inline'>
			<input type='radio' name='optradio' value='Femme'>Femme</label>"
        :
        "<label class='radio-inline'>
        <input type='radio' name='optradio' value='Homme'>Homme</label>
			<label class='radio-inline active'>
			<input type='radio' name='optradio' value='Femme' checked=''>Femme</label>";
    ?>
    <div class='modal fade' id='Modifier' role='dialog'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4>Modifier mes donnèes</h4>
                </div>
                <div class='modal-body'>

                    <form role='form' method='post' id='modiform'>

                        <div class='form-group'>
                            <label id='reponse2'></label>
                        </div>
                        <div class='form-group'>
                            <input type='password' class='form-control' placeholder='********' maxlength='100'
                                   name='passwordbdd'/>
                        </div>
                        <div class='form-group'>
                            <input type='text' class='form-control' placeholder='<?= ($user->email ?? ' Email') ?>'
                                   maxlength='200' name='emailbdd'/>
                        </div>
                        <div class='form-group'>
                            <input type='text' class='form-control' placeholder='<?= ($user->nom ?? ' Nom') ?>'
                                   maxlength='200' name='nombdd'/>
                        </div>
                        <div class='form-group'>
                            <input type='text' class='form-control' placeholder='<?= ($user->adresse ?? ' Adresse') ?>'
                                   maxlength='100' name='prenombdd'/>
                        </div>
                        <div class='form-group input-append date'>
                            <input type='text' class='form-control' name='datebdd' placeholder='jj/mm/aaaa'
                                   id='datePicker2'/>
                            <span class='input-group-addon add-on'><span
                                        class='glyphicon glyphicon-calendar'></span></span>
                        </div>
                        <div class='form-group'>
                            <input type='text' class='form-control'
                                   placeholder='<?= ($user->telephone ?? ' Téléphone') ?>' maxlength='15'
                                   name='telephonebdd'/>
                        </div>
                        <div class='form-group'>
                            <input type='textarea' class='form-control'
                                   placeholder='<?= ($user->adresse ?? ' Adresse') ?>' maxlength='200'
                                   name='adressebdd'/>
                        </div>
                        <div class='form-group'>
                            <input type='textarea' class='form-control' placeholder='<?= ($user->ville ?? ' Ville') ?>'
                                   maxlength='200' name='villebdd'/>
                        </div>
                        <div class='form-group'>
                            <input type='text' class='form-control' placeholder='<?= ($user->codep ?? "Code postal") ?>'
                                   maxlength='200' name='postalbdd'/>
                        </div>
                        <div class='form-group'><?= $sexe ?></div>
                        <div class='modal-footer'>
                            <input class='btn btn-primary' type='submit' value='Enregistrer'>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <?php
        }
        ?>

        <script type="text/javascript">
            let editForm = document.getElementById('modiform');
            if (editForm !== null) editForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const data = new FormData(document.getElementById('modiform'));
                    const value = Object.fromEntries(data.entries());
                    fetch('Update.php', {
                        method: "POST",
                        body: JSON.stringify(value),
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    }).then(() => {
                        setTimeout(() => {
                            location.reload();
                        }, 100);
                    });
                }
            );
        </script>
</body>
</html>
